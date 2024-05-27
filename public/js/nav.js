function toggleDropdown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('active');
  }
  
  // Close the dropdown if the user clicks anywhere else on the screen
  document.body.addEventListener('click', function(event) {
    const dropdownMenu = document.getElementById('dropdownMenu');
    const targetElement = event.target;
  
    // Check if the clicked element is outside of the dropdown menu
    if (!dropdownMenu.contains(targetElement) && !dropdownMenu.classList.contains('active')) {
      // Close the dropdown if it is currently active
      dropdownMenu.classList.remove('active');
    }
  });
  
  // Stop event propagation when clicking inside the dropdown menu
  document.getElementById('dropdownMenu').addEventListener('click', function(event) {
    event.stopPropagation();
  });