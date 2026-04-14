<?php

// Parametri di connessione
$host = "localhost";
$user = "root";
$password = "";
$dbname = "test";

// Connessione
$conn = new mysqli($host, $user, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Controllo dati POST
if (!isset($_POST['nome_tabella'], $_POST['nome_campo'], $_POST['tipo_campo'])) {
    die("Dati mancanti.");
}

// Pulizia nome tabella
$nome_tabella = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['nome_tabella']);

$nomi_campi = $_POST['nome_campo'];
$tipi_campi = $_POST['tipo_campo'];

// Inizio query
$sql = "CREATE TABLE `$nome_tabella` (id INT AUTO_INCREMENT PRIMARY KEY";

// Costruzione campi
for ($i = 0; $i < count($nomi_campi); $i++) {

    $nome = preg_replace('/[^a-zA-Z0-9_]/', '', $nomi_campi[$i]);
    $tipo = $tipi_campi[$i];

    if (!empty($nome)) {
        $sql .= ", `$nome` $tipo";
    }
}

$sql .= ")";

// Esecuzione
if ($conn->query($sql) === TRUE) {
    echo "Tabella creata con successo!";
} else {
    echo "Errore: " . $conn->error;
}

// Chiusura
$conn->close();

?>
