document.addEventListener('DOMContentLoaded', function () {
    // Get elements by their IDs
    const aboutlearnBtn = document.getElementById("learn-more-btn-about");
    const aboutPopup = document.getElementById("about-popup"); // Corrected id
    const closeabout = document.getElementById("close-about-popup");



    // Show popup on button click
    aboutlearnBtn.addEventListener("click", function () {
        aboutPopup.style.display = "flex"; // Use flex for proper centering
    });


    // Hide popup on close button click
    closeabout.addEventListener("click", function () {
        aboutPopup.style.display = "none";
    });




    // Hide popup when clicking outside the content
    window.addEventListener("click", function (event) {
        if (event.target === wbPopup) {
            wbPopup.style.display = "none";
        }

    });
});