<?php
require_once '../config/database.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/DashboardController.php';

session_start(); // Démarrage de la session

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

$authController = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = sanitizeInput($_POST['action']);

        if ($action === 'register') {
            $name = sanitizeInput($_POST['name']);
            $email = sanitizeInput($_POST['email']);
            $password = sanitizeInput($_POST['password']);
            
            if ($authController->register($name, $email, $password)) {
                header('Location: inscris_ok.php'); // Redirection vers inscris_ok après inscription
                exit;
            } else {
                echo "Erreur : Email déjà utilisé.";
            }
        } elseif ($action === 'login') {
            $email = sanitizeInput($_POST['email']);
            $password = sanitizeInput($_POST['password']);
            
            if ($authController->login($email, $password)) {
                header('Location: dashboard.php'); // Redirection vers le dashboard après connexion
                exit;
            } else {
                echo "Erreur : Identifiants incorrects.";
            }
        }
    }
}
?>
