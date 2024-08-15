<?php
session_start();

// Check for success parameter in the URL
$successMessage = '';
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $successMessage = 'Registration successful! You can now log in.';
}

require 'connect_db.php'; // Include the database connection

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($inputPassword, $hashedPassword)) {
            // Successful login
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: home_page.php"); // Redirect to a dashboard page
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PMHJ - Login</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/931b85ca51.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url('image/Background.png'); /* Ensure this image is available */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .container {
      max-width: 420px;
      width: 50%;
      height: 540px;
      padding: 20px;
      box-shadow: -30px 5px 50px black;
      background-color: white;
    }

    .form-container {
      text-align: left;
      flex-direction: column;
      display: flex;
    }

    .heading {
      text-align: left;
      width: 100%;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: grey;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: calc(100% - 40px);
      padding: 10px;
      margin-bottom: 15px;
      border-top: none;
      border-right: none;
      border-left: none;
      border-bottom: solid #4CAF50;
      outline: none;
    }

    button {
      margin-top: 20px;
      font-size: 20px;
      padding: 12px 20px;
      background-color: #21917B;
      color: white;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      width: 100%;
      font-weight: bold;
    }

    button:hover {
      background-color: #45a049;
    }

    a {
      color: #21917B;
    }

    a.text-decoration-none {
      display: block;
      margin: 0 auto;
      text-align: center;
      color: #000;
      margin-top: 20px;
    }

    a.text-decoration-none:hover {
      color: #45a049;
    }

    p {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Login Form -->
    <div id="loginForm" class="form-container">
      <div class="heading">
        <h2>Log In</h2>
      </div>
      <form id="loginFormElement" method="POST" action="">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password (min 8 characters)</label>
        <input type="password" id="password" name="password" required minlength="8">
        <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <button type="submit"><span>Continue</span></button>
      </form>
      <p>or <a href="signup.php" id="signUpLink">Sign Up</a></p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
