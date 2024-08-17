<?php
// Start the session
session_start();

// Include your database connection
include('connect_db.php');

// Handle the form submission via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $conn->real_escape_string($_POST['content']);
    $is_anonymous = isset($_POST['anonymous']) && $_POST['anonymous'] == '1' ? 1 : 0; // Explicitly check for '1'

    // Set category automatically based on the page
    $category = 'Anxiety';

    // Set user ID to null if posting anonymously
    $post_user_id = $is_anonymous ? null : $_SESSION['user_id'];

    // Prepare the SQL statement based on anonymity
    if ($is_anonymous) {
        $sql = "INSERT INTO posts (user_id, category, content, status) VALUES (NULL, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $category, $content);
    } else {
        $sql = "INSERT INTO posts (user_id, category, content, status) VALUES (?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $post_user_id, $category, $content);
    }

    if ($stmt->execute()) {
        $username = $is_anonymous ? 'Anonymous' : $_SESSION['username'];
        echo json_encode([
            'success' => true,
            'username' => $username,
            'content' => $content
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit();
}

// Fetch only accepted posts from the database
$sql = "SELECT posts.*, users.username AS author_name FROM posts 
        LEFT JOIN users ON posts.user_id = users.id
        WHERE posts.status = 'accepted' AND posts.category = 'Anxiety'
        ORDER BY posts.id DESC";
$result = $conn->query($sql);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PMHJ</title>
  <link rel="icon" href="Images/Favicon.icon">
  <link rel="stylesheet" href="css/anxiety.css">
  <script src="https://kit.fontawesome.com/931b85ca51.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <header>
      <nav class="navbar">
        <div class="nav-section nav-left">
          <div class="category-container dropdown-container" onclick="toggleDropdown()">
            <button class="nav-button menu-button">
              <i class="fa-solid fa-bars fa-2x"></i>
            </button>
            <ul class="dropdown">
              <li class="categories-item"><a href="#">Categories</a></li>
              <li><a href="anxiety.php">Anxiety</a></li>
              <li><a href="stress.php">Stress</a></li>
              <li><a href="panicattack.php">Panic Attack</a></li>
              <li><a href="depression.php">Depression</a></li>
            </ul>
          </div>
          <div class="nav-section nav-left">
            <a href="home_page.php">
              <button class="nav-button house-button">
                <i class="fa-solid fa-house fa-2x"></i>
              </button>
            </a>
            <a href="#" class="nav-logo">
              <img src="image/LogoPicture.png" alt="Logo" class="logo-image">
              <h2 class="logo-text"></h2>
            </a>
          </div>
        </div>

        <div class="nav-section nav-center">
          <form action="#" class="search-form">
            <div class="search-input-container">
              <input type="search" placeholder="Search" required class="search-input">
              <button class="nav-button search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="nav-section nav-right">
          <button class="nav-button pensquare-button" id="pen-button">
            <i class="fa-solid fa-pen-to-square fa-2x"></i>
          </button>
          <div class="nav-section nav-right">
            <a href="user_page.php">
              <i class="fa-solid fa-circle-user fa-2x"></i>
            </a>
            <div class="nav-section nav-right">
              <a href="index.php">
                <i class="fa-solid fa-right-from-bracket fa-2x"></i>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </header>
  </div>

  <div class="content-container">
    <h1>What is Anxiety?</h1>
    <img src="image/Anxiety.jpg" alt="Anxiety" class="anxiety-image">

    <p>
      Anxiety is a complex emotional experience characterized by feelings of fear, worry, and uneasiness. It can arise
      as a response to stress and often manifests in physical symptoms such as sweating, restlessness, and a rapid
      heartbeat. For many individuals, anxiety is a temporary reaction to specific situations or events. However, when
      anxiety becomes persistent and intense, it may develop into an anxiety disorder. These disorders can significantly
      interfere with daily activities, affecting work performance, academic achievements, and personal relationships.
    </p>

    <p>
      There are several types of anxiety disorders, each with its own set of symptoms and triggers. Generalized Anxiety
      Disorder (GAD) involves excessive, uncontrollable worry about various aspects of life. Panic Disorder is marked by
      recurrent, unexpected panic attacks that can cause intense fear and physical symptoms. Social Anxiety Disorder
      involves a profound fear of social situations, leading to avoidance of such scenarios. Specific Phobias are
      intense fears of specific objects or situations that can lead to avoidance behaviors.
    </p>

    <p>
      Effective management and treatment of anxiety are crucial for improving quality of life. Treatment options often
      include cognitive-behavioral therapy (CBT), which helps individuals identify and change negative thought patterns
      and behaviors. Medications, such as antidepressants and anti-anxiety drugs, may also be prescribed to help manage
      symptoms. In addition to professional treatment, lifestyle changes such as regular exercise, a balanced diet, and
      mindfulness practices can be beneficial. It's essential for individuals experiencing significant anxiety to seek
      help from a mental health professional, as untreated anxiety can exacerbate other mental health issues, including
      depression.
    </p>
  </div>

  <section class="post-section" id="post-section">
    <div class="post-form-container">
      <h2>Create a Post</h2>
      <form id="post-form">
        <textarea id="post-content" name="content" placeholder="Write your post here..." required></textarea>
        <div class="post-options">
          <label>
            <input type="checkbox" id="anonymous-checkbox" name="anonymous">
            Post anonymously
          </label>
          <button type="submit" id="post-button">Post</button>
        </div>
      </form>
    </div>

    <div class="posts-container">
      <h2>Posts</h2>
      <div id="posts">
        <?php foreach ($posts as $post) { ?>
          <div class="post">
            <p><strong>Post Content:</strong> <?php echo htmlspecialchars($post['content']); ?></p>
            <p><strong>Author:</strong> <?php echo $post['author_name'] ? htmlspecialchars($post['author_name']) : 'Anonymous'; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <script>
  document.getElementById('post-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const content = document.getElementById('post-content').value;
    const anonymous = document.getElementById('anonymous-checkbox').checked ? 1 : 0;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'anxiety.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Alert the user
          alert('Your post has been submitted and is pending approval.');
          // Clear the form fields
          document.getElementById('post-content').value = '';
          document.getElementById('anonymous-checkbox').checked = false;
        } else {
          alert('There was an error saving your post.');
        }
      }
    };

    xhr.send(`content=${encodeURIComponent(content)}&anonymous=${encodeURIComponent(anonymous)}`);
  });

  // Smooth scroll to post section when pen button is clicked
  const penButton = document.getElementById('pen-button');
  const postSection = document.getElementById('post-section');

  penButton.addEventListener('click', function() {
    postSection.scrollIntoView({
      behavior: 'smooth'
    });
  });
  </script>
</body>

</html>
