// Function to fetch and display the current date
function displayCurrentDate() {
    const dateElement = document.getElementById('current-date');
    const currentDate = new Date();
    
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('en-US', options);
    
    dateElement.textContent = formattedDate;
}

// Call the function on page load
window.onload = displayCurrentDate;
