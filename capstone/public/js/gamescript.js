// script.js

// Array of animal data with sounds and images
const animals = [
    { name: 'dog', sound: 'dog.wav', image: 'dog.png' },
    { name: 'cat', sound: 'cat.wav', image: 'cat.jpg' },
    { name: 'cow', sound: 'cow.wav', image: 'cow.jpg' },
    { name: 'sheep', sound: 'sheep.wav', image: 'sheep.jpg' }
];

let currentAnimal;

function playSound() {
    // Choose a random animal
    currentAnimal = animals[Math.floor(Math.random() * animals.length)];

    // Play the sound
    const audio = new Audio(`/wav/${currentAnimal.sound}`); // Corrected path
    audio.play();

    // Display animal options after the sound is played
    setTimeout(() => {
        displayOptions();
    }, audio.duration * 1000); // Delay the options display until the sound finishes
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
    const result = document.getElementById('result');
    if (selectedName === currentAnimal.name) {
        result.textContent = "Correct!";
    } else {
        result.textContent = "Try Again!";
    }
}

document.getElementById('play-sound').addEventListener('click', playSound);
