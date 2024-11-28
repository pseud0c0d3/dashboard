<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Sound Game</title>
    <link rel="stylesheet" href="/css/style1.css">
</head>
<body>
    <div class="game-container">
        <h1>Guess the Animal Sound!</h1>
        <button id="play-sound">Play Sound</button>
        <div id="options">
            <!-- Animal images will be inserted here by JavaScript -->
        </div>
        <p id="result"></p>
    </div>
    <script src="{{ asset('js/gamescript.js') }}"></script>
</body>
</html>
