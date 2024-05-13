<?php
date_default_timezone_set('Europe/Paris');

// Autoriser l'accès depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");
// Autoriser les méthodes HTTP spécifiées
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
// Autoriser les en-têtes spécifiés
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Paramètres de connexion à la base de données
$servername = "51.210.151.13"; // Adresse du serveur MySQL
$username = "airlocunlock"; // Nom d'utilisateur MySQL
$password = "Airlocunlock2024!"; // Mot de passe MySQL
$database = "airlocunlock2024"; // Nom de la base de données MySQL

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Configuration des options de PDO pour gérer les exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les données sont envoyées via la méthode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $name = $_POST['name'];
        $tapkey_id = $_POST['tapkey_id'];
        $email = $_POST['email'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Préparation de la requête SQL d'insertion
        $stmt = $pdo->prepare("INSERT INTO acces_tapkey (name, tapkey_id, email, start_date, end_date) VALUES (:name, :tapkey_id, :email, :start_date, :end_date)");

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tapkey_id', $tapkey_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);

        // Exécution de la requête préparée
        $stmt->execute();

        echo "Données insérées avec succès !";
    } else {
        echo "Aucune donnée reçue via POST.";
    }
} catch(PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion PDO
$pdo = null;
?>