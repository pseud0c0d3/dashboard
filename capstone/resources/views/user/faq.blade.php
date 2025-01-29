@extends('layouts.user-nav')
@section('navbar_title', 'HELP') 
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>
    /* General Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .posts {
        margin-top: 80px;
        padding: 20px;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
        background: #fff;
        border-radius: 8px;
        background-color: rgba(13, 34, 58, 0.93);
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        overflow: hidden; /* Prevents scrolling */
    height: auto; /* Allows it to expand with content */
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 15px;
    }

    /* FAQ Section */
    .faq-section {
        margin-bottom: 30px;
    }

    .faq-item {
        background: #f1f1f1;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .faq-item:hover {
        background: #e0e0e0;
    }

    .faq-question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
    }

    .faq-answer {
        display: none;
        padding-top: 10px;
        color: #555;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    /* Forums Section */
    .forums-section {
        margin-bottom: 30px;
    }

    .step-instructions {
        padding-left: 20px;
    }

    /* Contact Section */
    .contact-section {
        text-align: center;
    }

    .contact-info {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .visit-info, .social-media {
        background: #f1f1f1;
        padding: 15px;
        border-radius: 5px;
        width: 45%;
        text-align: left;
        transition: all 0.3s ease-in-out;
    }

    .visit-info:hover, .social-media:hover {
        background: #e0e0e0;
    }

    .social-media a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .social-media a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .posts {
            width: 95%;
            padding: 15px;
        }

        .contact-info {
            flex-direction: column;
        }

        .visit-info, .social-media {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<main class="py-4">
    <div class="posts" id="postsContainer">
        <div class="content-container">
            <!-- FAQ Section -->
            <div class="faq-section">
                <h2>Frequently Asked Questions (FAQ)</h2>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Q: How do I use the website?</h3>
                        <i class="faq-toggle-icon">+</i>
                    </div>
                    <p class="faq-answer">A: To use the website, create an account, and upload your items to start organizing your wardrobe.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Q: How do I reset my password?</h3>
                        <i class="faq-toggle-icon">+</i>
                    </div>
                    <p class="faq-answer">A: Go to settings, select "Change Password," and follow the instructions.</p>
                </div>
            </div>

            <!-- Forums Section -->
            <div class="forums-section">
                <h2>Using the Main Features</h2>
                <h3>Forums</h3>
                <p><strong>Overview:</strong> The Forums provide a space for users to discuss topics, share experiences, and seek advice.</p>
                <h4>Step-by-Step Instructions:</h4>
                <ol class="step-instructions">
                    <li><strong>Accessing the Forums:</strong>
                        <ul>
                            <li>Click on the Forums section in the main menu.</li>
                            <li>Browse different categories and topics.</li>
                        </ul>
                    </li>
                    <li><strong>Creating a New Post:</strong>
                        <ul>
                            <li>Select a Forum category that matches your topic.</li>
                            <li>Click Create New Post.</li>
                            <li>Enter a title and write your message in the provided text box.</li>
                            <li>Click Post to publish your message.</li>
                        </ul>
                    </li>
                </ol>
            </div>

            <!-- Contact Section -->
            <div class="contact-section">
                <h2>Contact Us</h2>
                <p>If you have any questions or feedback, feel free to reach out to us:</p>
                <div class="contact-info">
                    <div class="visit-info">
                        <h4>Visit Us:</h4>
                        <p>San Juan General Trias, Cavite 4107<br>Inside, St. Francis School</p>
                        <h4>Business Hours:</h4>
                        <p>Mon-Fri: 8:00 AM – 5:00 PM</p>
                    </div>
                    <div class="social-media">
                        <h4>Follow Us:</h4>
                        <p><a href="https://www.facebook.com/aidofangels">Facebook</a></p>
                        <p><a href="https://www.instagram.com/aidofangels">Instagram</a></p>
                        <p><a href="https://www.twitter.com/aidofangels">Twitter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Interactive FAQ Section
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
            let icon = item.querySelector('.faq-toggle-icon');
            icon.textContent = item.classList.contains('active') ? '-' : '+';
        });
    });
</script>

@endsection
