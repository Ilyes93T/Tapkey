<?php
class Database
{
    // Informations de connexion à la base de données
    private $host = "51.210.151.13";
    private $db_name = "airlocunlock2024";
    private $username = "airlocunlock";
    private $password = "Airlocunlock2024!";
    public $connexion;

    // Méthode pour obtenir la connexion à la base de données
    public function getConnection()
    {
        $this->connexion = null;

        try {
            // Connexion à la base de données MySQL
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
            // echo "connexion a la bdd etablie";
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }
}
?>