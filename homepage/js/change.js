let foods = document.getElementById('food');

// Array of image URLs
let imageUrls = ['pasta.jpg', 'gps.jpg', 'pizza.jpg','pfood.jpg'];

// Index to track current image
let currentIndex = 0;

// Function to switch to the next image
function switchImage() {
    currentIndex = (currentIndex + 1) % imageUrls.length; // Move to the next image URL, looping back to the start if needed
    foods.style.backgroundImage = `url('${imageUrls[currentIndex]}')`;
}

// Call switchImage initially
switchImage();

// Set interval to switch images every 5 seconds (5000 milliseconds)
let intervalId = setInterval(switchImage, 5000);
