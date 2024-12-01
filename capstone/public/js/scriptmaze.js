const player = document.getElementById('player');
const finish = document.getElementById('finish');
const mazeContainer = document.getElementById('maze-container');
const resetButton = document.getElementById('reset');
const message = document.getElementById('message');

const gridSize = 10; // Number of rows and columns
const wallCount = 25; // Number of walls to make it harder
let playerPosition = { x: 1, y: 1 };

// Generate random walls while ensuring accessibility
function createWalls() {
    // Clear existing walls
    const existingWalls = document.querySelectorAll('.wall');
    existingWalls.forEach((wall) => wall.remove());

    const wallPositions = [];
    let attempts = 0;

    while (wallPositions.length < wallCount && attempts < 1000) {
        attempts++;
        let x, y;

        do {
            x = Math.floor(Math.random() * gridSize) + 1;
            y = Math.floor(Math.random() * gridSize) + 1;
        } while (
            (x === 1 && y === 1) || // Player's starting position
            (x === gridSize && y === gridSize) || // Finish position
            wallPositions.some(pos => pos.x === x && pos.y === y) // Avoid overlapping walls
        );

        wallPositions.push({ x, y });

        // Check if walls block the path
        if (!isPathAccessible(wallPositions)) {
            wallPositions.pop(); // Remove wall if it blocks the path
        }
    }

    // Add walls to the maze
    wallPositions.forEach(pos => {
        const wall = document.createElement('div');
        wall.classList.add('wall');
        wall.style.gridColumn = pos.x;
        wall.style.gridRow = pos.y;
        mazeContainer.appendChild(wall);
    });
}

// Pathfinding check (Breadth-First Search)
function isPathAccessible(walls) {
    const queue = [{ x: 1, y: 1 }];
    const visited = Array.from({ length: gridSize }, () =>
        Array(gridSize).fill(false)
    );

    const wallSet = new Set(walls.map(pos => `${pos.x},${pos.y}`));
    visited[0][0] = true;

    const directions = [
        { dx: 0, dy: 1 },
        { dx: 1, dy: 0 },
        { dx: 0, dy: -1 },
        { dx: -1, dy: 0 },
    ];

    while (queue.length > 0) {
        const { x, y } = queue.shift();

        if (x === gridSize && y === gridSize) return true; // Reached the finish line

        for (const { dx, dy } of directions) {
            const nx = x + dx;
            const ny = y + dy;

            if (
                nx >= 1 &&
                nx <= gridSize &&
                ny >= 1 &&
                ny <= gridSize &&
                !visited[nx - 1][ny - 1] &&
                !wallSet.has(`${nx},${ny}`)
            ) {
                visited[nx - 1][ny - 1] = true;
                queue.push({ x: nx, y: ny });
            }
        }
    }

    return false; // No path to finish
}

// Move the player
function movePlayer(x, y) {
    const newX = playerPosition.x + x;
    const newY = playerPosition.y + y;

    // Prevent moving outside the maze
    if (newX < 1 || newX > gridSize || newY < 1 || newY > gridSize) return;

    // Prevent moving through walls
    const walls = document.querySelectorAll('.wall');
    for (let wall of walls) {
        const wallX = parseInt(window.getComputedStyle(wall).gridColumnStart);
        const wallY = parseInt(window.getComputedStyle(wall).gridRowStart);
        if (newX === wallX && newY === wallY) return;
    }

    playerPosition.x = newX;
    playerPosition.y = newY;

    player.style.gridColumn = playerPosition.x;
    player.style.gridRow = playerPosition.y;

    // Check if the player reached the finish point
    const finishX = parseInt(window.getComputedStyle(finish).gridColumnStart);
    const finishY = parseInt(window.getComputedStyle(finish).gridRowStart);
    if (playerPosition.x === finishX && playerPosition.y === finishY) {
        message.textContent = 'You win!';
    }
}

// Handle keyboard input
document.addEventListener('keydown', (e) => {
    switch (e.key) {
        case 'ArrowUp':
            movePlayer(0, -1);
            break;
        case 'ArrowDown':
            movePlayer(0, 1);
            break;
        case 'ArrowLeft':
            movePlayer(-1, 0);
            break;
        case 'ArrowRight':
            movePlayer(1, 0);
            break;
    }
});

// Reset button functionality
resetButton.addEventListener('click', () => {
    playerPosition = { x: 1, y: 1 };
    player.style.gridColumn = playerPosition.x;
    player.style.gridRow = playerPosition.y;
    message.textContent = '';
    createWalls(); // Regenerate walls
});

// Initialize the maze
createWalls();
