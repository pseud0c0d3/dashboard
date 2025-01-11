let score = 0;
let timer = 10;
let currentAnimal = null;
let audioInstance = null;
let timerInterval;
let highestScore = loadHighestScore();
let isGameStarted = false;

// DOM Elements
const playSoundButton = document.getElementById('start-game');
const optionsDiv = document.getElementById('options');
const scoreDisplay = document.getElementById('score');
const highestScoreDisplayGame = document.getElementById('highest-score-game');
const highestScoreDisplayHome = document.getElementById('highest-score-home');
const timerDisplay = document.getElementById('timer');
const modal = document.getElementById('game-over-modal');
const finalScore = document.getElementById('final-score');
const highestScoreModal = document.getElementById('highest-score-modal');
const restartButton = document.getElementById('restart-game');
const quitButton = document.getElementById('quit-game');

// Animals data
const animals = [
    { name: 'dog', sound: 'dog.wav', category: 'land', categoryImage: 'land.jpg' }, // Land category image
    { name: 'cat', sound: 'cat.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'cow', sound: 'cow.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'sheep', sound: 'sheep.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'eagle', sound: 'eagle.wav', category: 'air', categoryImage: 'air.jpg' }, // Air category image
    { name: 'whale', sound: 'whale.wav', category: 'sea', categoryImage: 'sea.jpg' }, // Sea category image
    { name: 'fish', sound: 'fish.wav', category: 'sea', categoryImage: 'sea.jpg' }
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
        updateHighscoreDisplay();  // Update the display with the new highest score
    }
}

// Function to update the highscore display in all sections
function updateHighscoreDisplay() {
    highestScoreDisplayGame.textContent = `Highest Score: ${highestScore}`;
    highestScoreDisplayHome.textContent = `Highest Score: ${highestScore}`;
    highestScoreModal.textContent = `Highest Score: ${highestScore}`;
}

// Function to show the result modal
function showResults() {
   // Show the animal's image, name, and score in the modal
   finalScore.innerHTML = `
   The animal was a <strong>${currentAnimal.name}</strong> from the <strong>${currentAnimal.category}</strong>.<br>
   <img src="/img/${currentAnimal.name}.jpg" alt="${currentAnimal.name}" style="width: 100px; height: auto; padding:5px"/><br>
   Your Score: ${score}
`;
highestScoreModal.textContent = `Highest Score: ${highestScore}`;
modal.style.display = 'flex';  // Show result modal
}

// Function to reset the game
function resetGame() {
    score = 0;
    timer = 10;
    scoreDisplay.textContent = `Score: ${score}`;
    timerDisplay.textContent = `Time Left: ${timer}s`;
    optionsDiv.innerHTML = ''; // Clear any previous options
    modal.style.display = 'none'; // Hide result modal if visible
}

// Function to start the timer
function startTimer() {
    clearInterval(timerInterval);  // Clear any existing timer
    timerInterval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `Time Left: ${timer}s`;

        if (timer <= 0) {
            clearInterval(timerInterval);  // Stop the timer when it reaches 0
            saveHighestScore();
            showResults();  // Show results when the time is up
        }
    }, 1000);
}

// Function to play the animal sound
function playSound() {
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    if (!audioInstance) {
        audioInstance = new Audio();
    }
    audioInstance.src = `/wav/${currentAnimal.sound}`;
    audioInstance.play();

    displayOptions();  // Display category options after playing the sound
}


// Function to display animal category options
function displayOptions() {
    optionsDiv.innerHTML = '';
    const shuffledCategories = [...new Set(animals.map(animal => animal.category))];  // Get unique categories
    const shuffledCategoriesImages = shuffledCategories.sort(() => Math.random() - 0.5); // Shuffle the categories

    // For each category, display its image and allow the user to select it
    shuffledCategoriesImages.forEach(category => {
        const img = document.createElement('img');
        img.src = `/img/${category}.jpg`;  // Path to category image (air.jpg, land.jpg, sea.jpg)
        img.alt = category;
        img.classList.add('category-image');  // Add the class 'category-image' for styling
        img.addEventListener('click', () => checkAnswer(category));  // Check if the selected category is correct
        optionsDiv.appendChild(img);
    });
}




// Function to check the answer (if the category matches)
function checkAnswer(selectedCategory) {
    if (selectedCategory === currentAnimal.category) {
        // Correct answer, increment the score
        score++;
        scoreDisplay.textContent = `Score: ${score}`;
        
        setTimeout(() => {
            playSound();  
        }, 1000);
    } else {
        // Incorrect answer, show the animal's picture, name, and score in the result modal
        showResults();
    }
}



// Function to reset the game when the restart button is clicked
restartButton.addEventListener('click', () => {
    // Hide the game-over modal
    modal.style.display = 'none';

    // Reset the game state
    score = 0;
    timer = 10;  // Set timer to 10 seconds
    scoreDisplay.textContent = `Score: ${score}`;  // Update the score display
    timerDisplay.textContent = `Time Left: ${timer}s`;  // Update the timer display
    optionsDiv.innerHTML = '';  // Clear any displayed animal options
    playSoundButton.style.display = 'none';  // Hide start button if it's in the game section
    document.getElementById('home-section').style.display = 'none';  // Hide home section
    document.getElementById('game-section').style.display = 'block';  // Show game section
    
    // Start the game by playing the first sound
    playSound();  // This will trigger the sound to play and start the timer
    
    // Hide the result modal and reset it
    modal.style.display = 'none';  // Hide modal if it's open
});

// Quit the game and return to home section
quitButton.addEventListener('click', () => {
    // Stop the sound if it's playing
    if (audioInstance) {
        audioInstance.pause();  // Stop the audio
        audioInstance.currentTime = 0;  // Reset the audio to the beginning
    }
    
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
    
    playSoundButton.style.display = 'block';
    
    // Update the highscore display in home section
    updateHighscoreDisplay();  
    
    // Reset the position of the button if needed
    playSoundButton.style.position = 'initial'; 
});


// Show the instruction modal when the start button in the home section is clicked
playSoundButton.addEventListener('click', () => {
    // Hide home section and show instruction modal
    document.getElementById('home-section').style.display = 'none';
    document.getElementById('instruction-modal').style.display = 'block';
    playSoundButton.style.display = 'none';  // Hide the start button

    // Ensure no sound plays when the instruction modal is shown
    isGameStarted = false;  // Reset the game start flag
});

// Show the instruction modal when the "Start Game" button is clicked from the home section
document.getElementById("start-game").addEventListener("click", function() {
    document.getElementById("home-section").style.display = "none";
    document.getElementById("instruction-modal").style.display = "block";

    // Stop any previously playing sounds if any
    if (audioInstance) {
        audioInstance.pause();
        audioInstance.currentTime = 0;
    }
});

// Start the game when the "GAME" button in the instruction modal is clicked
document.getElementById("start-game-modal").addEventListener("click", function() {
    // Hide the instruction modal and show the game section
    document.getElementById("instruction-modal").style.display = "none";
    document.getElementById("game-section").style.display = "block";

    // Reset the game state before starting
    resetGame();
    // Set flag to indicate that the game has started
    isGameStarted = true;

    // Start the game by playing the first sound and starting the timer
    playSound();  // This will play the sound when clicked
    startTimer(); // This will start the timer when clicked
});

// Immediately update the high score display when the page is loaded
updateHighscoreDisplay();
