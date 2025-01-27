
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aid of Angels</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script src="js/scriptdex.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
.empowering-families-container {
    padding: 40px 20px;
}
.empowering-families-image {
    width: 100%;
    height: auto;
    border-radius: 8px; 
}
.empowering-families-text {
    padding-left: 60px; 
}
.empowering-families-text h2 {
    font-family: 'Roboto', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #333; 
    margin-bottom: 20px;
    text-align: left; 
}
.empowering-families-text p {
    font-family: 'Arial', sans-serif; 
    font-size: 1.1rem;
    line-height: 1.6;
    color: #555; 
    text-align: left;
}

@media (max-width: 768px) {
    .empowering-families-container .row {
        flex-direction: column;
        align-items: center;
    }
    .empowering-families-text {
        text-align: center;
        margin-top: 20px;
        padding-left: 20px;
    }
    .empowering-families-image {
        max-width: 80%;
    }
}

/*
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 4px solid #f3f3f3; 
    border-top: 4px solid #3498db; 
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}*/
        
</style>
<body>
<!--
<div id="preloader" class="preloader">
    <div class="spinner"></div>
</div>

 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="font-family: 'Roboto', sans-serif;">
    <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="Brand Logo">
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
                <a class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<header class="jumbotron text-center relative" id="home" style="background-image: url('img/bck.png'); background-size: cover; background-position: center; background-attachment: fixed; font-family: 'Poppins', sans-serif;">
  <div class="absolute inset-0 bg-black opacity-50"></div>
  <div class="container relative z-10 text-center py-24 px-6">
    <h1 class="display-4 text-white font-bold mb-4 opacity-0 transform -translate-y-20 scale-75 intro-effect" style="font-size: 3rem; letter-spacing: 1px; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">
      Aid of Angels Therapy and Learning Center
    </h1>
    <p class="lead text-white mb-6 opacity-0 transform -translate-y-20 scale-75 intro-effect" style="font-family: 'Open Sans', sans-serif; font-size: 1.2rem; line-height: 1.8; font-weight: 400; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);">
      Welcome to our website, where we offer comprehensive<br />
      diagnostic testing and personalized support for children with autism.
    </p>
    <a href="{{ route('user.register') }}" class="btn main-btn rounded-pill px-6 py-3 shadow-lg text-white font-semibold">
      Get Started
    </a>
  </div>
</header>


<!-- Services Section -->
<div class="container my-5 services-container" id="services">
    <h2 class="text-center mb-5 font-weight-bold">Our Services</h2>
    <div class="row">
        <!-- Comprehensive Evaluation -->
        <div class="col-md-4 text-center mb-4">
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl bg-light">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-brain fa-4x text-primary"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Comprehensive Evaluation</h5>
                <p class="text-muted">We provide thorough evaluations to identify each child's unique needs, ensuring the right support.</p>
            </div>
        </div>
        <!-- Personalized Therapy -->
        <div class="col-md-4 text-center mb-4">
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl bg-light">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-heart fa-4x text-danger"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Personalized Therapy</h5>
                <p class="text-muted">Our therapy sessions are tailored to suit the individual requirements of each child, promoting growth and development.</p>
            </div>
        </div>
        <!-- Supportive Community -->
        <div class="col-md-4 text-center mb-4">
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl bg-light">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-users fa-4x text-info"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Supportive Community</h5>
                <p class="text-muted">We foster a nurturing community that supports both children and their families, creating a safe space for growth.</p>
            </div>
        </div>
    </div>
</div>

<!-- Empowering Families Section -->
<div class="empowering-families-container">
    <div class="row">
        <div class="col-md-6">
            <img src="img/pic2.png" alt="Empowering Families" class="empowering-families-image">
        </div>
        <div class="col-md-6 empowering-families-text">
            <h2>Empowering Families, Transforming Lives</h2>
            <p>
                At Aid of Angels Therapy and Learning Center, we are dedicated to providing families with the resources and support they need to navigate the journey of autism.
                <br><br>From comprehensive diagnostic testing to personalized therapy and a supportive community, we are committed to ensuring that every child with autism has the opportunity to reach their full potential.
                <br><br>Our compassionate team strives to empower families with knowledge and tools for effective support.
            </p>
        </div>
    </div>
</div>


<!-- About Us Section -->
<div class="container  about-us-container" id="about">
    <h2 class="text-center mb-4 font-semibold text-4xl">About Us</h2>
    <p class="text-center text-gray-700 mb-6 leading-relaxed text-lg">
        At Aid of Angels Therapy and Learning Center, we are committed to providing personalized support and diagnostic services
        for children with autism. Our dedicated team of professionals is here to ensure every child thrives, unlocking their
        full potential through specialized care and attention.
    </p>
    <div class="text-center">
        <a href="{{ route('seemore') }}" class="btn btn-primary text-black hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-6 transition duration-300" style="background: linear-gradient(135deg, #3a63d5, #1b3248);">
            Learn More
        </a>
    </div>
</div>

