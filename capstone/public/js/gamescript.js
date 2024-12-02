const animals = [
    { name: 'dog', sound: 'dog.wav', image: 'dog.png' },
    { name: 'cat', sound: 'cat.wav', image: 'cat.jpg' },
    { name: 'cow', sound: 'cow.wav', image: 'cow.jpg' },
    { name: 'sheep', sound: 'sheep.wav', image: 'sheep.jpg' }
];

let currentAnimal = null;
let audioInstance = null;

function playSound() {
    // Choose a random animal
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    // Play the sound
    if (!audioInstance) {
        audioInstance = new Audio();
    }
    audioInstance.src = `/wav/${currentAnimal.sound}`;
    audioInstance.play();

    // Display animal options
    displayOptions();
}

function displayOptions() {
    const optionsDiv = document.getElementById('options');
    optionsDiv.innerHTML = ''; // Clear previous images

    // Shuffle animal options
    const shuffledAnimals = [...animals].sort(() => Math.random() - 0.5);

    shuffledAnimals.forEach(animal => {
        const img = document.createElement('img');
        img.src = `/img/${animal.image}`; // Correct path
        img.alt = animal.name;
        img.addEventListener('click', () => checkAnswer(animal.name));
        optionsDiv.appendChild(img);
    });
}

function checkAnswer(selectedName) {
    const message = selectedName === currentAnimal.name
        ? "Correct! Well done."
        : "Incorrect! Try again.";

    // Show alert and reset game after acknowledgment
    alert(message);
    resetGame();
}

function resetGame() {
    // Stop and reset the audio
    if (audioInstance) {
        audioInstance.pause();
        audioInstance.currentTime = 0; // Reset playback position
    }

    // Reset game state
    currentAnimal = null;
    document.getElementById('options').innerHTML = ''; // Clear options
    const result = document.getElementById('result');
    result.textContent = ''; // Clear result text
}

// Event listener for the play sound button
document.getElementById('play-sound').addEventListener('click', playSound);
