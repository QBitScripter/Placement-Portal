const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');

// Toggle the hamburger menu and off-screen menu when the hamburger menu is clicked
hamMenu.addEventListener('click', () => {
    hamMenu.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
});

// Close the menu when clicking anywhere on the screen
document.addEventListener('click', (event) => {
    // Check if the hamburger menu is active
    if (hamMenu.classList.contains('active') && 
        !hamMenu.contains(event.target) && 
        !offScreenMenu.contains(event.target) && // Check if the click is outside the off-screen menu
        event.target !== hamMenu) { // Ensure we are not clicking the hamMenu itself
        hamMenu.classList.remove('active');
        offScreenMenu.classList.remove('active'); // Close the off-screen menu as well
    }
});
