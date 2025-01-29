
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
    color: black; 
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
/* Initial hidden state */
.service-box {
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

/* Fade-in and slide-up effect when in view */
.service-box.in-view {
    opacity: 1;
    transform: translateY(0);
}

/* Initial hidden state for text */
.empowering-families-text {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

/* Slide-in effect when in view */
.empowering-families-text.in-view {
    opacity: 1;
    transform: translateX(0);
}


/* Add this CSS to your stylesheet */
@keyframes popUp {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.box {
    opacity: 0; /* Initially hidden */
    transform: scale(0.8); /* Initially scaled down */
    transition: opacity 0.6s ease-out, transform 0.6s ease-out; /* Smooth transition */
}

.box.visible {
    opacity: 1;
    transform: scale(1); /* Trigger the pop-up effect */
}
        
</style>
<body>

 <!-- Include Preloader -->
 @include('components.preloader')

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
    <a href="{{ route('user.login') }}" class="btn  rounded-pill px-6 py-3 shadow-lg text-white font-semibold" id="getButton">
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
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl ">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-brain fa-4x text-primary"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Comprehensive Evaluation</h5>
                <p>We provide thorough evaluations to identify each child's unique needs, ensuring the right support.</p>
            </div>
        </div>
        <!-- Personalized Therapy -->
        <div class="col-md-4 text-center mb-4">
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl ">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-heart fa-4x text-danger"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Personalized Therapy</h5>
                <p>Our therapy sessions are tailored to suit the individual requirements of each child, promoting growth and development.</p>
            </div>
        </div>
        <!-- Supportive Community -->
        <div class="col-md-4 text-center mb-4">
            <div class="service-box p-5 rounded-lg transition-all transform hover:scale-105 hover:shadow-xl">
                <div class="service-icon-container mb-3">
                    <i class="fas fa-users fa-4x text-info"></i>
                    <i class="fas fa-cogs fa-4x text-muted placeholder-icon"></i>
                </div>
                <h5 class="font-weight-bold mb-3 text-dark">Supportive Community</h5>
                <p>We foster a nurturing community that supports both children and their families, creating a safe space for growth.</p>
            </div>
        </div>
    </div>
</div>

<!-- Empowering Families Section -->
<div class="empowering-families-container">
    <div class="row">
        <div class="col-md-6">
            <img src="img/modpic.jpg" alt="Empowering Families" class="empowering-families-image">
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
        <a href="{{ route('seemore') }}" class="btn btn-primary text-black hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-full px-6 transition duration-300" id="learnButton" style="background: linear-gradient(135deg, #3a63d5, #1b3248);">
            Learn More
        </a>
    </div>
</div>

<div class="additional-container" style="background-image: url('img/pic03.png'); background-size: cover; background-position: center; padding: 0; " >
    <div class="container text-dark">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center justify-content-center mb-4">
                <div class="box founder-box text-center p-4" style="background-color: white; border-radius: 10px; width: 90%;">
                    <img src="img/founder.png" alt="Founder" class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px; ">
                    <h3>Founder</h3>
                    <p>Discover the vision and passion of our founder who established this center to support families.</p>
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
                            <a href="{{ route('user.register') }}" id="forumButton" class="text-primary">Join the Forum</a>
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
                            <a href="{{ route('user.register') }}" id="bookButton" class="text-primary">Book an Appointment</a>
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
    <p class="contact-text">
        At Aid of Angels Therapy and Learning Center, we are committed to providing families with the resources and support they need to navigate the journey of autism.
        Whether you're looking to schedule a diagnostic test or learn more about our personalized therapy services, we're here to help.
        <span class="extra-text" style="display: none;">
            Our team is dedicated to ensuring that each family receives the best care and resources tailored to their unique needs. We believe in creating a welcoming and supportive environment for both parents and children.
        </span>
    </p>
    <button class="btn btn-primary mx-auto mt-3 toggle-text" data-target=".extra-text">Read More</button>
</div>


        </div>
        <div class="col-12 col-md-6">
            <div class="contact-card-connect">
                <h2 class="contact-title-connect">Stay Connected</h2>
                <p class="contact-text-connect">Join our community for the latest updates and resources on autism.</p>
                <div class="d-flex justify-content-center">
                <a href="{{ route('user.register') }}" id="joinButton" class="btn main-btn rounded-pill px-6 py-3 shadow-lg text-white font-semibold">
            Join Us!
        </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-right text-lg-start text-white" id="more">
    <div class="container">
        <div class="row py-9">
            <div class="col-lg-4 col-md-12 footer-logo text-lg-left text-center mb-6 mb-lg-0">
                <img src="img/logo.png" alt="Logo" class="img-fluid mb-4" style="max-width: 120px;">
                <p class="text-sm font-light text-gray-400">© 2025 Aid of Angels, Inc. All rights reserved.</p>
            </div>

            <div class="col-lg-8 col-md-12 footer-links text-lg-center">
                <div class="row justify-content-lg-end">
                    <div class="col-lg-4 col-md-4 footer-column mb-4 mb-lg-0">
                        <h4 class="text-xl font-bold mb-4">Quick Links:</h4>
                        <ul class="list-unstyled space-y-2">
                            <li><a href="#home" class="hover:text-primary-light transition">Home</a></li>
                            <li><a href="#services" class="hover:text-primary-light transition">Services</a></li>
                            <li><a href="#about" class="hover:text-primary-light transition">About</a></li>
                            <li><a href="#contact" class="hover:text-primary-light transition">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Connect With Us -->
                    <div class="col-lg-4 col-md-4 footer-column">
                        <h4 class="text-xl font-bold mb-4">Connect With Us:</h4>
                        <ul class="list-unstyled space-y-2">
                            <li><a href="https://www.facebook.com/aidofangels/" class="hover:text-primary-light transition"id="link1">Facebook</a></li>
                            <li><a href="https://www.instagram.com/explore/locations/203403116344468/aid-of-angels-therapy-and-learning-center/" class="hover:text-primary-light transition"id="link2">Instagram</a></li>
                            <li><a href="https://maps.app.goo.gl/YPJuF3HFWuVuqPgx7" class="hover:text-primary-light transition" id="link3">Location & Directions</a></li>
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

  document.querySelector('.toggle-text').addEventListener('click', function() {
        var extraText = document.querySelector('.extra-text');
        var button = this;
        
        if (extraText.style.display === "none") {
            extraText.style.display = "inline";
            button.textContent = "Read Less";
        } else {
            extraText.style.display = "none";
            button.textContent = "Read More";
        }
    });

// Detect when elements are in view
const serviceBoxes = document.querySelectorAll('.service-box');
const empoweringText = document.querySelector('.empowering-families-text');

const checkInView = () => {
    const windowHeight = window.innerHeight;
    
    // Check service boxes
    serviceBoxes.forEach((box) => {
        const boxTop = box.getBoundingClientRect().top;
        const boxBottom = box.getBoundingClientRect().bottom;

        if (boxTop < windowHeight - 100 && boxBottom > 0) {
            box.classList.add('in-view');
        } else {
            box.classList.remove('in-view');
        }
    });

    // Check empowering text
    const textTop = empoweringText.getBoundingClientRect().top;
    const textBottom = empoweringText.getBoundingClientRect().bottom;

    if (textTop < windowHeight - 100 && textBottom > 0) {
        empoweringText.classList.add('in-view');
    } else {
        empoweringText.classList.remove('in-view');
    }
};

// Initial check on page load
window.addEventListener('load', () => {
    checkInView();
});

// Check on scroll
window.addEventListener('scroll', () => {
    checkInView();
});

document.addEventListener('DOMContentLoaded', function () {
    const boxes = document.querySelectorAll('.box');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                entry.target.classList.remove('visible'); // Remove the class when it's out of view
            }
        });
    }, { threshold: 0.5 }); // Trigger when 50% of the box is in view

    boxes.forEach(box => {
        observer.observe(box);
    });
});


// Function to show preloader and then navigate to the href
function showPreloaderAndRedirect(event) {
  event.preventDefault();  // Prevent the default behavior of the link
  
  // Show the preloader
  document.getElementById('preloader').style.display = 'flex';
  
  // Get the href from the clicked link
  const href = event.target.getAttribute('href');
  
  // Redirect after a short delay (1.5 seconds in this case)
  setTimeout(function() {
    window.location.href = href;
  }, 1500);  // Adjust the delay as needed
}

// Attach event listener to the 'Get Started' button
document.getElementById('getButton').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('learnButton').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('joinButton').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('forumButton').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('link1').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('link2').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('link3').addEventListener('click', showPreloaderAndRedirect);


$(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar').addClass('scrolled');
    } else {
        $('.navbar').removeClass('scrolled');
    }
});



</script>
</html>