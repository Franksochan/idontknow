<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PMHJ</title>
  <link rel="stylesheet" href="css/forgot_password.css">
  <link rel="icon" href="Favicon.icon">
  <script src="https://kit.fontawesome.com/931b85ca51.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evSXbIWVMQvAuqLtWB7 screwing around with your CSS (optional)">
</head>

<body>
  <div class="container">
    <div id="forgotPasswordForm" class="form-container">
      <div class="heading">
        <h2>Reset Password</h2>
      </div>
      <form id="forgotPasswordElement">
        <label for="email">Email Address</label>
        <input type="email" id="forgotEmail" name="forgotEmail" required>
        <small class="form-text text-muted"><br></b>We will send you a link to reset your password.</small>
        <button type="submit"><span>Send Reset Link</span> <i class="fa-solid fa-circle-arrow-right"></i></button>
      </form>
      <p>or <a href="index.php" class="text-decoration-none">Back to Login</a></p>
    </div>
  </div>
  <script src="js/forgot_password.js"></script>
</body>

</html>