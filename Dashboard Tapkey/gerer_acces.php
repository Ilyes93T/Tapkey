<?php

ini_set('session.cookie_lifetime', 0);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage de la table acces_tapkey</title>
    <style>
        /* Styles CSS pour la table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styles CSS pour le header */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        /* Styles CSS pour le footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Styles CSS pour le contenu */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>

<header>
    <h1>Interface de gestion des accès TapKey</h1>
    <button><a href="deconnexion.php" class="logoutButton">Déconnexion</a></button>
</header>

<div class="container">
    <h2>Liste des accès TapKey</h2>

    <table id="table-acces-tapkey">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Tapkey ID</th>
                <th>Email</th>
                <th>Date de début</th>
                <th>Date de fin</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Intégration du script PHP pour récupérer les données de la base de données
            // Paramètres de connexion à la base de données
            $servername = "51.210.151.13"; // Remplacez localhost par l'adresse de votre serveur MySQL si nécessaire
            $username = "airlocunlock"; // Remplacez par le nom d'utilisateur de votre base de données
            $password = "Airlocunlock2024!"; // Remplacez par le mot de passe de votre base de données
            $database = "airlocunlock2024"; // Remplacez par le nom de votre base de données

            // Création de la connexion
            $conn = new mysqli($servername, $username, $password, $database);

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            // Requête SQL pour supprimer les entrées expirées de la table acces_tapkey
            $sql_delete = "DELETE FROM acces_tapkey WHERE end_date < CURRENT_DATE()";

            if ($conn->query($sql_delete) === TRUE) {
                echo " ";
            } else {
                echo "Erreur lors de la suppression des entrées expirées : " . $conn->error;
            }

            // Requête SQL pour récupérer les données de la table acces_tapkey
            $sql_select = "SELECT * FROM acces_tapkey";
            $result_select = $conn->query($sql_select);

            // Vérification s'il y a des résultats
            if ($result_select->num_rows > 0) {
                // Affichage des données dans le tableau
                while($row = $result_select->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['tapkey_id'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                // Si aucune donnée n'est trouvée, afficher un message
                echo "<tr><td colspan='7'>Aucun résultat trouvé.</td></tr>";
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Script JavaScript pour gérer la déconnexion automatique -->
<script>
    setTimeout(function() {
        if(confirm("Voulez-vous rester connecté ?")) {
            // Si l'utilisateur veut rester connecté, rien ne se passe
        } else {
            // Si l'utilisateur ne veut pas rester connecté, déconnexion
            window.location.href = "index.php"; // Redirection vers un script PHP pour déconnexion
        }
    }, 300000); // 300000 millisecondes = 5 minutes
</script>
</body>
</html>
