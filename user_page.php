<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/user_page.css">
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
                        <a href="home_page.php">
                            <i class="fa-solid fa-house fa-2x"></i>
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
                        <a href="user_page.php">
                            <i class="fa-solid fa-circle-user fa-2x"></i>
                        </a>
                        <div class="nav-section nav-right">
                            <a href="index.php">
                                <i class="fa-solid fa-right-from-bracket fa-2x"></i>
                            </a>
                        </div>
                    </div>
                
            </nav>

            <div class="user-profile-section">
                <h2>User Profile</h2>
                <form action="#" class="user-profile-form">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" id="birthday" name="birthday" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex:</label>
                        <select id="sex" name="sex" required>
                            <option value="">Select sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <button type="submit" class="save-button">Save Changes</button>
                </form>
            </div>
    </div>

    <script src="js/user_page.js"></script>
</body>

</html>