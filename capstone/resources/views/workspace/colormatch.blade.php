<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Color Matching Game</title>
  <link rel="stylesheet" href="/css/styling.css">
</head>
<body>
  <!-- Background Image -->
  <img src="/img/1.jpg" alt="Background Image" class="background">
  <div id="preloader">
    
  </div>
  
    <!-- Homepage Section -->
    <div id="homepage" class="homepage centered">
            <h1>Welcome to the Color Matching Game</h1>
            <p>Match the colors to win! Click "Start Game" to begin.</p>
            <div class="button-container">
            <button id="startButton" class="button start-button">Start Game</button>
            </div>
            <button id="quitButton" class="button quit-button">Quit</button>

      </div>
      <!-- Game Section -->
      <div id="gameContainer" class="game-container hidden">
        <div id="board" class="board"></div>
        <div class="centered">
          <button id="exitButton" class="button quit-button">Quit</button>
        </div>
      </div>
  {{-- <div class="game-container">
    <div id="board" class="board">
      <button id="startButton" class="start-button"> Start Game</button>
      <button id="exitButton" class="start-button"> Exit</button>
    </div>
  </div> --}}
  

  <script src="{{ asset('/js/colormatchscript.js') }}"></script>
</body>
</html>


   