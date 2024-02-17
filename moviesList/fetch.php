<?php
$host = 'localhost';
$dbname = 'movies';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['title'], $_POST['duration'], $_POST['description'])) {
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];

    $title = $conn->real_escape_string($title);
    $duration = $conn->real_escape_string($duration);
    $description = $conn->real_escape_string($description);

    $sql = "INSERT INTO movies (title, duration, description) VALUES ('$title', '$duration', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>