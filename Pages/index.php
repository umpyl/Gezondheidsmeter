<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../Assets/CSS/index.css">
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
        <div class="slide">
            <h3>Voeding</h3>
        <div class="text">Caption 1 text</div>
        </div>

        <div class="slide">
            <h3>Slaap</h3>
        <div class="text">Caption 2 text</div>
        </div>

        <div class="slide">
            <h3>Sport</h3>
        <div class="text">Caption 3 text</div>
    </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
    }
</script>
</body>
</html>