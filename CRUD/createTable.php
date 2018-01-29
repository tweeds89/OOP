<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_table";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Wystąpił błąd: " . $conn->connect_error);
}

$sql = "CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
image VARCHAR(255) NOT NULL
)";


if ($conn->query($sql) === TRUE) {
    echo "Tabela users została stworzona <br>";
} else {
    echo "Nie udało się utworzyć tabeli: " . $conn->error;
}

$conn->close();