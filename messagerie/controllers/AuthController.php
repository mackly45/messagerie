<?php
require_once '../models/User.php'; // Inclusion du modèle User

class AuthController {
    private $userModel;

    // Constructeur pour initialiser le modèle User avec la connexion à la base de données
    public function __construct($db) {
        $this->userModel = new User($db); // Initialisation du modèle utilisateur
    }

    // Fonction pour gérer l'inscription d'un utilisateur
    public function register($name, $email, $password) {
        // Sécuriser les entrées de l'utilisateur
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        
        // Hachage du mot de passe pour le stockage sécurisé
        $password = password_hash($password, PASSWORD_BCRYPT); 
        
        // Appel à la fonction d'inscription du modèle User
        $success = $this->userModel->register($name, $email, $password);

        if ($success) {
            // Si l'inscription est réussie, redirige l'utilisateur vers la page inscris_ok.php
            header('Location: ../views/inscris_ok.php');
            exit(); // Assurer l'arrêt du script après la redirection
        } else {
            // Si une erreur survient, retourner false (échec de l'inscription)
            return false;
        }
    }

    // Fonction pour gérer la connexion d'un utilisateur
    public function login($email, $password) {
        // Sécurisation des entrées utilisateur
        $email = htmlspecialchars($email);

        // Recherche de l'utilisateur par email
        $user = $this->userModel->findByEmail($email);

        // Vérification du mot de passe haché
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            session_start(); // Démarrage de la session
            $_SESSION['user_id'] = $user['id']; // Stockage de l'identifiant utilisateur dans la session

            // Si connexion réussie, rediriger vers le tableau de bord
            header('Location: ../views/dashboard.php');
            exit(); // Arrêt du script après la redirection
        }
        
        // Retourne false si la connexion échoue (email ou mot de passe incorrect)
        return false;
    }
}
?>
