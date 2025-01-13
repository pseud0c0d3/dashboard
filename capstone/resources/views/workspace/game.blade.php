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
    <p>Let's have fun and play a game to match the sounds with their categories (Land, Air, or Sea)!</p>
    <p id="highest-score-home">Highest Score: 0</p>
    <button id="start-game">Start Game 🎮</button>
    <button id="exit-home" onclick="exitGame()">Exit Game</button>
</div>


<!-- Instruction Modal -->
<div id="instruction-modal" class="modal-game">
    <div class="modal-content">
        <h2>Let's Play the Animal Sound Game!</h2>

        <p>👂🎵 Listen to the sound! Can you guess which category the animal belongs to?</p>
        <div>
            <p>🔊</p>
        </div>

        <p>Click the category picture (Land, Air, or Sea) that matches the sound you hear.</p>

        <button id="start-game-modal" style="font-size: 24px; padding: 20px; background-color: #4CAF50; color: white; border-radius: 10px;">
            Start the Game 🎮
        </button>
    </div>
</div>

    <!-- Game -->
    <div id="game-section" class="container" style="display: none;">
        <div id="timer" style="font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px;">Time: 0s</div>
        <h1>Guess the Animal Sound!</h1>
        <div id="options"></div>
        <p id="score">Score: 0</p>
        <p id="highest-score-game">Highest Score: 0</p>
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
