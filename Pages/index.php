<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Assets/CSS/homepage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezondheidsmeter</title>
</head>
<body>
<div class="header">
    <h1>Gezondheidsmeter</h1>
</div>
<div class="content">
<img style="width:250px;" src="https://help.healthycities.org/hc/en-us/article_attachments/209783487/gauge-type1-90-500px.png">

    <div id="slideshow">

        <div class="slide" data-slide-index="0">
            <div class="category">
                <h3>Voeding</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>
        <div class="slide" data-slide-index="1">
            <div class="category">
                <h3>Slaap</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>
        <div class="slide" data-slide-index="2">
            <div class="category">
                <h3>Drugs</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>
        <div class="slide" data-slide-index="3">
            <div class="category">
                <h3>Sport</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>
        <div class="slide" data-slide-index="4">
            <div class="category">
                <h3>Werkomstandigheden</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>

        <div class="slide" data-slide-index="5">
            <div class="category">
                <h3>Alcohol</h3>
                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit dictum sollicitudin.
                    Maecenas nec dignissim leo. Vestibulum ut aliquam tellus. Vivamus at erat aliquet, scelerisq</div>
            </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

</div>
<script>
    let slidesPerGroup = 3;
    let currentIndex = 0;
    function sliderSize(x) {
        if (x === 1) {
            slidesPerGroup = 1;
            showSlides();
        } else if (x === 2) {
            slidesPerGroup = 2;
            showSlides();
        } else {
            slidesPerGroup = 3;
            showSlides();
        }
    }

    const mobile = window.matchMedia("(max-width: 600px)")
    const tablet = window.matchMedia("(max-width: 991px)")
    const laptop = window.matchMedia("(max-width: 992px)")
    let x = window.matchMedia("(max-width: 600px)");

    sliderSize();

    tablet.addEventListener("change", function() {
        x = 2;
        sliderSize(x);
    })

    laptop.addEventListener("change", function() {
        x = 3;
        sliderSize(x);
    })

    mobile.addEventListener("change", function() {
        if (mobile.matches) {
            x = 1;
        } else {
            x = 2;
        }
        sliderSize(x);
    });


    // const slidesPerGroup = 3;
    showSlides();

    function plusSlides() {
        let slides = document.getElementsByClassName("slide");

        // Hide the current slides
        for (let i = currentIndex; i < currentIndex + slidesPerGroup; i++) {
            let currentSlideIndex = i % slides.length;
            if (slides[currentSlideIndex]) {
                slides[currentSlideIndex].style.display = "none";
            }
        }

        // Move to the next slide, looping back to the start if necessary
        currentIndex = (currentIndex + 1) % slides.length;

        // Show the new group of slides
        for (let i = currentIndex; i < currentIndex + slidesPerGroup; i++) {
            let currentSlideIndex = i % slides.length; // Ensure wrapping around of indices
            if (slides[currentSlideIndex]) {
                slides[currentSlideIndex].style.display = "block";
            }
        }
    }

    function showSlides() {
        let slides = document.getElementsByClassName("slide");

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        // Display the current group of slides, considering the wrapping around of indices
        for (let i = 0; i < slidesPerGroup; i++) {
            let currentSlideIndex = (currentIndex + i) % slides.length;
            if (slides[currentSlideIndex]) {
                slides[currentSlideIndex].style.display = "block";
            }
        }
    }
</script>
</body>
</html>