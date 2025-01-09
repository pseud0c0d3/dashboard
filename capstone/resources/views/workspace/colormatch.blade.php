<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Color Matching Game</title>
  
  <!-- Google Fonts Link for Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="/css/styling.css">
</head>
<body>
  <!-- Background Image -->
  <img src="/img/1.jpg" alt="Background Image" class="background">
  <div id="preloader">
  </div>
  
  <!-- Homepage Section -->
  <div id="homepage" class="homepage centered">
    <h1>The Color Matching Game</h1>
    <p>Match the colors to win! Click "Start Game" to begin.</p>
    <div class="button-container">
      <button id="startButton" class="button start-button">Start Game</button>
    </div>
    <button id="quitButton" class="button exit-button">Exit</button>
  </div>

  <!-- Game Section -->
  <div id="gameContainer" class="game-container hidden">
  

  <div id="timer" style="font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px;">Time: 0s</div>
<div id="levelDisplay">Level: 1</div>
    <div id="board" class="board"></div>
    <button id="exitButton" class="button quit-button">Quit</button>
  </div>

  <script src="{{ asset('/js/colormatchscript.js') }}"></script>
</body>
</html>
