const startButton = document.getElementById('startButton');
const exitButton = document.getElementById('exitButton');
const quitButton = document.getElementById('quitButton');
const board = document.getElementById('board');
const timerDisplay = document.getElementById('timer');
const levelDisplay = document.getElementById('levelDisplay');

let colors = [];
let flippedTiles = [];
let matchedTiles = 0;
let isGameOver = false;
let currentLevel = 1;
let timer;
let timerStarted = false; // Track if the timer has started

const levelTiles = [4, 6, 8, 12, 14, 16, 18, 20];
const levelTimes = [25, 30, 45, 60, 70, 90, 100, 120];

// function to generate random colors
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
  clearInterval(timer);
  timerStarted = false;
  timerDisplay.textContent = 'Time: 0s';
  timerDisplay.style.color = 'black';
}



// Function to start the timer
function startTimer(duration) {
  let timeRemaining = duration;
  let totalTimePlayed = 0; // Track the total time played

  timerDisplay.textContent = `Time: ${timeRemaining}s`;
  timerDisplay.style.display = 'block';

  timer = setInterval(() => {
    timeRemaining--;
    totalTimePlayed++;

    timerDisplay.textContent = `Time: ${timeRemaining}s`;

    if (timeRemaining <= 10) {
      timerDisplay.style.color = 'red'; // Show time in red when it's running out
    }

    if (timeRemaining <= 0) {
      clearInterval(timer); // Stop the timer
      isGameOver = true; // Mark the game as over
      showCustomPopup('Time is up! Game over.', () => {
        showResults(currentLevel, totalTimePlayed, matchedTiles); // Show results after 
      });
    }
  }, 1000);
}



// Function to create the game board
function createBoard() {
  const totalTiles = levelTiles[currentLevel - 1];
  const totalPairs = totalTiles / 2;

  colors = generateColors(totalPairs);
  board.innerHTML = '';
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

  // Create tiles
  for (let i = 0; i < totalTiles; i++) {
    const tile = document.createElement('div');
    tile.classList.add('tile', 'flipped'); // Start with 'flipped' class to hide colors
    tile.dataset.color = colors[i];

    const front = document.createElement('div');
    front.classList.add('front');
    const back = document.createElement('div');
    back.classList.add('back');
    back.style.backgroundColor = colors[i];

    tile.appendChild(front);
    tile.appendChild(back);
    board.appendChild(tile);

    tile.addEventListener('click', handleTileClick);
  }

  // Update the level display
  levelDisplay.textContent = `Level: ${currentLevel}`;
}

function checkForMatch() {
  if (flippedTiles.length === 2) {
    const [tile1, tile2] = flippedTiles;

    if (tile1.dataset.color === tile2.dataset.color) {
      // Tiles match
      matchedTiles++;

      tile1.removeEventListener('click', handleTileClick);
      tile2.removeEventListener('click', handleTileClick);

      flippedTiles = []; // Clear flipped tiles

      // Check if all pairs are matched
      if (matchedTiles === colors.length / 2) {
        clearInterval(timer); // Stop timer
        showCustomPopup('Congratulations! You matched all tiles.', () => {
          if (currentLevel < levelTiles.length) {
            currentLevel++; // Move to the next level
            stopAndResetTimer(); // Reset timer for the next level
            createBoard(); // Load the next level
          } else {
            showResults(currentLevel, 0, matchedTiles); // Show final results if it's the last level
          }
        });
      }
    } else {
      // Tiles don't match
      setTimeout(() => {
        // Flip tiles back
        tile1.classList.add('flipped');
        tile2.classList.add('flipped');
        flippedTiles = [];
      }, 900); // Add delay before flipping back
    }
  }
}


// Handle tile click
function handleTileClick(e) {
  if (isGameOver || flippedTiles.length === 2) return;

  const tile = e.target.closest('.tile');
  if (flippedTiles.includes(tile) || !tile.classList.contains('flipped')) return;

  tile.classList.remove('flipped');
  flippedTiles.push(tile);

  // Start the timer only when the first tile is flipped
  if (!timerStarted) {
    const levelTime = levelTimes[currentLevel - 1];
    startTimer(levelTime);
    timerStarted = true;
  }

  // Check if two tiles are flipped
  if (flippedTiles.length === 2) {
    checkForMatch();
  }
}

// Function to show custom popup messages
function showCustomPopup(message, onClose) {
  const popup = document.createElement('div');
  popup.classList.add('custom-popup'); // Add a class for styling

  const popupContent = document.createElement('div');
  popupContent.classList.add('custom-popup-content');

  const popupMessage = document.createElement('p');
  popupMessage.textContent = message;
  popupContent.appendChild(popupMessage);

  const button = document.createElement('button');
  button.textContent = 'Close';
  button.addEventListener('click', () => {
    document.body.removeChild(popup); // Close the popup when clicked
    if (onClose) onClose(); // Trigger the onClose callback (like showing results)
  });
  popupContent.appendChild(button);

  popup.appendChild(popupContent);
  document.body.appendChild(popup); // Add the popup to the body
}

