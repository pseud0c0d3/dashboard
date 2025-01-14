let score = 0;
let timer = 10;
let currentAnimal = null;
let audioInstance = null;
let timerInterval;
let highestScore = loadHighestScore();
let isGameStarted = false;
let isSoundPlayed = false;

const playSoundButton = document.getElementById('start-game');
const playAnimalSoundButton = document.createElement('button'); 
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
    { name: 'dog', sound: 'dog.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'cat', sound: 'cat.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'cow', sound: 'cow.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'sheep', sound: 'sheep.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'eagle', sound: 'eagle.wav', category: 'air', categoryImage: 'air.jpg' },
    { name: 'whale', sound: 'whale.wav', category: 'sea', categoryImage: 'sea.jpg' },
    { name: 'fish', sound: 'fish.wav', category: 'sea', categoryImage: 'sea.jpg' }
];

// Play Sound Button
playAnimalSoundButton.textContent = 'Play Sound';
playAnimalSoundButton.id = 'play-animal-sound';
playAnimalSoundButton.style.display = 'none';
optionsDiv.before(playAnimalSoundButton);

// Load and Save Highest Score
function loadHighestScore() {
    return parseInt(localStorage.getItem('highestScore')) || 0;
}

function saveHighestScore() {
    if (score > highestScore) {
        highestScore = score;
        localStorage.setItem('highestScore', highestScore);
        updateHighscoreDisplay();
    }
}

function updateHighscoreDisplay() {
    highestScoreDisplayGame.textContent = `Highest Score: ${highestScore}`;
    highestScoreDisplayHome.textContent = `Highest Score: ${highestScore}`;
    highestScoreModal.textContent = `Highest Score: ${highestScore}`;
}


function startTimer() {
    clearInterval(timerInterval); 
    timerInterval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `Time Left: ${timer}s`;

        if (timer <= 0) {
            clearInterval(timerInterval); // Stop the timer
            saveHighestScore();
            showResults();
        }
    }, 1000);
}

// Game Reset
function resetGame() {
    timer = 10;
    timerDisplay.textContent = `Time Left: ${timer}s`;
    optionsDiv.innerHTML = '';
    playAnimalSoundButton.style.display = 'none';
    modal.style.display = 'none';
    clearInterval(timerInterval);
}

// Prepare Sound and Reset State
function prepareSound() {
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    if (!audioInstance) {
        audioInstance = new Audio();
    }
    audioInstance.src = `/wav/${currentAnimal.sound}`;
    playAnimalSoundButton.style.display = 'block';

    // Ensure the timer is reset but NOT started
    resetTimer();

    playAnimalSoundButton.onclick = () => {
        isSoundPlayed = false; 
        disableCategorySelection(); 
        audioInstance.play(); // Play the animal sound

        audioInstance.onended = () => {
            isSoundPlayed = true;
            enableCategorySelection();
            startTimer(); // Start the timer
        };
    };

    displayOptions(); // Display the categories
}

// Timer Functions
function resetTimer() {
    clearInterval(timerInterval); 
    timer = 10; // Reset the timer
    timerDisplay.textContent = `Time Left: ${timer}s`; 
}

// Check Answer Logic
function checkAnswer(selectedCategory) {
    if (selectedCategory === currentAnimal.category) {
        score++; // Increment the score
        scoreDisplay.textContent = `Score: ${score}`;

        resetTimer();

        setTimeout(() => {
            prepareSound();
        }, 1000);
    } else {
        saveHighestScore(); // Save the highest score
        showResults(); 
    }
}

// Display options for categories
function displayOptions() {
    optionsDiv.innerHTML = ''; // Clear the options

    const categories = [...new Set(animals.map(animal => animal.category))];
    categories.forEach(category => {
        const img = document.createElement('img');
        img.src = `/img/${category}.jpg`;
        img.alt = category;
        img.classList.add('category-image');

        const label = document.createElement('div');
        label.textContent = category.charAt(0).toUpperCase() + category.slice(1);
        label.classList.add('category-label');

        img.addEventListener('click', () => {
            if (isSoundPlayed) {
                checkAnswer(category);
            }
        });

        const categoryDiv = document.createElement('div');
        categoryDiv.classList.add('category-item');
        categoryDiv.appendChild(img);
        categoryDiv.appendChild(label);
        optionsDiv.appendChild(categoryDiv);
    });

    disableCategorySelection(); 
}



function showResults() {
    finalScore.innerHTML = `
        The animal was a <strong>${currentAnimal.name}</strong> from the <strong>${currentAnimal.category}</strong>.<br>
        <img src="/img/${currentAnimal.name}.jpg" alt="${currentAnimal.name}" style="width: 100px; height: auto; padding:5px"/><br>
        Your Score: ${score}
    `;
    modal.style.display = 'flex';
}

function disableCategorySelection() {
    document.querySelectorAll('.category-item img').forEach(img => {
        img.style.pointerEvents = 'none';
        img.style.opacity = '0.5';
    });
}

function enableCategorySelection() {
    document.querySelectorAll('.category-item img').forEach(img => {
        img.style.pointerEvents = 'auto';
        img.style.opacity = '1';
    });
}

restartButton.addEventListener('click', () => {
    modal.style.display = 'none';
    score = 0;
    scoreDisplay.textContent = `Score: ${score}`;
    resetGame();
    prepareSound();
});

quitButton.addEventListener('click', () => {
    if (audioInstance) {
        audioInstance.pause();
        audioInstance.currentTime = 0;
    }

    document.getElementById('home-section').style.display = 'block';
    document.getElementById('game-section').style.display = 'none';
    resetGame();
});

playSoundButton.addEventListener('click', () => {
    document.getElementById('home-section').style.display = 'none';
    document.getElementById('instruction-modal').style.display = 'block';
});

document.getElementById('start-game-modal').addEventListener('click', () => {
    document.getElementById('instruction-modal').style.display = 'none';
    document.getElementById('game-section').style.display = 'block';

    resetGame();
    prepareSound();
});

updateHighscoreDisplay();
