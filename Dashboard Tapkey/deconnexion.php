<?php
// Démarre la session
session_start();

// Détruit toutes les données de session
session_destroy();

// Redirige vers la page de connexion (ou toute autre page de votre choix)
header("location: index.php");
exit;
?>
