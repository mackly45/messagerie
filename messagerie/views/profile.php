<?php
require_once '../controllers/ProfileController.php';

// Démarrage de la session
session_start();

if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

$profileController = new ProfileController($db);
$user = $profileController->getUserProfile($_SESSION['user_id']);

// Vérifiez si l'utilisateur existe
if (!$user) {
    // Si l'utilisateur n'existe pas, rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

?>

<?php include 'header.php'; ?>

<div class="container">
    <div class="columns is-centered mt-5">
        <div class="column is-8">
            <div class="card">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128">
                                <img src="path_to_avatar/<?= $user['avatar']; ?>" alt="User Avatar">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?= $user['nom']; ?></p>
                            <p class="subtitle is-6"><?= $user['email']; ?></p>
                        </div>
                    </div>

                    <!-- User Information -->
                    <div class="content">
                        <p><strong>Date d'inscription :</strong> <?= date('d-m-Y', strtotime($user['date_creation'])); ?></p>
                        <p><strong>Dernière connexion :</strong> <?= $user['date_derniere_connexion'] ? date('d-m-Y H:i', strtotime($user['date_derniere_connexion'])) : 'Jamais'; ?></p>
                    </div>
                </div>

                <footer class="card-footer">
                    <a href="#" class="card-footer-item">Modifier le profil</a>
                    <a href="#" class="card-footer-item">Changer le mot de passe</a>
                    <a href="#" class="card-footer-item">Déconnexion</a>
                </footer>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
