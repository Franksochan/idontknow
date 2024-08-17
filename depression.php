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
    $category = 'Depression';

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
        WHERE posts.status = 'accepted' AND posts.category = 'Depression'
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
    <h1>What is Depression?</h1>
    <img src="image/Depression.png" alt="Depression" class="depression-image">

    <p>Depression is a mood disorder that causes a persistent feeling of sadness and loss of interest. Also called
        major depressive disorder or clinical depression, it affects how you feel, think, and behave and can lead to
        a variety of emotional and physical problems. People with depression may have trouble doing normal
        day-to-day activities, and sometimes they may feel as if life isn't worth living.</p>

    <p>Depression is more than just a bout of the blues; it isn’t something you can simply "snap out" of. It
        requires long-term treatment. Most people with depression feel better with medication, psychotherapy, or
        both.</p>

    <p>Common symptoms of depression include feelings of sadness, tearfulness, emptiness, or hopelessness; angry
        outbursts, irritability, or frustration, even over small matters; loss of interest or pleasure in most or
        all normal activities; sleep disturbances, such as insomnia or sleeping too much; tiredness and lack of
        energy, so even small tasks take extra effort.</p>

    <p>Depression can affect anyone, regardless of age, gender, or background. Its causes are complex and can
        include genetic, biochemical, environmental, and psychological factors. It often begins in adolescence or
        early adulthood, but can also occur later in life. Stressful life events, such as the loss of a loved one,
        financial problems, or major life changes, can trigger or worsen symptoms. Importantly, depression is not a
        sign of personal weakness or a character flaw; it is a serious mental health condition that requires
        compassionate support and professional treatment. Addressing depression early and seeking help can lead to
        better outcomes and improved quality of life for those affected.</p>
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
    xhr.open('POST', 'depression.php', true);
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
          // Optionally, add the new post to the posts container dynamically
          const postsContainer = document.getElementById('posts');
          const newPost = document.createElement('div');
          newPost.className = 'post';
          newPost.innerHTML = `<p><strong>Post Content:</strong> ${response.content}</p><p><strong>Author:</strong> ${response.username}</p>`;
          postsContainer.prepend(newPost); // Add new post to the top of the list
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
