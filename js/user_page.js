// Function to save profile changes (for demonstration purposes)
function saveProfile() {
    const username = document.getElementById('username').value;
    const age = document.getElementById('age').value;
    const birthday = document.getElementById('birthday').value;
    const email = document.getElementById('email').value;
    const profilePicture = document.getElementById('profilePicture').value;

    // Here you would typically send this data to your server
    console.log("Profile Saved:", {
        username,
        age,
        birthday,
        email,
        profilePicture
    });

    alert("Profile saved successfully!");
}// your code goes here
// Function to save profile changes (for demonstration purposes)
function saveProfile() {
    const username = document.getElementById('username').value;
    const age = document.getElementById('age').value;
    const birthday = document.getElementById('birthday').value;
    const email = document.getElementById('email').value;
    const profilePicture = document.getElementById('profilePicture').value;

    // Here you would typically send this data to your server
    console.log("Profile Saved:", {
        username,
        age,
        birthday,
        email,
        profilePicture
    });

    alert("Profile saved successfully!");
}

document.addEventListener('DOMContentLoaded', function() {
    const currentLocation = window.location.href;
    const menuItems = document.querySelectorAll('.dropdown li a');
  
    menuItems.forEach(item => {
        if (item.href === currentLocation) {
            item.classList.add('active');
        }
    });
  
    const dropdownContainer = document.querySelector('.dropdown-container');
    if (document.querySelector('.dropdown li a.active')) {
        dropdownContainer.classList.add('show');
    }
  });
  
  function toggleDropdown() {
    const dropdownContainer = document.querySelector('.dropdown-container');
    dropdownContainer.classList.toggle('show');
  }