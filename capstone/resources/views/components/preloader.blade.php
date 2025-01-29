<!-- Preloader -->
<div id="preloader" style="display: none;">
  <img src="img/angel.gif" alt="Loading..." class="floating-image">
</div>

<style>
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
  width: 350px;  /* Adjust width here */
  height: auto;  /* Maintain aspect ratio */
  animation: float 2s ease-in-out infinite;
}

@keyframes float {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px); /* Adjust the float distance */
  }
  100% {
    transform: translateY(0);
  }
}

</style>