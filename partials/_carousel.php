<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        .carousel-inner .carousel-item img {
            width: 100%; /* Default width to make it responsive */
            height: auto; /* Maintain aspect ratio */
        }
        
        /* Desktop */
        @media (min-width: 992px) {
            .carousel-inner .carousel-item img {
                width: 1600px;
                height: 600px;
            }
        }

        /* Tablet */
        @media (min-width: 768px) and (max-width: 991px) {
            .carousel-inner .carousel-item img {
                width: 1200px;
                height: 450px;
            }
        }

        /* Phone */
        @media (max-width: 767px) {
            .carousel-inner .carousel-item img {
                width: 100%;
                height: auto; /* Automatically adjusts height to maintain aspect ratio */
            }
        }
    </style>
</head>
<body>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img\carousel1.jpg" class="d-block" alt="carousel 1 image">
            </div>
            <div class="carousel-item">
                <img src="img\carousel2.jpg" class="d-block" alt="carousel 2 image">
            </div>
            <div class="carousel-item">
                <img src="img\carousel3.jpg" class="d-block" alt="carousel 3 image">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
