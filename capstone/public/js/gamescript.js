let score = 0;
let timer = 10;
let currentAnimal = null;
let audioInstance = null;
let timerInterval;
let highestScore = loadHighestScore(); // Load highest score from localStorage

// DOM Elements
const playSoundButton = document.getElementById('start-game');
const optionsDiv = document.getElementById('options');
const scoreDisplay = document.getElementById('score');
const highestScoreDisplayGame = document.getElementById('highest-score-game'); // For the game section
const highestScoreDisplayHome = document.getElementById('highest-score-home'); // For the home section
const timerDisplay = document.getElementById('timer');
const modal = document.getElementById('game-over-modal');
const finalScore = document.getElementById('final-score');
const highestScoreModal = document.getElementById('highest-score-modal');
const restartButton = document.getElementById('restart-game');
const quitButton = document.getElementById('quit-game');

// Animals data
const animals = [
    { name: 'dog', sound: 'dog.wav', image: 'dog.png' },
    { name: 'cat', sound: 'cat.wav', image: 'cat.jpg' },
    { name: 'cow', sound: 'cow.wav', image: 'cow.jpg' },
    { name: 'sheep', sound: 'sheep.wav', image: 'sheep.jpg' }
];

// Function to load the highest score from localStorage
function loadHighestScore() {
    const storedHighestScore = localStorage.getItem('highestScore');
    if (storedHighestScore) {
        return parseInt(storedHighestScore);
    }
    return 0;
}

// Function to update and save the highest score
function saveHighestScore() {
    if (score > highestScore) {
        highestScore = score;
        localStorage.setItem('highestScore', highestScore);  // Save new highest score in localStorage
        updateHighscoreDisplay();  // Update the display in both sections
    }
}

// Function to update the highscore display in both sections
function updateHighscoreDisplay() {
    highestScoreDisplayGame.textContent = `Highest Score: ${highestScore}`;
    highestScoreDisplayHome.textContent = `Highest Score: ${highestScore}`;
}

// Function to show the result popup
function showResults() {
    finalScore.textContent = `Your Score: ${score}`;
    highestScoreModal.textContent = `Highest Score: ${highestScore}`;
    modal.style.display = 'flex';
}

// Function to reset the game
function resetGame() {
    score = 0;
    timer = 10;
    scoreDisplay.textContent = `Score: ${score}`;
    timerDisplay.textContent = `Time Left: ${timer}s`;
    optionsDiv.innerHTML = '';
    modal.style.display = 'none';
    playSound();
}

// Function to play the animal sound
function playSound() {
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    if (!audioInstance) {
        audioInstance = new Audio();
    }
    audioInstance.src = `/wav/${currentAnimal.sound}`;
    audioInstance.play();

    startTimer();
    displayOptions();
}

// Function to start the timer
function startTimer() {
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `Time Left: ${timer}s`;

        if (timer <= 0) {
            clearInterval(timerInterval);
            saveHighestScore();  // Check and save highest score when the game ends
            showResults();
        }
    }, 1000);
}

// Function to display animal options
function displayOptions() {
    optionsDiv.innerHTML = '';
    const shuffledAnimals = [...animals].sort(() => Math.random() - 0.5);

    shuffledAnimals.forEach(animal => {
        const img = document.createElement('img');
        img.src = `/img/${animal.image}`;
        img.alt = animal.name;
        img.addEventListener('click', () => checkAnswer(animal.name));
        optionsDiv.appendChild(img);
    });
}

// Function to check the answer
function checkAnswer(selectedName) {
    if (selectedName === currentAnimal.name) {
        // Correct answer, increment the score
        score++;
        scoreDisplay.textContent = `Score: ${score}`;
        setTimeout(() => {
            playSound();  // Continue the game after a correct answer
        }, 1000);
    } else {
        // Incorrect answer, save the highest score and show results
        saveHighestScore(); 
        showResults(); 
    }
}

// Restart the game when the restart button is clicked
restartButton.addEventListener('click', () => {
    resetGame();
    // Hide the result modal after restarting the game
    modal.style.display = 'none';
});

// Quit the game and return to home section
quitButton.addEventListener('click', () => {
    // Show home section and hide game section
    document.getElementById('home-section').style.display = 'block';
    document.getElementById('game-section').style.display = 'none';
    // Reset score and timer
    score = 0;
    timer = 10;
    scoreDisplay.textContent = `Score: ${score}`;
    timerDisplay.textContent = `Time Left: ${timer}s`;
    clearInterval(timerInterval);
    modal.style.display = 'none';
    optionsDiv.innerHTML = '';
    
    // Ensure the start button is visible when returning to the home section
    playSoundButton.style.display = 'block';
    
    // Update the highscore display in home section
    updateHighscoreDisplay();  // Update the highscore in the home section
    
    // Reset the position of the button if needed
    playSoundButton.style.position = 'initial'; // Reset position if needed
});

// Start the game when the start button is clicked
playSoundButton.addEventListener('click', () => {
    // Hide home section and show game section
    document.getElementById('home-section').style.display = 'none';
    document.getElementById('game-section').style.display = 'block';
    playSoundButton.style.display = 'none';  // Hide the start button once the game starts
    scoreDisplay.textContent = `Score: ${score}`;
    highestScoreDisplayGame.textContent = `Highest Score: ${highestScore}`;  // Update in the game section
    playSound();  // Start the first sound
});
