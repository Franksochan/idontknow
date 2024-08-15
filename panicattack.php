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
    <h1>What is Panic Attack?</h1>
        <img src="image/Panic_attack.jpg" alt="Panic_attack" class="panic-attack-image">

        <p>A panic attack is a sudden and intense episode of fear or anxiety that can occur without warning. During an
            attack, individuals often experience a rapid heartbeat, sweating, trembling, and shortness of breath. These
            physical symptoms can be so severe that it may feel as if one is having a heart attack or losing control,
            even though no real danger is present. Panic attacks typically last a few minutes, but the experience can be
            quite frightening. They can happen to anyone and may be triggered by stressful situations or occur
            spontaneously without an obvious cause.</p>

        <p>Although panic attacks can be isolated incidents, frequent attacks may signal a condition known as panic
            disorder. This disorder is characterized by persistent worry about future attacks and avoidance of places or
            situations where previous attacks occurred. Managing and treating panic attacks is crucial to prevent them
            from interfering with daily life. Effective treatments include cognitive-behavioral therapy (CBT), which
            helps individuals understand and change their patterns of thinking and behavior, and medications such as
            selective serotonin reuptake inhibitors (SSRIs). Additionally, lifestyle changes like regular exercise,
            relaxation techniques, and mindfulness practices can be beneficial in reducing the frequency and intensity
            of attacks.</p>
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