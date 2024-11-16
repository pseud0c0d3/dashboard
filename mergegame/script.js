const animals = [
    { name: "cat", img: "animals/cat.jpg", sound: "animals/cat.mp3" },
    { name: "dog", img: "animals/dog.png", sound: "animals/dog.mp3" },
    { name: "cow", img: "animals/cow.jpg", sound: "animals/cow.mp3" },
    { name: "sheep", img: "animals/sheep.jpg", sound: "animals/sheep.mp3" }
];

const gameBoard = document.getElementById("gameBoard");
let flippedCards = [];
let matchedPairs = 0;

function createBoard() {
    const cardArray = [...animals, ...animals].sort(() => 0.5 - Math.random());

    cardArray.forEach((animal, index) => {
        const card = document.createElement("div");
        card.classList.add("card");
        card.dataset.name = animal.name;

        const img = document.createElement("img");
        img.src = `images/${animal.img}`;
        card.appendChild(img);

        card.addEventListener("click", flipCard);
        gameBoard.appendChild(card);
    });
}

function flipCard() {
    if (flippedCards.length < 2 && !this.classList.contains("flipped")) {
        this.classList.add("flipped");
        flippedCards.push(this);

        const animalSound = new Audio(`sounds/${this.dataset.name}.mp3`);
        animalSound.play();

        if (flippedCards.length === 2) {
            checkMatch();
        }
    }
}

function checkMatch() {
    const [card1, card2] = flippedCards;

    if (card1.dataset.name === card2.dataset.name) {
        matchedPairs += 1;
        flippedCards = [];
        if (matchedPairs === animals.length) {
            setTimeout(() => alert("Congratulations! You've matched all the pairs!"), 500);
        }
    } else {
        setTimeout(() => {
            card1.classList.remove("flipped");
            card2.classList.remove("flipped");
            flippedCards = [];
        }, 1000);
    }
}

createBoard();
