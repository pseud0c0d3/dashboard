<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>   
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="Brand Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="color: white;">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <header class="jumbotron text-center" style="background-image: url('img/bck.png'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="display-4">Aid of Angels Therapy and Learning Center</h1>
            <p class="lead">Welcome to our website, where we offer comprehensive diagnostic <br>testing and personalized support for children with autism.</p>
            <a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </header>

    <!-- About Us Section -->
    <div class="container my-5 about-us-container"> 
        <h2 class="text-center">About Us</h2>
        <p class="text-center">
            At Aid of Angels Therapy and Learning Center, we are dedicated to providing
            personalized support and diagnostic services for children with autism.
            Our experienced team is here to help every child thrive and reach their full potential.
        </p>
        <div class="text-center">
            <a href="{{ route('loggedOut/seemore') }}" class="btn btn-primary">See More</a>
        </div>
    </div>

    <!-- Services Section -->
    <div class="container my-5 services-container"> 
        <h2 class="text-center">Our Services</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="service-box">
                    <i class="fas fa-brain fa-3x mb-3" style="color: #ff8bbb;"></i>
                    <h5>Comprehensive Evaluation</h5>
                    <p>We provide thorough evaluations to identify each child's unique needs.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="service-box">
                    <i class="fas fa-heart fa-3x mb-3" style="color: #ff0000;"></i> 
                    <h5>Personalized Therapy</h5>
                    <p>Our therapy sessions are tailored to suit the individual requirements of each child.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="service-box">
                    <i class="fas fa-users fa-3x mb-3" style="color: #1e90ff;"></i> 
                    <h5>Supportive Community</h5>
                    <p>We foster a nurturing community that supports both children and their families.</p>
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

    <div class="additional-container" style="background-image: url('img/pic4.png'); background-size: cover; background-position: center; height: auto; padding: 0;">
        <div class="container text-dark" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <div class="box founder-box text-center p-4" style="background-color: white; border-radius: 10px; width: 90%;">
                        <h3>Meet Our Founder</h3>
                        <img src="img/founder.png" alt="Founder" class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px;">
                        <p>Discover the vision and passion of our founder who established this center to support families.</p>
                        <a href="#" class="text-primary">Learn More</a>
                    </div>
                </div>

                <div class="col-md-8 d-flex flex-column justify-content-center">
                    <div class="row">
                        <!-- About the Center -->
                        <div class="col-md-12 mb-3">
                            <div class="box text-left p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                                <h3>About the Center</h3>
                                <p>Aid of Angels Therapy and Learning Center was founded with the goal of empowering families and children on the autism spectrum. Our team of experienced professionals is dedicated to providing personalized care.</p>
                                <a href="#" class="text-primary">Read More</a>
                            </div>
                        </div>
                    
                        <!-- Schedule Consultation -->
                        <div class="col-md-12 mb-3">
                            <div class="box text-left p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                                <h3>Schedule Consultation</h3>
                                <p>At Aid of Angels, we understand that every child is unique and that their needs can change over time. That’s why we work closely with each family to adjust treatment plans as needed!</p>
                                <a href="#" class="text-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" features">
        <div class="features-section">
            <!-- Forum Feature -->
            <div class="feature-box">
                <h3>Forum</h3>
                <p>Join the discussion with other parents and professionals to share insights, tips, and resources related to autism therapy and support.</p>
            </div>

            <!-- Workspace Feature -->
            <div class="feature-box">
                <h3>Workspace</h3>
                <p>This is your dedicated workspace to organize documents, notes, and tasks related to your child's therapy.</p>
            </div>

            <!-- Scheduling Feature -->
            <div class="feature-box">
                <h3>Scheduling</h3>
                <p>Schedule an appointment for your child's autism diagnostic test.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid contact mt-4"> 
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="contact-card p-4">
                    <h2 class="contact-title">Contact Us</h2>
                    <p class="contact-text">At Aid of Angels Therapy and Learning Center, we are committed to providing families with the resources and support they need to navigate the journey of autism. 
                        Whether you're looking to schedule a diagnostic test or learn more about our personalized therapy services, we're here to help.</p>
                    <a href="#" class="btn btn-primary" >Learn More</a>
                    <button class="btn btn-secondary">Schedule a Test</button>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="contact-card-connect">
                    <h2 class="contact-title-connect" >Stay Connected</h2>
                    <p class="contact-text-connect">Join our community for the latest updates and resources on autism.</p>
                    <div class="d-flex justify-content-center">
                        <button class="btn join-button w-50" data-toggle="modal" data-target="#registerModal">Join Us</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center text-lg-start">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-4 col-md-12 footer-logo">
                    <img src="img/logo.png" alt="Logo" class="img-fluid mb-3">
                    <p class="footer-copyright">© 2024 Aid of Angels, Inc. All rights reserved.</p>
                </div>
                <div class="col-lg-8 col-md-12 footer-links">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 footer-column">
                            <h4>Quick Links:</h4>
                            <ul class="list-unstyled">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 footer-column">
                            <h4>Resources:</h4>
                            <ul class="list-unstyled">
                                <li><a href="#autism-info">Autism Information</a></li>
                                <li><a href="#therapy-guides">Therapy Guides</a></li>
                                <li><a href="#location">Location & Directions</a></li>
                                <li><a href="#faqs">FAQs</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 footer-column">
                            <h4>Connect With Us:</h4>
                            <ul class="list-unstyled">
                                <li><a href="#facebook">Facebook</a></li>
                                <li><a href="#twitter">Twitter</a></li>
                                <li><a href="#instagram">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="height: 90vh;">
            <div class="row no-gutters" style="height: 100%;">
                <div class="col-md-6" style="height: 100%;">
                    <img src="img/modpic.jpg" class="img-fluid" alt="Family Image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between" style="height: 100%; padding: 20px;">
                    <div class="modal-header border-0 p-0 mb-3 d-flex justify-content-between align-items-start">
                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <!-- Logo Section -->
                        <img src="img/icon.png" alt="Logo" class="logo-img" style="max-width: 80%; margin-bottom: 20px;">

                        
                        <h5 class="text-left" style="margin-bottom: 20px;">LOG IN</h5>
                        <form>
                            <!-- Email Floating Label -->
                            <div class="form-row">
                                <input type="email" class="form-control form-control-sm" id="loginEmail" placeholder=" " required>
                                <label for="loginEmail">Email</label>
                            </div>
                            <!-- Password Floating Label -->
                            <div class="form-row mt-3">
                                <input type="password" class="form-control form-control-sm" id="loginPassword" placeholder=" " required>
                                <label for="loginPassword">Password</label>
                            </div>
                            <!-- Remember Me Checkbox -->
                            <div class="form-check mt-3" style="margin-left: -60px;">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe" style="font-size: 0.85rem;">
                                    Remember Me
                                </label>
                                <a href="#" style="color: #0066cc; float: right;">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning text-black w-100 mb-4" style="font-size: 0.85rem; border-radius: 5px;" onclick="submitForm()">SUBMIT</button>
                        <div class="mt">
                            <span style="font-size: 0.85rem;">Don't have an account? </span>
                            <a href="#" id="registerLink" style="color: #0066cc;">Register here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="height: 90vh;">
            <div class="row no-gutters" style="height: 100%;">
                <div class="col-md-6" style="height: 100%;">
                    <img src="img/modpic.jpg" class="img-fluid" alt="Family Image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between" style="height: 100%; padding: 20px;">
                    <div class="modal-header border-0 p-0 mb-1 d-flex justify-content-between align-items-start">
                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-left">REGISTER</h5>
                        <form>
                            <!-- Full Name Floating Label -->
                            <div class="form-row mb-3">
                                <input type="text" class="form-control form-control-sm" id="fullName" placeholder=" " required>
                                <label for="fullName">Full Name</label>
                            </div>
                            <!-- Email Floating Label -->
                            <div class="form-row mb-3">
                                <input type="email" class="form-control form-control-sm" id="registerEmail" placeholder=" " required>
                                <label for="registerEmail">Email Address</label>
                            </div>
                            <!-- Username Floating Label -->
                            <div class="form-row mb-3">
                                <input type="text" class="form-control form-control-sm" id="username" placeholder=" " required>
                                <label for="username">Username</label>
                            </div>
                            <!-- Password Floating Label -->
                            <div class="form-row mb-3">
                                <input type="password" class="form-control form-control-sm" id="registerPassword" placeholder=" " required>
                                <label for="registerPassword">Password</label>
                            </div>
                            <!-- Repeat Password Floating Label -->
                            <div class="form-row mb-3">
                                <input type="password" class="form-control form-control-sm" id="repeatPassword" placeholder=" " required>
                                <label for="repeatPassword">Repeat Password</label>
                            </div>
                            <!-- Terms Checkbox -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                                <label class="form-check-label" for="termsCheckbox" style="font-size: 0.85rem;">
                                    I agree to <a href="#">Terms of Use</a>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning text-black w-100 mb-4" style="font-size: 0.85rem; border-radius: 5px;" onclick="submitForm()">SUBMIT</button>
                        <div class="mt">
                            <span style="font-size: 0.85rem;">Already have an account? </span>
                            <a href="#" id="loginLink" style="color: #0066cc;">Log in here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar').addClass('scrolled');
    } else {
        $('.navbar').removeClass('scrolled');
    }
});

document.getElementById('registerLink').addEventListener('click', function(event) {
    event.preventDefault();
    $('#loginModal').modal('hide'); 
    $('#registerModal').modal('show'); 
});
    
document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault();
    $('#loginModal').modal('show');
    $('#registerModal').modal('hide'); 
});

function submitForm() {
    alert('Form submitted!');
}
</script>
</body>
</html>
