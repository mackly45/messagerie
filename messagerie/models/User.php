<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Connexion à la base de données
    }

    // Méthode pour enregistrer un utilisateur
    public function register($name, $email, $password) {
        // Vérifier si l'email existe déjà
        $query = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch();

        if ($result) {
            return false; // L'email existe déjà
        }

        // Insérer un nouvel utilisateur dans la base de données
        $query = $this->db->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:name, :email, :password)");
        return $query->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    // Méthode pour trouver un utilisateur par email
    public function findByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch();
    }
}
?>
