<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = 'CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    age INT NOT NULL,
    dob DATE NOT NULL
)';

$conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];

    $query = "INSERT INTO users (name, email, age, dob) VALUES ('$name', '$email', '$age', '$dob')";
    if ($conn->query($query)) {
        echo "User data inserted successfully!";
    } else {
        if ($conn->errno == 1062) {
            echo "Error: Email address already exists.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
