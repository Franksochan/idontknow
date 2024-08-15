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
    <h1>What is Stress?</h1>
    <img src="image/Stress.jpg" alt="Stress" class="stress-image">

    <p>
      Stress is a complex and multifaceted experience that encompasses physical, mental, and emotional responses to various pressures and demands.
      It can stem from a range of sources, including work-related challenges, relationship issues, financial difficulties, and health problems. When confronted
      with stress, the body triggers its "fight or flight" response, releasing hormones like adrenaline and cortisol. These hormones prepare the body to
      handle perceived threats by increasing heart rate, blood pressure, and energy levels. While acute stress can be a natural and beneficial reaction that
      motivates individuals to address immediate challenges, chronic stress can have significant negative effects on health.
    </p>

    <p>
      Long-term exposure to stress can contribute to a variety of health problems, including anxiety disorders, depression, cardiovascular diseases,
      and a weakened immune system. The persistent activation of the stress response can lead to physical symptoms such as headaches, gastrointestinal
      issues, and sleep disturbances. Emotionally, chronic stress can exacerbate feelings of irritability, fatigue, and overwhelm, potentially affecting
      personal relationships and overall quality of life. Managing stress effectively is vital for maintaining both physical and mental health. Techniques
      such as engaging in regular physical exercise, practicing mindfulness and meditation, employing effective time management strategies, and seeking
      support from friends, family, or mental health professionals can all play a crucial role in alleviating stress. Additionally, adopting healthy lifestyle
      habits and developing coping strategies can help mitigate the impact of stress and enhance overall well-being.
    </p>
  </div>

  <section class="post-section" id="post-section">
    <div class="post-form-container"> <!-- -->
      <h2>Create a Post</h2>
      <form id="post-form">
        <textarea id="post-content" placeholder="Write your post here..." required></textarea>
        <div class="post-options">
          <label>
            <input type="checkbox" id="anonymous-checkbox">
            Post anonymously
          </label>
          <button type="submit" id="post-button">Post</button>
        </div>
      </form>
    </div>

    <div class="posts-container">
      <h2>Posts</h2>
      <div id="posts"></div>
    </div>
  </section> <!---->

  <script src="js/home_page.js"></script>
  <script src="js/categories.js"></script>
</body>

</html>