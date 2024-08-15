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