// Start the game
startButton.addEventListener('click', () => {
  // Hide homepage and show instructions modal
  document.getElementById('homepage').style.display = 'none';

  // Create the instruction modal
  const instructionModal = document.createElement('div');
  instructionModal.classList.add('custom-popup');

  const modalContent = document.createElement('div');
  modalContent.classList.add('custom-popup-content');

  const instructionTitle = document.createElement('h2');
  instructionTitle.textContent = 'Welcome to the Matching Game! 🎮';
  modalContent.appendChild(instructionTitle);

  const instructionText = document.createElement('p');
  instructionText.innerHTML = `
  🌟 **Let’s play!** 🎮 <br>
  1. **Tap a tile** 🟩 <br>
  2. **Tap another tile** 🔶 <br>
  3. If they **match**, they stay open! 🎉 <br>
  4. **Keep going** until all tiles match! 🏆 <br>
  ❤️ **You’re doing great!** <br>
  `;
  modalContent.appendChild(instructionText);
  const startGameButton = document.createElement('button');
  startGameButton.textContent = 'Let’s Play! 🌈';
  startGameButton.classList.add('custom-popup-button');
  modalContent.appendChild(startGameButton);

  const funMessage = document.createElement('p');
  funMessage.textContent = "You’re doing awesome! 🌟 Let’s play and have fun together! 🎉";
  modalContent.appendChild(funMessage);

  instructionModal.appendChild(modalContent);
  document.body.appendChild(instructionModal);

  startGameButton.addEventListener('click', () => {
    // Remove the instruction modal
    document.body.removeChild(instructionModal);

    // Proceed to the game section
    const homepage = document.getElementById('homepage');
    const gameContainer = document.getElementById('gameContainer');

    homepage.style.display = 'none';  // Hide the homepage
    gameContainer.style.display = 'block';  // Show the game container

    currentLevel = 1; // Reset to level 1
    stopAndResetTimer(); // Ensure the timer is stopped and reset
    createBoard();
  });
});

quitButton.addEventListener('click', () => {
  const homepage = document.getElementById('homepage');
  const gameContainer = document.getElementById('gameContainer');

  // Hide the game container and show the homepage
  gameContainer.style.display = 'none';
  homepage.style.display = 'block';

  // Reset game state
  stopAndResetTimer();
  matchedTiles = 0;
  currentLevel = 1;
  isGameOver = false;
  board.innerHTML = '';
  timerStarted = false;
});

exitButton.addEventListener('click', () => {
  exitGame();
});

var loader = document.getElementById("preloader");
window.addEventListener("load", function () {
  loader.style.display = "none";
});

// Function to show the results after the game is over
function showResults(levelReached, totalTimePlayed, matchedTilesCount) {
  const popup = document.createElement('div');
  popup.classList.add('custom-popup'); // Add a class for styling

  const popupContent = document.createElement('div');
  popupContent.classList.add('custom-popup-content');

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

  // Restart button
  const restartButton = document.createElement('button');
  restartButton.textContent = 'Restart Game';
  restartButton.classList.add('custom-popup-button');
  popupContent.appendChild(restartButton);

  popup.appendChild(popupContent);
  document.body.appendChild(popup); // Ensure it's appended to the body

  restartButton.addEventListener('click', () => {
    document.body.removeChild(popup);
    currentLevel = 1; 
    createBoard(); 
    stopAndResetTimer(); 
    timerStarted = false;
  });
}


// Exit game
function exitGame() {
  const homepage = document.getElementById('homepage');
  const gameContainer = document.getElementById('gameContainer');

  homepage.classList.remove('hidden');
  gameContainer.classList.add('hidden');
  stopAndResetTimer();
  matchedTiles = 0;
  currentLevel = 1;
}

// Show the instructions modal
window.onload = function() {
  document.getElementById('instructionsModal').style.display = 'flex';
};

document.getElementById('closeInstructions').onclick = function() {
  document.getElementById('instructionsModal').style.display = 'none';
  document.getElementById('homepage').style.display = 'none';
  document.getElementById('gameContainer').style.display = 'block';
};

// Start Game Logic
document.getElementById('startButton').onclick = function() {
  document.getElementById('homepage').style.display = 'none';
  document.getElementById('gameContainer').style.display = 'block';
};

// Exit Button Logic
document.getElementById('quitButton').onclick = function() {
  window.close();
};
