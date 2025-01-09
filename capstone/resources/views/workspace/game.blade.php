<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Sound Game</title>
    <link rel="stylesheet" href="/css/style1.css">
</head>
<body>
    <img src="/img/animal.jpg" alt="Background Image" class="background"></div>
    <!-- Home Section -->
    <div id="home-section" class="container">
        <h1>The Animal Sound Game!</h1>
        <p>Let's have fun and play a game to match the sounds with the animals!</p>
        <p id="highest-score-home">Highest Score: 0</p> <!-- Home section highscore -->
        <button id="start-game">Start Game</button>
        <button id="exit-home" onclick="exitGame()">Exit Game</button>
    </div>

    <!-- Game Section -->
    <div id="game-section" class="container" style="display: none;">
    <div id="timer" style="font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px;">Time: 0s</div>

        <h1>Guess the Animal Sound!</h1>
    
        <!-- Animal options -->
        <div id="options"></div>

        <p id="score">Score: 0</p>
        <p id="highest-score-game">Highest Score: 0</p>
    

        <!-- Quit Game Button -->
        <button id="quit-game">Quit Game</button>
    </div>

    <!-- Modal -->
    <div id="game-over-modal" class="modal">
        <div class="modal-content">
            <h2>Game Over</h2>
            <p id="final-score">Your Score: 0</p>
            <p id="highest-score-modal">Highest Score: 0</p> 
            <button id="restart-game">Restart Game</button>
        </div>
    </div>
    <script src="/js/gamescript.js"></script>
</body>
</html>
