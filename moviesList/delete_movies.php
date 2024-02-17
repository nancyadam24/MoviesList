<?php
$host = 'localhost';
$dbname = 'movies';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $movieId = $_POST['id'];

    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM movies WHERE id = $movieId";
    if ($conn->query($sql) === TRUE) {
        echo "The movie deleted.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ERROR";
}
?>
