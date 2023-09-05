<?php
// Function to save the movie list to a file
function saveMovieList($movies) {
    $filename = 'movies.txt';
    file_put_contents($filename, implode("\n", $movies));
}

// Function to load the movie list from a file
function loadMovieList() {
    $filename = 'movies.txt';
    if (file_exists($filename)) {
        return file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        return [];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movies = json_decode(file_get_contents('php://input'), true);
    if (!empty($movies)) {
        saveMovieList($movies);
        http_response_code(200);
    } else {
        http_response_code(400);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $movies = loadMovieList();
    echo json_encode(['movies' => $movies]);
} else {
    http_response_code(405);
}
?>
