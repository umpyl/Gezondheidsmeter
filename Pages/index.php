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
    <img style="width:250px;"
         src="https://help.healthycities.org/hc/en-us/article_attachments/209783487/gauge-type1-90-500px.png">

    <section id="carousel">
        <div class="textcarousel">
            <div>
                <h2>Voeding</h2>
            </div>
        </div>
        <div class="textcarousel">
            <div>
                <h2>Slaap</h2>
            </div>
        </div>
        <div class="textcarousel">
            <div>
                <h2>Drugs</h2>
            </div>
        </div>
        <div class="textcarousel">
            <div>
                <h2>Sport</h2>
            </div>
        </div>
        <div class="textcarousel">
            <div>
                <h2>Werkomstandigheden</h2>
            </div>
        </div>
        <div class="textcarousel">
            <div>
                <h2>Alcohol</h2>
            </div>
        </div>

        <a class="prev" onclick="goToPrevious()">&#10094;</a>
        <a class="next" onclick="goToNext()">&#10095;</a>
    </section>

</div>
<script>
    var text_items = document.getElementsByClassName("textcarousel");
    var elementor_check = document.getElementsByClassName("elementor-editor-active");
    var previous_count, current_count, next_count;
    var intervalId;

    if (elementor_check.length == 0) {
        current_count = 0;
        text_items[current_count].classList.add("current_text");
        text_items[current_count].classList.add("active_text");
        text_items[current_count].classList.add("first_text");
        current_count++;

        for (let index = 1; index < text_items.length; index++) {
            text_items[index].classList.add("absolute_text");
        }

        function startCarousel() {
            intervalId = setInterval(() => {

                updateClasses();
            }, 5000);
        }

        function updateClasses() {
            previous_count = count_check(current_count - 1);
            current_count = count_check(current_count);
            next_count = count_check(current_count + 1);
            for (let index = 0; index < text_items.length; index++) {
                text_items[index].classList.remove("current_text");
                text_items[index].classList.remove("previous_text");
                text_items[index].classList.remove("next_text");
                text_items[index].classList.remove("active_text");
            }
            text_items[previous_count].classList.add("previous_text");
            text_items[previous_count].classList.add("active_text");
            text_items[next_count].classList.add("next_text");
            text_items[next_count].classList.add("active_text");

            text_items[current_count].classList.add("current_text");
            text_items[current_count].classList.add("active_text");

            current_count++;
        }

        function count_check(count) {
            if (count >= text_items.length) {
                return 0;
            } else if (count < 0) {
                return text_items.length - 1;
            } else {
                return count;
            }
        }

        function goToPrevious() {
            current_count = count_check(current_count - 2);
            updateClasses();
        }

        function goToNext() {
            updateClasses();
        }

        // Start the carousel
        startCarousel();
    }
</script>
</body>
</html>