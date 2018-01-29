<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Wystąpił błąd: " . $conn->connect_error);
} 

$sql = "CREATE DATABASE crud_table";
if ($conn->query($sql) === TRUE) {
    echo "Baza danych została stworzona";
} else {
    echo "Nie udało się utworzyć bazy danych: " . $conn->error;
}

$conn->close();