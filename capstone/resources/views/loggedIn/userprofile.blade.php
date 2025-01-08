@extends('layouts.master')

@section('content')
            <div class="main-content">
                <div class="profile" id="profile-container">
                    <h2 class="profile-header">My Profile</h2>
                    <div class="profile-card">
                        <div class="profile-header-section position-relative">
                            <!-- Profile Image -->
                            <img src="/img/modpic.jpg" alt="Profile picture" class="profile-image rounded-circle" id="profile-image"      onclick="triggerFileInput()">

                            <!-- Hidden File Input for Image Upload -->
                            <input type="file" id="file-input" style="display: none;" accept="image/*" onchange="previewImage(event)">

                            <div class="profile-name-section">
                                <p class="profile-name"><strong id="profile-name">Joseph Chan</strong></p>
                                <p id="profile-role">Parent/Guardian</p>
                                <p id="profile-address">Amaya 2, Tanza Cavite</p>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Information Section -->
                <div class="info-section personal-info">
                    <div class="info-header">
                        <h3>Personal Information</h3>
                        <button class="edit-button" onclick="openModal('personalInfoModal')">Edit</button>
                    </div>
                    <div class="info-content">
                        <div class="info-row">
                            <div>
                                <p><strong>First Name:</strong></p>
                                <p id="first-name">Joseph</p>
                            </div>
                            <div>
                                <p><strong>Last Name:</strong></p>
                                <p id="last-name">Chan</p>
                            </div>
                        </div>
                        <div class="info-row">
                            <div>
                                <p><strong>Email:</strong></p>
                                <p id="email">josephchan@email.com</p>
                            </div>
                            <div>
                                <p><strong>Phone:</strong></p>
                                <p id="phone">09618357581</p>
                            </div>
                        </div>
                        <div class="info-row">
                          <div style="flex: 0 0 100%;">
                              <p><strong>Bio:</strong></p>
                              <p id="bio">Good bless</p>
                          </div>
                      </div>
                    </div>
                </div>

                <!-- Address Information Section -->
                <div class="info-section address-info">
                    <div class="info-header">
                        <h3>Address</h3>
                        <button class="edit-button" onclick="openModal('addressModal')">Edit</button>
                    </div>
                    <div class="info-content">
                        <div class="info-row">
                            <div>
                                <p><strong>Barangay:</strong></p>
                                <p id="barangay">Daang Amaya 2</p>
                            </div>
                            <div>
                                <p><strong>City:</strong></p>
                                <p id="city">Tanza</p>
                            </div>
                        </div>
                        <div class="info-row">
                            <div>
                                <p><strong>Postal Code:</strong></p>
                                <p id="postal-code">4108</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Modal -->
            <div id="profileModal" class="modal-custom">
                <div class="modal-content-custom">
                    <span class="close-custom" onclick="closeModal('profileModal')">&times;</span>
                    <h2>Edit Profile</h2>

                    <label for="editProfileName">Name</label>
                    <input type="text" id="editProfileName" value="Joseph Chan">

                    <label for="editProfileRole">Role</label>
                    <input type="text" id="editProfileRole" value="Parent/Guardian">

                    <label for="editProfileAddress">Address</label>
                    <input type="text" id="editProfileAddress" value="Amaya 2, Tanza Cavite">

                    <button class="save-button-custom" onclick="saveProfile()">Save</button>
                </div>
            </div>

            <!-- Edit Personal Information Modal -->
            <div id="personalInfoModal" class="modal-custom">
                <div class="modal-content-custom">
                    <span class="close-custom" onclick="closeModal('personalInfoModal')">&times;</span>
                    <h2>Edit Personal Information</h2>


                    <label for="editFirstName">First Name</label>
                    <input type="text" id="editFirstName" value="Joseph">

                    <label for="editLastName">Last Name</label>
                    <input type="text" id="editLastName" value="Chan">

                    <label for="editEmail">Email</label>
                    <input type="email" id="editEmail" value="josephchan@email.com">

                    <label for="editPhone">Phone Number</label>
                    <input type="text" id="editPhone" value="09618357581">

                    <label for="editBio">Bio</label>
                    <textarea id="editBio">Good bless</textarea>

                    <button class="save-button-custom" onclick="savePersonalInfo()">Save</button>
                </div>
            </div>

            <!-- Edit Address Modal -->
            <div id="addressModal" class="modal-custom">
                <div class="modal-content-custom">
                    <span class="close-custom" onclick="closeModal('addressModal')">&times;</span>
                    <h2>Edit Address</h2>

                    <label for="editBarangay">Barangay</label>
                    <input type="text" id="editBarangay" value="Daang Amaya 2">

                    <label for="editCity">City</label>
                    <input type="text" id="editCity" value="Tanza">

                    <label for="editPostalCode">Postal Code</label>
                    <input type="text" id="editPostalCode" value="4108">

                    <button class="save-button-custom" onclick="saveAddress()">Save</button>
                </div>

            </div>
        </div>

    </div>

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

        function updateProfile() {
            alert("Update profile functionality goes here.");
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

        function logout() {
            alert("Log out functionality goes here.");
        }
//<------------------------------------------------------------------------------------------------------------------------->

function triggerFileInput() {
    document.getElementById('file-input').click();
}

function previewImage(event) {
    const image = document.getElementById('profile-image');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
function saveProfile() {
    var name = document.getElementById("editProfileName").value;
    var role = document.getElementById("editProfileRole").value;
    var address = document.getElementById("editProfileAddress").value;
    document.getElementById("profile-name").textContent = name;
    document.getElementById("profile-role").textContent = role;
    document.getElementById("profile-address").textContent = address;
    closeModal("profileModal");
}

function savePersonalInfo() {
    var firstName = document.getElementById("editFirstName").value;
    var lastName = document.getElementById("editLastName").value;
    var email = document.getElementById("editEmail").value;
    var phone = document.getElementById("editPhone").value;
    var bio = document.getElementById("editBio").value;
    document.getElementById("first-name").textContent = firstName;
    document.getElementById("last-name").textContent = lastName;
    document.getElementById("email").textContent = email;
    document.getElementById("phone").textContent = phone;
    document.getElementById("bio").textContent = bio;
    closeModal("personalInfoModal");
}

function saveAddress() {
    var barangay = document.getElementById("editBarangay").value;
    var city = document.getElementById("editCity").value;
    var postalCode = document.getElementById("editPostalCode").value;
    document.getElementById("barangay").textContent = barangay;
    document.getElementById("city").textContent = city;
    document.getElementById("postal-code").textContent = postalCode;
    closeModal("addressModal");
}


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
            // Close settings dropdown
            const notificationsDropdown = document.getElementById('notificationsDropdown');
            if (notificationsDropdown.style.display === "block") {
                notificationsDropdown.style.display = "none";
            }
        };




    </script>


@endsection
