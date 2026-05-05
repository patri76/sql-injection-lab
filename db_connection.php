<?php
// Parametri di connessione al database
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "sqlitest";

// Connessione al database
$conn = new mysqli($servername, $username, $password);

// Controllo la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Creazione del database se non esiste
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === FALSE) {
    echo "Errore durante la creazione del database: " . $conn->error;
} 

// Seleziona il database
$conn->select_db($dbname);
?>