<div class="additional-container" style="background-image: url('img/pic4.png'); background-size: cover; background-position: center; padding: 0;">
    <div class="container text-dark">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center justify-content-center mb-4">
                <div class="box founder-box text-center p-4" style="background-color: white; border-radius: 10px; width: 90%;">
                    <h3>Meet Our Founder</h3>
                    <img src="img/founder.png" alt="Founder" class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px;">
                    <p>Discover the vision and passion of our founder who established this center to support families.</p>
                    <a href="#" class="text-primary">Learn More</a>
                </div>
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center">
                <div class="row">
                    <!-- Forum Feature -->
                    <div class="col-md-12 mb-3">
                        <div class="box text-left p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                            <h3>Forum</h3>
                            <p>Join the discussion with other parents and professionals to share insights, tips, and resources related to autism therapy and support.</p>
                            <ul class="text-left text-gray-600 list-disc list-inside">
                                <li>Connect with other parents going through similar experiences.</li>
                                <li>Share advice on therapy techniques and interventions.</li>
                            </ul>
                            <a href="#forum" class="text-primary">Join the Forum</a>
                        </div>
                    </div>
                    <!-- Scheduling Feature -->
                    <div class="col-md-12 mb-3">
                        <div class="box text-left p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                            <h3>Scheduling</h3>
                            <p>Schedule an appointment for your child's autism diagnostic test and take the first step towards understanding their needs.</p>
                            <ul class="text-left text-gray-600 list-disc list-inside">
                                <li>Choose a convenient time for your appointment.</li>
                                <li>Get reminders for your scheduled appointments.</li>
                            </ul>
                            <a href="#schedule" class="text-primary">Book an Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid contact mt-4" id="contact">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="contact-card p-4">
                <h2 class="contact-title">Contact Us</h2>
                <p class="contact-text">At Aid of Angels Therapy and Learning Center, we are committed to providing families with the resources and support they need to navigate the journey of autism.
                    Whether you're looking to schedule a diagnostic test or learn more about our personalized therapy services, we're here to help.</p>
                <a href="#" class="btn btn-primary">Learn More</a>
               </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="contact-card-connect">
                <h2 class="contact-title-connect">Stay Connected</h2>
                <p class="contact-text-connect">Join our community for the latest updates and resources on autism.</p>
                <div class="d-flex justify-content-center">
                <a href="{{ route('user.register') }}" class="btn main-btn rounded-pill px-6 py-3 shadow-lg text-white font-semibold">
            Join Us!
        </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="footer text-center text-lg-start bg-gray-900 text-white">
        <div class="container">
            <div class="row py-8">
                <div class="col-lg-4 col-md-12 footer-logo text-lg-left text-center mb-6 mb-lg-0">
                    <img src="img/logo.png" alt="Logo" class="img-fluid mb-4" style="max-width: 120px;">
                    <p class="text-sm font-light text-gray-400">© 2025 Aid of Angels, Inc. All rights reserved.</p>
                </div>

                <div class="col-lg-8 col-md-12 footer-links">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 footer-column mb-4 mb-lg-0">
                            <h4 class="text-xl font-bold mb-4 ">Quick Links:</h4>
                            <ul class="list-unstyled space-y-2">
                                <li><a href="#home" class="hover:text-primary-light transition">Home</a></li>
                                <li><a href="#services" class="hover:text-primary-light transition">Services</a></li>
                                <li><a href="#about" class="hover:text-primary-light transition">About</a></li>
                                <li><a href="#contact" class="hover:text-primary-light transition">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Resources -->
                        <div class="col-lg-4 col-md-4 footer-column mb-4 mb-lg-0">
                            <h4 class="text-xl font-bold mb-4">Resources:</h4>
                            <ul class="list-unstyled space-y-2">
                                <li><a href="#autism-info" class="hover:text-primary-light transition">Autism Information</a></li>
                                <li><a href="#therapy-guides" class="hover:text-primary-light transition">Therapy Guides</a></li>
                                <li><a href="#location" class="hover:text-primary-light transition">Location & Directions</a></li>
                                <li><a href="#faqs" class="hover:text-primary-light transition">FAQs</a></li>
                            </ul>
                        </div>
                        <!-- Connect With Us -->
                        <div class="col-lg-4 col-md-4 footer-column">
                            <h4 class="text-xl font-bold mb-4">Connect With Us:</h4>
                            <ul class="list-unstyled space-y-2">
                                <li><a href="#facebook" class="hover:text-primary-light transition">Facebook</a></li>
                                <li><a href="#twitter" class="hover:text-primary-light transition">Twitter</a></li>
                                <li><a href="#instagram" class="hover:text-primary-light transition">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>
    
document.addEventListener("DOMContentLoaded", () => {
    // Aggressive Intro Effect
    const introElements = document.querySelectorAll(".intro-effect");
    introElements.forEach((el, index) => {
      setTimeout(() => {
        el.classList.add("intro-zoomIn");
        el.classList.remove("opacity-0", "-translate-y-20", "scale-75");
      }, index * 250); // Faster stagger
    });

    // Scroll-triggered effect logic
    const scrollElements = document.querySelectorAll(".intro-effect");
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // Aggressive scroll-in effect
            entry.target.classList.add("scroll-bounceIn");
            entry.target.classList.remove("scroll-bounceOut");
          } else {
            // Aggressive scroll-out effect
            entry.target.classList.remove("scroll-bounceIn");
            entry.target.classList.add("scroll-bounceOut");
          }
        });
      },
      { threshold: 0.3 }
    );

    scrollElements.forEach((el) => observer.observe(el));
  });


  /* // Wait for the window to load completely
window.onload = function() {
    // Hide the preloader after the page has loaded
    document.getElementById('preloader').style.display = 'none';
}

// Get the button and preloader elements
const getStartedButton = document.getElementById('getStartedButton');
const preloader = document.getElementById('preloader');

// When the button is clicked, show the preloader and prevent the default link behavior
getStartedButton.onclick = function(event) {
    event.preventDefault();  // Prevent the default navigation behavior
    preloader.style.display = 'flex';  // Show the preloader

    // Simulate a delay (replace this with actual logic if needed)
    setTimeout(function() {
        preloader.style.display = 'none';  // Hide the preloader after the delay
        $('#registerModal').modal('show'); // Show the register modal
    }, 1000);  // Wait for 0.9 seconds before showing the modal (adjust the time as needed)
};
*/

$(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar').addClass('scrolled');
    } else {
        $('.navbar').removeClass('scrolled');
    }
});



</script>
</html>