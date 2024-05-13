<?php
session_start();

$username = $password = "";
$username_err = $password_err = $login_err = "";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("location: creer_acces.html");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Réinitialisation des variables d'erreur
    $username_err = $password_err = $login_err = "";

    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez entrer votre nom d'utilisateur.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer votre mot de passe.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        if($username === "administrateur" && $password === "airlocunlock"){
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;   
            header("location: creer_acces.php");
            exit;
        } else{
            $login_err = "Nom d'utilisateur ou mot de passe incorrect.";
            $_SESSION['login_err'] = $login_err; // Stockage du message d'erreur dans la session
        }
    }
}

// Vérifier s'il y a des messages d'erreur dans la session
if(isset($_SESSION['login_err'])) {
    $login_err = $_SESSION['login_err']; // Récupération du message d'erreur depuis la session
    unset($_SESSION['login_err']); // Suppression du message d'erreur de la session
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style_connexion.css">
    <style>
        /* Style CSS pour les messages d'erreur */
        .error-message {
            color: #ff0000; /* Rouge */
            font-weight: bold; /* Texte en gras */
            margin-top: 5px;
            display: block; /* Affichage en bloc pour placer les messages en dessous des champs */
        }
    </style>
</head>
<body>
    <header>
        <h1>Connexion à l'espace d'Administration TapKey</h1>
    </header>

    <div class="container">
        <div class="wrapper">
            <b><p>Veuillez vous connecter pour gérer les accès</p></b>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <span class="error-message"><?php echo $username_err; ?></span>
                </div>
                <br>
                <div>
                    <label>Mot de passe</label>
                    <input type="password" name="password">
                    <span class="error-message"><?php echo $password_err; ?></span>
                </div>
                <br>
                <div>
                    <input type="submit" value="Connexion">
                </div>
                <p class="error-message"><?php echo $login_err; ?></p>
            </form>
        </div>
    </div>

</body>
</html>