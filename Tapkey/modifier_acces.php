<?php

require 'config.php';

// Vérification si des données de modification sont envoyées en POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $tapkey_id = $_POST["tapkey_id"];
    $email = $_POST["email"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Affichage pour vérifier les données reçues
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Requête SQL pour mettre à jour les données dans la table
    $sql = "UPDATE acces_tapkey SET name='$name', tapkey_id='$tapkey_id', email='$email', start_date='$start_date', end_date='$end_date' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Donnée mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la donnée : " . $conn->error;
    }
}

$conn->close();
?>