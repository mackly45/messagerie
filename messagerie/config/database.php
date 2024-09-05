<?php
// Configuration de la connexion à la base de données

// Informations de connexion
$host = 'localhost';
$user = 'root'; // Modifiez en fonction de votre configuration
$password = ''; // Modifiez en fonction de votre configuration
$database = 'messagerie'; // Base de données

// DSN (Data Source Name) pour PDO
$dsn = "mysql:host=$host;dbname=$database;charset=utf8";

// Options de sécurité pour PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Connexion à la base de données
try {
    $db = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
