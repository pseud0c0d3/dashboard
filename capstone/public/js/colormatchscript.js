const startButton = document.getElementById('startButton');
const exitButton = document.getElementById('exitButton');
const quitButton = document.getElementById('quitButton');
const board = document.getElementById('board');
const timerDisplay = document.getElementById('timer'); // Timer display element
const levelDisplay = document.getElementById('levelDisplay'); // Add this line for level display

let colors = [];
let flippedTiles = [];
let matchedTiles = 0;
let isGameOver = false;
let currentLevel = 1;
let timer;

const levelTiles = [4, 6, 8, 12, 14, 16, 18, 20]; // Number of tiles per level (increasing by 2 tiles per level)
const levelTimes = [25, 30, 45, 60, 70, 90, 100, 120]; // Increased time limits per level in seconds


// Helper function to generate random colors
function generateColors(totalPairs) {
  const colorArray = [];
  const colorList = ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A133FF', '#FF8C33', '#33FFF5', '#FF3333', '#8AFF33', '#FF33F5', '#33A1FF'];
  for (let i = 0; i < totalPairs; i++) {
    const color = colorList[i % colorList.length];
    colorArray.push(color, color);
  }
  return colorArray.sort(() => Math.random() - 0.5);
}

// Function to start the timer with adjusted time for autism-friendly gameplay
function startTimer(duration) {
  let timeRemaining = duration;
  timerDisplay.textContent = `Time: ${timeRemaining}s`;
  timerDisplay.style.display = 'block'; // Ensure timer is visible

  timer = setInterval(() => {
    timeRemaining--;
    timerDisplay.textContent = `Time: ${timeRemaining}s`;

    if (timeRemaining <= 10) {
      timerDisplay.style.color = 'red'; // Visual cue to show time is running out
    }

    if (timeRemaining <= 0) {
      clearInterval(timer);
      showCustomPopup('Time is up! Game over.', () => {
        startButton.style.display = 'block'; // Show start button again
        isGameOver = true; // Mark game as over
      });
    }
  }, 1000);
}


// Function to stop the timer
function stopTimer() {
  clearInterval(timer);
}

// Function to create the game board
function createBoard() {
  const totalTiles = levelTiles[currentLevel - 1]; // Get the number of tiles for the current level
  const totalPairs = totalTiles / 2;

  colors = generateColors(totalPairs);
  board.innerHTML = ''; // Clear board
  flippedTiles = [];
  matchedTiles = 0;
  isGameOver = false; // Reset game over state

  // Calculate grid dimensions
  let rows, columns;
  if (totalTiles === 8) {
    rows = 3;
    columns = 3;
  } else {
    columns = Math.ceil(Math.sqrt(totalTiles));
    rows = Math.ceil(totalTiles / columns);
  }
  board.style.gridTemplateColumns = `repeat(${columns}, 1fr)`;
  board.style.gridTemplateRows = `repeat(${rows}, 1fr)`;

  // Create tiles and append them to the board
  for (let i = 0; i < totalTiles; i++) {
    const tile = document.createElement('div');
    tile.classList.add('tile', 'flipped'); // Start with 'flipped' class to hide colors initially
    tile.dataset.color = colors[i];

    const front = document.createElement('div');
    front.classList.add('front');
    const back = document.createElement('div');
    back.classList.add('back');
    back.style.backgroundColor = colors[i];

    tile.appendChild(front);
    tile.appendChild(back);
    board.appendChild(tile);

    // Add click event listener to each tile
    tile.addEventListener('click', handleTileClick);
  }

  // Start the timer for the level
  const levelTime = levelTimes[currentLevel - 1];
  startTimer(levelTime);

  // Update the level display
  levelDisplay.textContent = `Level: ${currentLevel}`;
}

// Handle tile click event
function handleTileClick(e) {
  if (isGameOver || flippedTiles.length === 2) return;

  const tile = e.target.closest('.tile');
  if (flippedTiles.includes(tile) || !tile.classList.contains('flipped')) return;

  tile.classList.remove('flipped'); // Reveal the tile by removing 'flipped' class
  flippedTiles.push(tile);

  // Check if two tiles are flipped
  if (flippedTiles.length === 2) {
    checkForMatch();
  }
}

// Function to show a custom popup
function showCustomPopup(message, onClose) {
  // Create the popup container
  const popup = document.createElement('div');
  popup.classList.add('custom-popup');

  // Create the popup content
  const popupContent = document.createElement('div');
  popupContent.classList.add('custom-popup-content');

  // Add the message to the popup
  const popupMessage = document.createElement('p');
  popupMessage.textContent = message;
  popupContent.appendChild(popupMessage);

  // Add a close button
  const closeButton = document.createElement('button');
  closeButton.textContent = 'OK';
  closeButton.classList.add('custom-popup-button');
  popupContent.appendChild(closeButton);

  // Add the popup content to the popup container
  popup.appendChild(popupContent);
  document.body.appendChild(popup);

  // Add event listener to close the popup
  closeButton.addEventListener('click', () => {
    document.body.removeChild(popup);
    if (onClose) onClose(); // Execute the callback function if provided
  });
}

// Use the custom popup in place of alert
function checkForMatch() {
  const [tile1, tile2] = flippedTiles;
  if (tile1.dataset.color === tile2.dataset.color) {
    matchedTiles += 2;
    tile1.removeEventListener('click', handleTileClick);
    tile2.removeEventListener('click', handleTileClick);
    flippedTiles = [];

    if (matchedTiles === levelTiles[currentLevel - 1]) {
      stopTimer();
      if (currentLevel === levelTiles.length) {
        setTimeout(() => {
          showCustomPopup('You won the game! Congratulations!', () => {
            startButton.style.display = 'block';
          });
        }, 500);
      } else {
        setTimeout(() => {
          showCustomPopup(`Level ${currentLevel} complete! Get ready for the next level.`, () => {
            currentLevel++;
            createBoard();
          });
        }, 500);
      }
    }
  } else {
    setTimeout(() => {
      tile1.classList.add('flipped');
      tile2.classList.add('flipped');
      flippedTiles = [];
    }, 1000);
  }
}

// Start the game
startButton.addEventListener('click', () => {
  const homepage = document.getElementById('homepage');
  const gameContainer = document.getElementById('gameContainer');

  homepage.classList.add('hidden'); // Hide the homepage
  gameContainer.classList.remove('hidden'); 
  currentLevel = 1; // Reset to level 1
  createBoard(); // Initialize the game board
});

function exitGame() {
  // This function will reload the page (simulating exit)
  window.location.reload();
}

function quitGame() {
  window.location.href = "{{ url('/') }}"; // Redirect to the base URL
}

exitButton.addEventListener('click', () => {
  exitGame();
});

quitButton.addEventListener('click', () => {
  quitGame();
});

var loader = document.getElementById("preloader");
window.addEventListener("load", function () {
  loader.style.display = "none";
});
