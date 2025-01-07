<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo Quest - Level 1</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        canvas {
            display: block;
        }
        .message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            display: none;
        }
        .difficulty-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 2rem;
            flex-direction: column;
        }
        .difficulty-overlay button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1.5rem;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background: #007BFF;
            color: white;
        }
        .fog {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(128, 128, 128, 0.9);
            pointer-events: none;
            z-index: 1;
            display: none;
        }
        .home-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
        .home-container button {
            padding: 10px 20px;
            font-size: 1.5rem;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background: #007BFF;
            color: white;
            margin-top: 10px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="home-container" id="homeContainer">
        <h1>Welcome to Echo Quest!</h1>
        <button onclick="startGame()">Start Game</button>
        <button onclick="quitGame()">Quit Game</button>
    </div>

    <div class="difficulty-overlay" id="difficultyOverlay">
        <div>Select Difficulty:</div>
        <button onclick="setDifficulty(1)">Easy</button>
        <button onclick="setDifficulty(2)">Medium</button>
        <button onclick="setDifficulty(3)">Hard</button>
    </div>

    <div class="message" id="winMessage">
        <div>You Escaped!</div>
        <div class="buttons">
            <button onclick="resetGame()">Play Again</button>
            <button onclick="exitGame()">Exit</button>
        </div>
    </div>

    <div class="message" id="lossMessage">
        <div>You Hit an Obstacle!</div>
        <div class="buttons">
            <button onclick="resetGame()">Play Again</button>
            <button onclick="exitGame()">Exit</button>
        </div>
    </div>

    <div class="fog" id="fog"></div>

    <canvas id="gameCanvas"></canvas>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const fog = document.getElementById('fog');
        const fogCanvas = document.createElement('canvas');
        const fogCtx = fogCanvas.getContext('2d');
        fogCanvas.width = canvas.width;
        fogCanvas.height = canvas.height;
        fog.appendChild(fogCanvas);

        // Game Variables
        const player = {
            x: canvas.width / 2,
            y: canvas.height / 2,
            size: 20,
            color: 'blue',
        };

        const goal = {
            x: Math.random() * (canvas.width - 50) + 25,
            y: Math.random() * (canvas.height - 50) + 25,
            size: 30,
            color: 'green',
        };

        let obstacles = [];
        let difficulty = 1; // Default difficulty

        const movement = {
            up: false,
            down: false,
            left: false,
            right: false,
        };

        // Audio setup (remains the same)
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const masterGain = audioContext.createGain();

        oscillator.type = 'sine';
        oscillator.frequency.setValueAtTime(440, audioContext.currentTime);
        masterGain.gain.setValueAtTime(0.0, audioContext.currentTime); // Lower volume to 20%
        oscillator.connect(masterGain);
        masterGain.connect(audioContext.destination);
        oscillator.start();

        const dangerOscillator = audioContext.createOscillator();
        const dangerGain = audioContext.createGain();

        dangerOscillator.type = 'square';
        dangerOscillator.frequency.setValueAtTime(0, audioContext.currentTime);
        dangerGain.gain.setValueAtTime(0.05, audioContext.currentTime); // Lower volume to 20%
        dangerOscillator.connect(dangerGain);
        dangerGain.connect(audioContext.destination);
        dangerOscillator.start();

        function updateAudio() {
            const dx = player.x - goal.x;
            const dy = player.y - goal.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            oscillator.frequency.setValueAtTime(200 + 600 * (1 - distance / canvas.width), audioContext.currentTime);

            let dangerZone = false;
            for (const obstacle of obstacles) {
                const ox = player.x - obstacle.x;
                const oy = player.y - obstacle.y;
                const obstacleDistance = Math.sqrt(ox * ox + oy * oy);
                if (obstacleDistance < player.size + obstacle.size + 50) {
                    dangerZone = true;
                    break;
                }
            }
            dangerOscillator.frequency.setValueAtTime(dangerZone ? 400 : 0, audioContext.currentTime);
        }

        function setDifficulty(level) {
            if (audioContext.state === 'suspended') {
                audioContext.resume();
            }
            difficulty = level;
            generateObstacles();
            document.getElementById('difficultyOverlay').style.display = 'none';
            fog.style.display = 'block'; // Show fog after difficulty selection
            update();
        }

        function generateObstacles() {
            obstacles = [];
            const obstacleCount = difficulty * 5; // More obstacles for higher difficulty
            for (let i = 0; i < obstacleCount; i++) {
                obstacles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: 30,
                    color: 'red',
                });
            }
        }

        // Fog Drawing
        function updateFog() {
            fogCtx.clearRect(0, 0, fogCanvas.width, fogCanvas.height);
            fogCtx.fillStyle = 'rgba(128, 128, 128, 0.9)';
            fogCtx.fillRect(0, 0, fogCanvas.width, fogCanvas.height);

            fogCtx.globalCompositeOperation = 'destination-out';
            fogCtx.beginPath();
            fogCtx.arc(player.x, player.y, player.size + 50, 0, Math.PI * 2);
            fogCtx.fill();
            fogCtx.globalCompositeOperation = 'source-over';
        }

        // Game Loop
        function update() {
            if (movement.up && player.y > player.size) player.y -= 5;
            if (movement.down && player.y < canvas.height - player.size) player.y += 5;
            if (movement.left && player.x > player.size) player.x -= 5;
            if (movement.right && player.x < canvas.width - player.size) player.x += 5;

            updateAudio();
            updateFog();

            // Check for collision with goal
            const dx = player.x - goal.x;
            const dy = player.y - goal.y;
            if (Math.sqrt(dx * dx + dy * dy) < player.size + goal.size) {
                document.getElementById('winMessage').style.display = 'block';
                fog.style.display = 'none'; // Hide fog when the game is won
                return;
            }

            // Check for collision with obstacles
            for (const obstacle of obstacles) {
                const ox = player.x - obstacle.x;
                const oy = player.y - obstacle.y;
                if (Math.sqrt(ox * ox + oy * oy) < player.size + obstacle.size) {
                    document.getElementById('lossMessage').style.display = 'block';
                    fog.style.display = 'none'; // Hide fog when the game is lost;
                    return;
                }
            }

            draw();
            requestAnimationFrame(update);
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw Goal
            ctx.fillStyle = goal.color;
            ctx.beginPath();
            ctx.arc(goal.x, goal.y, goal.size, 0, Math.PI * 2);
            ctx.fill();

            // Draw Obstacles
            for (const obstacle of obstacles) {
                ctx.fillStyle = obstacle.color;
                ctx.beginPath();
                ctx.arc(obstacle.x, obstacle.y, obstacle.size, 0, Math.PI * 2);
                ctx.fill();
            }

            // Draw Player
            ctx.fillStyle = player.color;
            ctx.beginPath();
            ctx.arc(player.x, player.y, player.size, 0, Math.PI * 2);
            ctx.fill();
        }

        function resetGame() {
            player.x = canvas.width / 2;
            player.y = canvas.height / 2;
            goal.x = Math.random() * (canvas.width - 50) + 25;
            goal.y = Math.random() * (canvas.height - 50) + 25;
            generateObstacles();
            document.getElementById('winMessage').style.display = 'none';
            document.getElementById('lossMessage').style.display = 'none';
            // Keep fog visible
            fog.style.display = 'block';
            update();
        }

        function exitGame() {
            // This function will reload the page (simulating exit)
            window.location.reload();
        }

        // Event Listeners
        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowUp') movement.up = true;
            if (e.key === 'ArrowDown') movement.down = true;
            if (e.key === 'ArrowLeft') movement.left = true;
            if (e.key === 'ArrowRight') movement.right = true;
            if (e.key === 'r') resetGame();
        });

        window.addEventListener('keyup', (e) => {
            if (e.key === 'ArrowUp') movement.up = false;
            if (e.key === 'ArrowDown') movement.down = false;
            if (e.key === 'ArrowLeft') movement.left = false;
            if (e.key === 'ArrowRight') movement.right = false;
        });

        // Start Game
        function startGame() {
            document.getElementById('homeContainer').style.display = 'none';
            document.getElementById('difficultyOverlay').style.display = 'flex'; // Show difficulty selection
        }

        // Quit Game
        function quitGame() {
            window.location.reload(); // Reload the page (simulating exit)
        }

    </script>
</body>
</html>
