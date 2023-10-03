// Slideshow
let slideIndex = 0;

// Function to display slides and control the slideshow
function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }

    // Increment slideIndex and reset to 1 if it exceeds the number of slides
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    // Remove "active" class from all dots
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Display the current slide and mark its corresponding dot as "active"
    slides[slideIndex - 1].style.display = "block";  
    dots[slideIndex - 1].className += " active";

    // Schedule the next slide change in 2 seconds
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}

// Call the showSlides function to start the slideshow
showSlides();

// Login Button
document.getElementById("login").onclick = function() {
    // Redirect to the login page when the login button is clicked
    window.location.href = "login.html";
}

// Register Button
document.getElementById("register").onclick = function() {
    // Redirect to the registration page when the register button is clicked
    window.location.href = "register.html";
}
