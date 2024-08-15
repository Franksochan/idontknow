 // Function to validate the form and open the modal
 function validateAndOpenModal() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('signupPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const passwordError = document.getElementById('passwordError');

  // Clear previous error message
  passwordError.style.display = 'none';

  // Email validation
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return;
  }

  // Password validation
  if (password.length < 8) {
    passwordError.style.display = 'block'; // Show error message
    return;
  }

  if (password !== confirmPassword) {
    alert("Passwords do not match. Please try again.");
    return;
  }

  // Form is valid, open the modal
  openModal();
}

// Function to open the modal
function openModal() {
  document.getElementById("modal").style.display = "block";
}

// Function to close the modal
function closeModal() {
  document.getElementById("modal").style.display = "none";
}

// Function to handle "I Agree" button click
function agreeAndRedirect() {
  closeModal();
  window.location.href = 'index.php';
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById("modal");
  if (event.target == modal) {
    closeModal();
  }
} 