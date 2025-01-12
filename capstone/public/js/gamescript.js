let score = 0;
let timer = 10;
let currentAnimal = null;
let audioInstance = null;
let timerInterval;
let highestScore = loadHighestScore();
let isGameStarted = false;

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
    { name: 'dog', sound: 'dog.wav', category: 'land', categoryImage: 'land.jpg' }, 
    { name: 'cat', sound: 'cat.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'cow', sound: 'cow.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'sheep', sound: 'sheep.wav', category: 'land', categoryImage: 'land.jpg' },
    { name: 'eagle', sound: 'eagle.wav', category: 'air', categoryImage: 'air.jpg' }, 
    { name: 'whale', sound: 'whale.wav', category: 'sea', categoryImage: 'sea.jpg' },
    { name: 'fish', sound: 'fish.wav', category: 'sea', categoryImage: 'sea.jpg' }
];


// load the highest score from localStorage
function loadHighestScore() {
    const storedHighestScore = localStorage.getItem('highestScore');
    if (storedHighestScore) {
        return parseInt(storedHighestScore);
    }
    return 0;
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

function showResults() {
   finalScore.innerHTML = `
   The animal was a <strong>${currentAnimal.name}</strong> from the <strong>${currentAnimal.category}</strong>.<br>
   <img src="/img/${currentAnimal.name}.jpg" alt="${currentAnimal.name}" style="width: 100px; height: auto; padding:5px"/><br>
   Your Score: ${score}
`;
highestScoreModal.textContent = `Highest Score: ${highestScore}`;
modal.style.display = 'flex';  
}

function resetGame() {
    score = 0;
    timer = 10;
    scoreDisplay.textContent = `Score: ${score}`;
    timerDisplay.textContent = `Time Left: ${timer}s`;
    optionsDiv.innerHTML = '';
    modal.style.display = 'none'; 
}

function startTimer() {
    clearInterval(timerInterval);  
    timerInterval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `Time Left: ${timer}s`;

        if (timer <= 0) {
            clearInterval(timerInterval);  // Stop the timer when it reaches 0
            saveHighestScore();
            showResults();  
        }
    }, 1000);
}

function playSound() {
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    if (!audioInstance) {
        audioInstance = new Audio();
    }
    audioInstance.src = `/wav/${currentAnimal.sound}`;
    audioInstance.play();

    displayOptions(); 
}


// display animal category options
function displayOptions() {
    optionsDiv.innerHTML = '';
    const shuffledCategories = [...new Set(animals.map(animal => animal.category))]; 
    const shuffledCategoriesImages = shuffledCategories.sort(() => Math.random() - 0.5); 

    shuffledCategoriesImages.forEach(category => {
        const img = document.createElement('img');
        img.src = `/img/${category}.jpg`;
        img.alt = category;
        img.classList.add('category-image'); 
        img.addEventListener('click', () => checkAnswer(category)); 
        optionsDiv.appendChild(img);
    });
}

function checkAnswer(selectedCategory) {
    if (selectedCategory === currentAnimal.category) {
        score++;
        scoreDisplay.textContent = `Score: ${score}`;
        
        setTimeout(() => {
            playSound();  
        }, 1000);
    } else {
        showResults();
    }
}

restartButton.addEventListener('click', () => {
    modal.style.display = 'none';

    score = 0;
    timer = 10;  
    scoreDisplay.textContent = `Score: ${score}`;
    timerDisplay.textContent = `Time Left: ${timer}s`; 
    optionsDiv.innerHTML = '';  
    playSoundButton.style.display = 'none';  
    document.getElementById('home-section').style.display = 'none';  
    document.getElementById('game-section').style.display = 'block'; 
    
    playSound(); 
    
    modal.style.display = 'none';  
});

quitButton.addEventListener('click', () => {
    if (audioInstance) {
        audioInstance.pause(); 
        audioInstance.currentTime = 0; 
    }
    
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
    
    updateHighscoreDisplay();  
    playSoundButton.style.position = 'initial'; 
});


// Show the instruction modal when the start button
playSoundButton.addEventListener('click', () => {
    document.getElementById('home-section').style.display = 'none';
    document.getElementById('instruction-modal').style.display = 'block';
    playSoundButton.style.display = 'none';  
    isGameStarted = false;  
});

document.getElementById("start-game").addEventListener("click", function() {
    document.getElementById("home-section").style.display = "none";
    document.getElementById("instruction-modal").style.display = "block";

    if (audioInstance) {
        audioInstance.pause();
        audioInstance.currentTime = 0;
    }
});

document.getElementById("start-game-modal").addEventListener("click", function() {
    document.getElementById("instruction-modal").style.display = "none";
    document.getElementById("game-section").style.display = "block";

    resetGame();
    isGameStarted = true;

    // Start the game
    playSound();  // This will play the sound when clicked
    startTimer(); // This will start the timer when clicked
});

updateHighscoreDisplay();
