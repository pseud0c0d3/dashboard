<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AID OF ANGELS</title>

    
    <!-- FontAwesome & Google Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/seemore.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="font-family: 'Roboto', sans-serif;">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/logo.png" alt="Brand Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="color: white;">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#docu">Pictures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#join">Join</a>
                </li>
            </ul>
        </div>
    </nav>

<!-- Hero Section -->
<section id="home" class="relative hero-bg hero-container">
    <div class="hero-overlay flex flex-col justify-center items-center text-white">
        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 hero-carousel-image" src="/img/pic2.png" alt="First slide">
                    <div class="carousel-caption d-block">
                        <h5>First Slide Title</h5>
                        <p>Description for the first slide goes here.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 hero-carousel-image" src="/img/pic3.png" alt="Second slide">
                    <div class="carousel-caption d-block">
                        <h5>Second Slide Title</h5>
                        <p>Description for the second slide goes here.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 hero-carousel-image" src="/img/pic4.png" alt="Third slide">
                    <div class="carousel-caption d-none d-block">
                        <h5>Third Slide Title</h5>
                        <p>Description for the third slide goes here.</p>
                    </div>
                </div>
            </div>
            
            <!-- Controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>




    <!-- Mission & Vision Sections -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Mission Section -->
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="card border-0 rounded-4 ">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-flag text-primary fs-3 me-3"></i>
                            <h2 class="card-title text-dark fw-bold">Mission</h2>
                        </div>
                        <p class="card-text text-muted mission-text">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vitae eget porttitor egestas; senectus fusce sapien. Nam fusce proin fames et nascetur lobortis curabitur. Aornare ipsum mauris id eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vitae eget porttitor egestas; senectus fusce sapien. Nam fusce proin fames et nascetur lobortis curabitur. Aornare ipsum mauris id eros.
                        </p>
                        <button class="btn btn-outline-primary btn-sm d-block mx-auto mt-3 toggle-text" data-target=".mission-text">Read More</button>
                    </div>
                </div>
            </div>

            <!-- Vision Section -->
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="card border-0 rounded-4 ">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-eye text-success fs-3 me-3"></i>
                            <h2 class="card-title text-dark fw-bold">Vision</h2>
                        </div>
                        <p class="card-text text-muted vision-text">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vitae eget porttitor egestas; senectus fusce sapien. Nam fusce proin fames et nascetur lobortis curabitur. Aornare ipsum mauris id eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vitae eget porttitor egestas; senectus fusce sapien. Nam fusce proin fames et nascetur lobortis curabitur. Aornare ipsum mauris id eros.
                        </p>
                        <button class="btn btn-outline-success btn-sm d-block mx-auto mt-3 toggle-text" data-target=".vision-text">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 


    <section id="docu">
    <!-- Documentary Pictures Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Documentary Pictures</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="/img/pic2.png" alt="Documentary Picture 1" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="/img/pic3.png" alt="Documentary Picture 2" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="/img/pic4.png" alt="Documentary Picture 3" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<section id="join" class="bg-primary text-white py-5" style=" background: linear-gradient(#102c38,#2b51a8);">
    <div class="container text-center">
        <h2 class="display-4" style="font-family: 'Roboto', sans-serif;">Become a Part of Our Journey</h2>
        <p class="lead mb-4" style="font-family: 'Roboto', sans-serif; color:white">At Aid of Angels, we are dedicated to providing comprehensive therapy and learning support for children and families facing autism. Your support is essential in helping us create a brighter future for those who need it the most.</p>
        <p class="mb-4" style="font-family: 'Roboto', sans-serif; color:white">By joining us, you contribute to a community that believes in compassion, understanding, and progress. Together, we can empower children and families to overcome challenges and thrive in a supportive environment.</p>
        <a href="{{ route('user.register') }}" class="btn main-btn rounded-pill px-6 py-3 shadow-lg text-white font-semibold opacity-0 transform -translate-y-20 scale-75 intro-effect">Join Now</a>
    </div>
</section>




    <!-- Custom CSS -->
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        .toggle-text {
            transition: all 0.3s ease-in-out;
        }

        .toggle-text:focus {
            outline: none;
        }

        .toggle-text.active {
            color: #007bff;
            font-weight: bold;
        }

        .mission-text, .vision-text {
            max-height: 100px;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mission-text.open, .vision-text.open {
            max-height: 500px;
        }

        .pictures {
            padding: 30px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .picture-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .picture-grid img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .navbar.scrolled {
            background-color: #333;
        }
    </style>

    <!-- Custom JavaScript -->
    <script>
        // Toggle Read More/Read Less functionality
        document.querySelectorAll('.toggle-text').forEach(button => {
            button.addEventListener('click', function() {
                const target = document.querySelector(this.dataset.target);
                target.classList.toggle('open');
                this.classList.toggle('active');
                this.textContent = target.classList.contains('open') ? 'Read Less' : 'Read More';
            });
        });

        // Carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        function showSlide(index) {
            const carouselInner = document.querySelector('.carousel-inner');
            const slideWidth = slides[0].clientWidth;
            carouselInner.style.transform = `translateX(-${index * slideWidth}px)`;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Scroll event for navbar
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
    </script>

</body>
</html>
