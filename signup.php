<?php
// signup.php

include 'connect_db.php'; // Include your database connection file

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$errorMessages = [];
$registrationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessages[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format.";
    }

    if ($password !== $confirmPassword) {
        $errorMessages[] = "Passwords do not match.";
    }

    if (empty($errorMessages)) {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errorMessages[] = "Username or email already exists.";
        }

        $stmt->close();

        if (empty($errorMessages)) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $registrationSuccess = true;
            } else {
                $errorMessages[] = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    if ($registrationSuccess) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => implode(', ', $errorMessages)]);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - PMHJ</title>
  <link rel="stylesheet" href="css/signup.css">
  <script src="https://kit.fontawesome.com/931b85ca51.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <!-- Sign Up Form -->
    <div id="signUpForm" class="form-container">
      <div class="heading">
        <h2>Create Your Account</h2>
      </div>
      <form id="signupForm" action="signup.php" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
        </div>
        <div class="mb-3">
          <label for="signupPassword" class="form-label">Password (min 8 characters)</label>
          <input type="password" class="form-control" id="signupPassword" name="password" required minlength="8">
          <div id="passwordError" class="error-message" style="display:none;">Password must be at least 8 characters long.</div>
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required minlength="8">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <div class="d-flex justify-content-between mt-4">
          <a href="index.php" class="text-decoration-none">Back to Login</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Privacy Policy -->
  <div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div class="policy-content">
        <h3>Privacy Policy</h3>
        <p>Welcome to PMHJ. We care about your privacy. This policy explains how we collect, use, and protect your information.</p>
        <p><strong>Personal Information:</strong> Your name, email, and contact details.</p>
        <p><strong>Health Information:</strong> Your mental health data from using the app.</p>
        <p><strong>Usage Information:</strong> How you use the app, including device info and IP address.</p>
        <p>We use your information to:</p>  
        <ul>
          <li>Provide and improve our services.</li>
          <li>Communicate with you about updates and support.</li>
          <li>Keep our app secure and running well.</li>
        </ul>
        <p>We do not sell your information. We may share it with:</p>
        <ul>
          <li>Service Providers: To help us deliver and improve the app.</li>
          <li>Legal Reasons: If required by law or to protect our rights.</li>
        </ul>
        <p>We use strong security measures to protect your data, but no system is completely secure.</p>
        <p>If you have questions about your privacy, contact us at PMHJ@gmail.com</p>

        <h3>Terms of Service</h3>
        <p>1. Accepting the Terms<br>
          By using PMHJ, you agree to these rules. If you don't agree, don't use our app.</p>
        <p>2. Using the App<br>
          Use the app legally and follow these rules. Don't misuse the app or bother other users.</p>
        <p>3. Your Account<br>
          You might need an account to use some features. Keep your account info safe and be responsible for what happens under your account.</p>
        <p>4. Our Content<br>
          We own the content and features of the app. Don't use, share, or copy it without permission.</p>
        <p>5. Ending Your Use<br>
          We can stop or suspend your access if you break these rules or harm other users.</p>
        <p>6. Our Liability<br>
          We are not responsible for any indirect, incidental, or consequential damages from using our app.</p>
        <p>7. Changing the Terms<br>
          We can update these rules. If you keep using the app, you agree to the new rules.</p>
      </div>
      <button type="button" onclick="agreeAndSubmit()">I Agree</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('signupForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      const formData = new FormData(this); // Create a FormData object from the form

      // Perform AJAX request
      fetch('signup.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json()) // Assuming signup.php returns JSON
      .then(data => {
        if (data.success) {
          // Show the modal if registration was successful
          openModal();
        } else {
          // Handle errors returned from the server
          alert(data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
      });
    });

    function openModal() {
      document.getElementById("modal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("modal").style.display = "none";
    }

    function agreeAndSubmit() {
      // Redirect to index.php after agreeing to the modal
      window.location.href = 'index.php';
    }

    window.onclick = function(event) {
      var modal = document.getElementById("modal");
      if (event.target === modal) {
        closeModal();
      }
    }
  </script>
</body>
</html>
