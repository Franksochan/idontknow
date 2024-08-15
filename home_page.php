<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMHJ</title>
    <link rel="stylesheet" href="css/home_page.css">
    <link rel="icon" href="Images/Favicon.icon">
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
                        <button class="nav-button house-button">
                            <i class="fa-solid fa-house fa-2x"></i>
                        </button>
                        <a href="#" class="nav-logo">
                            <img src="LogoPicture.png" alt="Logo" class="logo-image">
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
                    <button class="nav-button pensquare-button">
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
        <div class="pmhj-section">
            <h1>Personal Mental Health Journal (PMHJ)</h1>
            <p>Welcome to your Personal Mental Health Journal (PMHJ), a safe space for self-reflection and emotional
                expression. Journaling can be a powerful tool for managing mental health, helping you to process your
                thoughts and feelings, track your progress, and improve your overall well-being.</p>

            <h2>Benefits of Journaling</h2>
            <ul>
                <li><strong>Manage Anxiety:</strong> Writing about your feelings can help reduce anxiety and stress.
                </li>
                <li><strong>Emotional Clarity:</strong> Journaling allows you to articulate your thoughts and gain
                    insights into your emotions.</li>
                <li><strong>Track Progress:</strong> Monitor your mental health journey by recording symptoms and
                    triggers.</li>
                <li><strong>Set Goals:</strong> Use your journal to establish personal goals and track your
                    achievements.</li>
                <li><strong>Promote Mindfulness:</strong> Journaling encourages you to stay present and reflect on your
                    daily experiences.</li>
            </ul>

            <h2>How to Start Your Journal</h2>
            <p>Here are some tips to help you begin your journaling journey:</p>
            <ol>
                <li>Choose a comfortable space and a time that works for you.</li>
                <li>Write freely for at least 10-20 minutes each day.</li>
                <li>Document your feelings, experiences, and any symptoms you may be experiencing.</li>
                <li>Reflect on your entries to identify patterns and triggers.</li>
                <li>Consider using prompts to guide your writing.</li>
            </ol>

            <h2>Journaling Prompts</h2>
            <p>If you're unsure what to write about, here are some prompts to get you started:</p>
            <ul>
                <li>What are three things I am grateful for today?</li>
                <li>How did I feel today, and why?</li>
                <li>What challenges did I face, and how did I cope with them?</li>
                <li>What are my goals for tomorrow?</li>
            </ul>
        </div>
    </div>
    <script src="js/home_page.js"></script>
</body>

</html>