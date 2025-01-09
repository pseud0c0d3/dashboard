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
let timerStarted = false; // Track if the timer has started

const levelTiles = [4, 6, 8, 12, 14, 16, 18, 20]; 
const levelTimes = [25, 30, 45, 60, 70, 90, 100, 120];

//function to generate random colors
function generateColors(totalPairs) {
  const colorArray = [];
  const colorList = ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A133FF', '#FF8C33', '#33FFF5', '#FF3333', '#8AFF33', '#FF33F5', '#33A1FF'];
  for (let i = 0; i < totalPairs; i++) {
    const color = colorList[i % colorList.length];
    colorArray.push(color, color);
  }
  return colorArray.sort(() => Math.random() - 0.5);
}

// Function to stop and reset the timer
function stopAndResetTimer() {
  clearInterval(timer); // Stop the previous timer if it exists
  timerStarted = false; // Reset the flag
  timerDisplay.textContent = 'Time: 0s'; // Reset the timer display
  timerDisplay.style.color = 'black'; // Reset color
}

// Function to start the timer with adjusted time
function startTimer(duration) {
  let timeRemaining = duration;
  let totalTimePlayed = 0; // Track the total time played

  timerDisplay.textContent = `Time: ${timeRemaining}s`; // Set initial time
  timerDisplay.style.display = 'block';

  timer = setInterval(() => {
    timeRemaining--;
    totalTimePlayed++;

    timerDisplay.textContent = `Time: ${timeRemaining}s`;

    if (timeRemaining <= 10) {
      timerDisplay.style.color = 'red'; //show time to be red when is running out
    }

    if (timeRemaining <= 0) {
      clearInterval(timer);
      showCustomPopup('Time is up! Game over.', () => {
        showResults(currentLevel, totalTimePlayed, matchedTiles); // Show results after the popup
      });
      isGameOver = true; // Mark game as over
    }
  }, 1000);
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

  // Start the timer only when the first tile is flipped
  if (!timerStarted) {
    const levelTime = levelTimes[currentLevel - 1];
    startTimer(levelTime); // Start the timer for the level
    timerStarted = true; // Mark that the timer has started
  }

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
    if (onClose) onClose();
  });
}

// Use the custom popup in place of alert
// Modify the part of the code where you go to the next level
function checkForMatch() {
  const [tile1, tile2] = flippedTiles;
  if (tile1.dataset.color === tile2.dataset.color) {
    matchedTiles += 2;
    tile1.removeEventListener('click', handleTileClick);
    tile2.removeEventListener('click', handleTileClick);
    flippedTiles = [];

    if (matchedTiles === levelTiles[currentLevel - 1]) {
      stopAndResetTimer(); // Stop the timer when level is complete
      if (currentLevel === levelTiles.length) {
        setTimeout(() => {
          showCustomPopup('You won the game! Congratulations!', () => {
            startButton.style.display = 'block';
          });
        }, 500);
      } else {
        setTimeout(() => {
          showCustomPopup(`Level ${currentLevel} complete! Get ready for the next level.`, () => {
            currentLevel++; // Move to the next level
            createBoard(); // Create the new board for the next level
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
  stopAndResetTimer(); // Ensure the timer is stopped and reset
  createBoard(); // Initialize the game board
});

// Handle the tile click event and ensure timer starts when the first tile is clicked
function handleTileClick(e) {
  if (isGameOver || flippedTiles.length === 2) return;

  const tile = e.target.closest('.tile');
  if (flippedTiles.includes(tile) || !tile.classList.contains('flipped')) return;

  tile.classList.remove('flipped'); // Reveal the tile by removing 'flipped' class
  flippedTiles.push(tile);

  // Start the timer only when the first tile is flipped
  if (!timerStarted) {
    const levelTime = levelTimes[currentLevel - 1];
    startTimer(levelTime); // Start the timer for the level
    timerStarted = true; // Mark that the timer has started
  }

  // Check if two tiles are flipped
  if (flippedTiles.length === 2) {
    checkForMatch();
  }
}

function exitGame() {
  window.location.reload();
}

function quitGame() {
  window.location.href = "{{ url('/') }}";
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

// Restart the game from the results popup
function showResults(levelReached, totalTimePlayed, matchedTilesCount) {
  // Create the popup container
  const popup = document.createElement('div');
  popup.classList.add('custom-popup');

  // Create the popup content
  const popupContent = document.createElement('div');
  popupContent.classList.add('custom-popup-content');

  // Add the results to the popup
  const resultsTitle = document.createElement('h2');
  resultsTitle.textContent = "Game Results";
  popupContent.appendChild(resultsTitle);

  const levelInfo = document.createElement('p');
  levelInfo.textContent = `Level Reached: ${levelReached}`;
  popupContent.appendChild(levelInfo);

  const timeInfo = document.createElement('p');
  timeInfo.textContent = `Total Time Played: ${totalTimePlayed} seconds`;
  popupContent.appendChild(timeInfo);

  const matchInfo = document.createElement('p');
  const speed = (matchedTilesCount / totalTimePlayed).toFixed(2);
  matchInfo.textContent = `Speed of Matching: ${speed} matches per second`;
  popupContent.appendChild(matchInfo);

  // Add a restart button
  const restartButton = document.createElement('button');
  restartButton.textContent = 'Restart Game';
  restartButton.classList.add('custom-popup-button');
  popupContent.appendChild(restartButton);

  // Add the popup content to the popup container
  popup.appendChild(popupContent);
  document.body.appendChild(popup);

  // Restart button event listener
  restartButton.addEventListener('click', () => {
    document.body.removeChild(popup);
    resetTimer(); // Reset the timer when restarting
    createBoard(); // Restart the game
  });
}