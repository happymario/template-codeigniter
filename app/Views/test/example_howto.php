<?php
//http://192.168.0.13:8101/home/test
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=site_url('assets/admin/css/example_howto.css')?>" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="header">
    <h1>My Website</h1>
</div>
<div class="content">
    <h3>Slideshow / Carousel</h3>

    <div class="slideshow-carousel">
        <div class="slideshow-container">
            <div class="slideshow-item">
                <p>1/3</p>
                <img src="<?=site_url('assets/admin/img/test1.png')?>">
                <p>Caption PNG</p>
            </div>
            <div class="slideshow-item" style="display: none">
                <p>2/3</p>
                <img src="<?=site_url('assets/admin/img/test2.gif')?>">
                <p>Caption Gif</p>
            </div>

            <div class="slideshow-item"  style="display: none">
                <p>3/3</p>
                <img src="<?=site_url('assets/admin/img/test3.jpg')?>">
                <p>Caption JPG</p>
            </div>

            <!-- Next and Prev buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <br>

        <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <h3>Parallax Scrolling</h3>
    <div class="parallax"></div>

    <h3>Loader</h3>
    <div class="loader"></div>

    <h3>Cards</h3>
    <div class="card">
        <img src="<?=site_url('assets/admin/img/img_photo_default.png')?>" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b>John Doe</b></h4>
            <p>Architect & Engineer</p>
        </div>
    </div>

    <h3>More</h3>
</div>

</body>

<script>
    var slideIndex = 1;
    showSlides();

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("slideshow-item");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("slideshow-item");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
</script>


</html>

