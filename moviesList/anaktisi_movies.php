<?php
$host = 'localhost';
$dbname = 'movies';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, title, duration, description FROM movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 0;
    echo "<div class='row justify-content-center'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-6 mb-4'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
        echo "<p class='card-text'>Duration: " . $row["duration"] . "inutes</p>"; // Fixed typo in "minutes"
        echo "<p class='card-text'>" . $row["description"] . "</p>";
        // Placeholder for the image
        echo "<div id='imagePlaceholder_" . $row['id'] . "'></div>";
        echo "</div>";
        echo "<div class='card-footer text-end'>";
        echo "<button class='btn btn-danger btn-sm delete-movie' data-movie-id='" . $row['id'] . "'>x</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        // Call searchAndDisplayImage function passing title and description of the movie
        echo "<script>searchAndDisplayImage('" . $row["title"] . "', '" . $row["description"] . "', 'imagePlaceholder_" . $row['id'] . "');</script>";
        $counter++;
    }    
    echo "</div>";
    echo "<div class='row mt-3'>";
    echo "<div class='col text-center'>";
    echo "<button onclick='deleteAllMovies()' class='btn btn-danger'>Delete All</button>";
    echo "</div>";
    echo "</div>";
    } else {
        echo "<div class='text-center'>";
        echo "0 results";
        echo "</div>";
    }

$conn->close();
?>
