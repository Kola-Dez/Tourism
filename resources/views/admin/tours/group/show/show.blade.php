<?php
    $imageWidth = 256;
    $imageHeight = 256;
    $imageMany = 4;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
    }
    html, body {
        font-size: 18px;
    }
    .container {
        max-width: 1200px;
        margin: 30px;
        background: #ada2a2;
        padding: 30px;
    }
    img {
        max-width: {{ $imageWidth . 'px' }};
        max-height: {{ $imageHeight . 'px' }};
    }
    h1 {
        text-align: center;
        margin-bottom: 40px;
    }
    button {
        background: none;
        border: 1px solid black;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: .9rem;
    }
    button:hover {
        background: orangered;
    }
    button:active {
        background: black;
        color: white;
    }
    .slider {
        width: {{ $imageWidth . 'px' }};
        height: {{ $imageHeight . 'px' }};
        border: 2px solid black;
        margin: 30px auto;
        overflow: hidden;
    }
    .slider-line {
        height: {{ $imageHeight . 'px' }};
        width: 1024px;
        background: orangered;
        display: flex;
        position: relative;
        left: 0;
        transition: all ease 1s;
    }

</style>
    @dd($tour)
<body>
    <div class="container">
        <div class="slider">
            <div class="slider-line">
                <img src="{{ asset('storage/images/groupTours/eJGixKNnmmBnkrAvZctUSt1h0jFTD5HrYWRypXT9.jpg') }}" alt="test">
                <img src="{{ asset('storage/images/groupTours/X6WnKv2jZxCONjzkMg0dtjPp6YgafboLQbboBnMl.jpg') }}" alt="test">
                <img src="{{ asset('storage/images/groupTours/f9kPdnZYKg2OcFQGeDNpxQvKX2ZU8yIrgr7RPoIf.jpg') }}" alt="test">
                <img src="{{ asset('storage/images/groupTours/X6WnKv2jZxCONjzkMg0dtjPp6YgafboLQbboBnMl.jpg') }}" alt="test">
            </div>
        </div>
        <button class="slider-prev">Prev</button>
        <button class="slider-next">Next</button>
    </div>


</body>
<script>
    let offset = 0;
    const sliderLine = document.querySelector('.slider-line');

    document.querySelector('.slider-next').addEventListener('click', function () {
        offset += {{ $imageWidth }};
        if(offset >= {{ $imageMany * $imageWidth }} ) {
            offset = 0;
        }
        sliderLine.style.left = -offset + 'px';
    });
    document.querySelector('.slider-prev').addEventListener('click', function () {
        offset -= {{ $imageWidth }};
        if(offset < 0 ) {
            offset = {{ ($imageMany - 1) * $imageWidth }};
        }
        sliderLine.style.left = -offset + 'px';
    });
</script>
</html>
