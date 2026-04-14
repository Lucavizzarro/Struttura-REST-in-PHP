<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "test";

// Connessione
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupero dati
$nome_tabella = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['nome_tabella']);
$nome = $conn->real_escape_string($_POST['nome']);
$cognome = $conn->real_escape_string($_POST['cognome']);
$data = $_POST['data_nascita'];

// Query INSERT
$sql = "INSERT INTO `$nome_tabella` (nome, cognome, data_nascita)
        VALUES ('$nome', '$cognome', '$data')";

// Esecuzione
if ($conn->query($sql) === TRUE) {
    echo "Dati inseriti con successo!";
} else {
    echo "Errore: " . $conn->error;
}

$conn->close();

?>
