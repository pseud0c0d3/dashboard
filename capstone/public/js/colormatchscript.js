const startButton = document.getElementById('startButton');
const board = document.getElementById('board');
let colors = [];
let flippedTiles = [];
let matchedTiles = 0;
let isGameOver = false;

const totalTiles = 16;
const totalPairs = totalTiles / 2;
let countdownInterval;
let countdownElement;

// Helper function to generate random colors
function generateColors() {
  const colorArray = [];
  const colorList = ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A133FF', '#FF8C33', '#33FFF5', '#FF3333'];
  for (let i = 0; i < totalPairs; i++) {
    const color = colorList[i % colorList.length];
    colorArray.push(color, color);
  }
  return colorArray.sort(() => Math.random() - 0.5);
}

// Function to create the game board
function createBoard() {
  colors = generateColors();
  board.innerHTML = '';  // Clear board
  flippedTiles = [];
  matchedTiles = 0;
  isGameOver = false;    // Reset game over state

  // Create tiles and append them to the board
  for (let i = 0; i < totalTiles; i++) {
    const tile = document.createElement('div');
    tile.classList.add('tile');
    tile.dataset.color = colors[i];

    const front = document.createElement('div');
    front.classList.add('front');
    const back = document.createElement('div');
    back.classList.add('back');
    back.style.backgroundColor = colors[i];

    tile.appendChild(front);
    tile.appendChild(back);
    board.appendChild(tile);

    // Disable clicking on tiles before game starts
    tile.classList.add('disabled');
    tile.addEventListener('click', handleTileClick); // Add click event listener
  }

  // Start the countdown before flipping tiles
  startCountdown();
}

// Handle tile click event
function handleTileClick(e) {
  if (isGameOver || flippedTiles.length === 2) return; // Prevent clicking when game is over or 2 tiles are already flipped

  const tile = e.target.closest('.tile');
  if (flippedTiles.includes(tile) || tile.classList.contains('flipped') || tile.classList.contains('disabled')) return;

  tile.classList.add('flipped');
  flippedTiles.push(tile);

  // Check if two tiles are flipped
  if (flippedTiles.length === 2) {
    checkForMatch();
  }
}

// Check if two flipped tiles match
function checkForMatch() {
  const [tile1, tile2] = flippedTiles;
  if (tile1.dataset.color === tile2.dataset.color) {
    matchedTiles += 2;
    flippedTiles = [];

    // If all tiles are matched, game is over
    if (matchedTiles === totalTiles) {
      isGameOver = true;
      alert('You won! Congratulations!');
      startButton.style.display = 'block'; // Show the start button again
    }
  } else {
    // If not a match, flip tiles back after a delay
    setTimeout(() => {
      tile1.classList.remove('flipped');
      tile2.classList.remove('flipped');
      flippedTiles = [];
    }, 1000); // 1-second delay before flipping back
  }
}

// Countdown logic
function startCountdown() {
  let countdown = 3; // Starting countdown number
  countdownElement = document.createElement('div');
  countdownElement.id = 'countdown';
  countdownElement.style.position = 'absolute';
  countdownElement.style.top = '50%';
  countdownElement.style.left = '50%';
  countdownElement.style.transform = 'translate(-50%, -50%)';
  countdownElement.style.fontSize = '3rem';
  countdownElement.style.color = 'black';
  countdownElement.style.zIndex = '9999';
  document.body.appendChild(countdownElement);

  countdownInterval = setInterval(() => {
    countdownElement.textContent = countdown;
    countdown--;
    if (countdown < 0) {
      clearInterval(countdownInterval);
      document.body.removeChild(countdownElement);
      flipAllTilesTemporarily();
    }
  }, 1000); // Update countdown every second
}

// Function to temporarily flip all tiles, then hide them again
function flipAllTilesTemporarily() {
  const tiles = document.querySelectorAll('.tile');
  tiles.forEach(tile => tile.classList.add('flipped'));

  // After a short delay, flip them back to hide the colors
  setTimeout(() => {
    tiles.forEach(tile => tile.classList.remove('flipped'));
    enableTiles(); // Enable tile clicking after initial flip
  }, 2000); // Keep the tiles flipped for 2 seconds
}

// Function to enable tile clicks after countdown
function enableTiles() {
  const tiles = document.querySelectorAll('.tile');
  tiles.forEach(tile => {
    tile.classList.remove('disabled'); // Remove 'disabled' class to enable clicking
  });
}

// Start the game
startButton.addEventListener('click', () => {
  startButton.style.display = 'none'; // Hide the start button
  createBoard(); // Call the function to create the board and start the countdown
});
