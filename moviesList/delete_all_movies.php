<?php
$host = 'localhost';
$dbname = 'movies';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM movies";
if ($conn->query($sql) === TRUE) {
    echo "All movies deleted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); 
?>
