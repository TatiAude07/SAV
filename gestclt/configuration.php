<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'application';

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}