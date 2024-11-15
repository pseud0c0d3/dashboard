const startButton = document.getElementById('startButton');
const board = document.getElementById('board');
let colors = [];
let flippedTiles = [];
let matchedTiles = 0;
let isGameOver = false;

const totalTiles = 12;
const totalPairs = totalTiles / 2;

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

// Check if two flipped tiles match
function checkForMatch() {
  const [tile1, tile2] = flippedTiles;
  if (tile1.dataset.color === tile2.dataset.color) {
    matchedTiles += 2;
    // Remove event listener so matched tiles can't be clicked again
    tile1.removeEventListener('click', handleTileClick);
    tile2.removeEventListener('click', handleTileClick);
    flippedTiles = [];

    if (matchedTiles === totalTiles) {
      isGameOver = true;
      alert('You won! Congratulations!');
      startButton.style.display = 'block'; // Show the start button again
    }
  } else {
    setTimeout(() => {
      tile1.classList.add('flipped');  // Hide tiles again by re-adding 'flipped' class
      tile2.classList.add('flipped');
      flippedTiles = [];
    }, 1000);
  }
}

// Start the game
startButton.addEventListener('click', () => {
  startButton.style.display = 'none'; // Hide the start button
  createBoard(); // Call the function to create the board
});
