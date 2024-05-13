<?php

require 'config.php';

// Requête SQL pour supprimer les entrées expirées
$sql = "DELETE FROM acces_tapkey WHERE end_date < CURRENT_DATE()";

if ($conn->query($sql) === TRUE) {
    echo "Entrées expirées supprimées avec succès.";
} else {
    echo "Erreur lors de la suppression des entrées expirées : " . $conn->error;
}

$conn->close();
?>
