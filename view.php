<?php
$username = "admin";
$password = "password";

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication failed.';
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = 'SELECT * FROM users';
$result = $conn->query($query);

echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>User Data</title>';
echo '<link rel="stylesheet" href="stylesview.css">'; 
echo '</head>';
echo '<body>';
echo '<div class="container">';
echo '<h1>User Data</h1>';
echo '<table border="1">';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Date of Birth</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['age'] . '</td>';
    echo '<td>' . $row['dob'] . '</td>';
    echo '</tr>';
}

echo '</table>';
echo '</div>';
echo '</body>';
echo '</html>';

$conn->close();
?>
