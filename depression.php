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
    <h1>What is depression?</h1>
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
  </section> <!-- -->

  <script src="js/home_page.js"></script>
  <script src="js/categories.js"></script>
</body>
</html>