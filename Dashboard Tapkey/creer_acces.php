<?php

ini_set('session.cookie_lifetime', 0);

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Rediriger l'utilisateur vers la page de connexion si non connecté
    header("location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de gestion des accès TapKey</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style_acces.css">
</head>
<body>
    <header>
        <h1>Interface de gestion des accès TapKey</h1>
        <!-- Bouton de déconnexion -->
        <a href="deconnexion.php" class="logoutButton">Déconnexion</a>
    </header>

    <div class="container">
        <form id="accessForm" class="container" action="../api/Tapkey/traitement.php" method="POST">
            <h2>Créer un nouvel accès</h2>
            <input type="text" id="nameInput" name="name" placeholder="Name">
            <input type="text" id="tapkeyIdInput" name="tapkey_id" placeholder="Tapkey ID">
            <input type="email" id="emailInput" name="email" placeholder="Email" class="inputField">
            <input type="date" id="startDateInput" name="start_date" placeholder="Start Date" class="inputField">
            <input type="date" id="endDateInput" name="end_date" placeholder="End Date" class="inputField">
            <button type="submit" id="createButton">Créer</button>
        </form>                   

        <h2>Liste des accès</h2>
        <ul id="accessList"></ul>
       <button type="button" id="createButton"><a href="../Dashboard%20Tapkey/gerer_acces.php">Afficher la liste des accès</a></button>
    </div>
    
    <!-- Script JavaScript pour gérer la déconnexion automatique -->
    <script>
    setTimeout(function() {
        if(confirm("Voulez-vous rester connecté ?")) {
            // Si l'utilisateur veut rester connecté, rien ne se passe
        } else {
            // Si l'utilisateur ne veut pas rester connecté, déconnexion
            if(confirm("Voulez-vous vraiment vous déconnecter ?")) {
                window.location.href = "index.php"; // Redirection vers un script PHP pour déconnexion
            } else {
                // Si l'utilisateur choisit de ne pas se déconnecter, réinitialisation du délai
                setTimeout(arguments.callee, 300000); // Redémarrage du compte à rebours
            }
        }
    }, 300000); // 300000 millisecondes = 5 minutes
</script>
</body>
</html>
</body>
</html>
