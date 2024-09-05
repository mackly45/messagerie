<?php
class Message {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer les messages par identifiant utilisateur
    public function getMessagesByUserId($userId) {
        $query = $this->db->prepare("SELECT m.message, m.date_envoi, u.nom as expediteur 
                                     FROM messages m 
                                     JOIN utilisateurs u ON m.id_expediteur = u.id 
                                     WHERE id_destinataire = :userId");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll();
    }

    // Envoyer un nouveau message
    public function sendMessage($senderId, $receiverId, $message) {
        $query = $this->db->prepare("INSERT INTO messages (id_expediteur, id_destinataire, message) 
                                     VALUES (:senderId, :receiverId, :message)");
        return $query->execute(['senderId' => $senderId, 'receiverId' => $receiverId, 'message' => $message]);
    }
}
