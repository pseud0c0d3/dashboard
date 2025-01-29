<!-- Preloader -->
<div id="preloader">
  <img src="img/angel.gif" alt="Loading..." class="floating-image">
</div>

<style>
  /* Preloader Styles */
  #preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #f9fafb;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .floating-image {
    width: 350px; /* Adjust width here */
    height: auto; /* Maintain aspect ratio */
    animation: float 2s ease-in-out infinite;
  }

  @keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-20px); } /* Adjust the float distance */
    100% { transform: translateY(0); }
  }

</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Show the preloader
      document.getElementById("preloader").style.display = "flex";

      // Hide preloader after page fully loads
      window.onload = function () {
          setTimeout(function () {
              document.getElementById("preloader").style.display = "none";
          }, 1000); // 1-second delay for smooth transition
      };

      // Ensure preloader shows when using back button
      window.onpageshow = function(event) {
          if (event.persisted) { // If page is loaded from cache (back button)
              document.getElementById("preloader").style.display = "flex";
              setTimeout(function () {
                  document.getElementById("preloader").style.display = "none";
              }, 1000);
          }
      };
  });
</script>
