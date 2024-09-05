<?php
require_once '../models/User.php';
require_once '../models/Message.php';
require_once '../models/File.php';
require_once '../models/Reaction.php';
require_once '../models/Status.php';

class DashboardController {
    private $userModel;
    private $messageModel;
    private $fileModel;
    private $reactionModel;
    private $statusModel;

    public function __construct($db) {
        $this->userModel = new User($db);
        $this->messageModel = new Message($db);
        $this->fileModel = new File($db);
        $this->reactionModel = new Reaction($db);
        $this->statusModel = new Status($db);
    }

    // Récupérer les messages pour l'utilisateur actuel
    public function getMessages($userId) {
        return $this->messageModel->getMessagesByUserId($userId);
    }

    // Envoyer un nouveau message
    public function sendMessage($senderId, $receiverId, $message) {
        return $this->messageModel->sendMessage($senderId, $receiverId, htmlspecialchars($message));
    }

    // Partager un fichier
    public function shareFile($senderId, $receiverId, $file) {
        return $this->fileModel->uploadFile($senderId, $receiverId, $file);
    }

    // Ajouter une réaction (étoile, trésor, flamme)
    public function addReaction($senderId, $receiverId, $reactionType) {
        return $this->reactionModel->addReaction($senderId, $receiverId, $reactionType);
    }

    // Vérifier le statut en ligne
    public function checkOnlineStatus($userId) {
        return $this->statusModel->getUserStatus($userId);
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_destroy();
        header("Location: login.php");
    }
}
