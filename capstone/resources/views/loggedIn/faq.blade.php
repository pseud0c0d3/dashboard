@extends('layouts.master')

@section('content')

    <!-- Main content and other structure -->
            
                <main class="py-4">
                <div class="posts" id="postsContainer">
                    <div class="content-container">
                        <!-- FAQ Section -->
                        <div class="faq-section">
                            <h2>Frequently Asked Questions (FAQ)</h2>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h3>Q: Lorem?</h3>
                                    <i class="faq-toggle-icon"></i>
                                </div>
                                <p class="faq-answer">A: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis turpis euismod.</p>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h3>Q: How do I use the website?</h3>
                                    <i class="faq-toggle-icon"></i>
                                </div>
                                <p class="faq-answer">A: To use the website, create an account, and upload your items to start organizing your wardrobe.</p>
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
            


       
        <!-- Calendar Modal Structure -->


<!------------------------------------------------------------------------------------------------------------------------------>
 <script>
            function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.add('show');
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.remove('show');
}
        // Show loading overlay for navigation
        function showLoading(url) {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex";
            setTimeout(() => {
                window.location.href = url;
            }, 2000);
        }

        function openNotifications() {
            toggleDropdown(event, 'notificationsDropdown');
        }

        function toggleSettingsDropdown() {
            toggleDropdown(event, 'settingsDropdown');
        }

        function changePassword() {
            alert("Change password functionality goes here.");
        }


        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }
        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isHidden = sidebar.style.display === 'none' || sidebar.style.display === '';
            sidebar.style.display = isHidden ? 'flex' : 'none';
        }


        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

//<------------------------------------------------------------------------------------------------------------------------->

// Select all FAQ items
const faqItems = document.querySelectorAll('.faq-item');

// Add click event listener to each FAQ item
faqItems.forEach(item => {
    item.addEventListener('click', () => {
        // Toggle 'active' class to show or hide the answer
        item.classList.toggle('active');
    });
});


        // Close dropdowns if clicked outside
        window.onclick = function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (dropdown.style.display === "block") {
                    dropdown.style.display = "none";
                }
            });

            // Close settings dropdown
            const settingsDropdown = document.getElementById('settingsDropdown');
            if (settingsDropdown.style.display === "block") {
                settingsDropdown.style.display = "none";
            }
        };




    </script>
@endsection
