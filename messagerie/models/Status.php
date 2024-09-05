<?php
class Status {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Get the online status of a user
    public function getUserStatus($userId) {
        $query = $this->db->prepare("SELECT en_ligne, derniere_activite FROM etat_en_ligne WHERE id_utilisateur = :userId");
        $query->execute(['userId' => $userId]);
        return $query->fetch();
    }

    // Update user status to online
    public function setUserOnline($userId) {
        $query = $this->db->prepare("UPDATE etat_en_ligne SET en_ligne = 1, derniere_activite = NOW() WHERE id_utilisateur = :userId");
        return $query->execute(['userId' => $userId]);
    }

    // Update user status to offline
    public function setUserOffline($userId) {
        $query = $this->db->prepare("UPDATE etat_en_ligne SET en_ligne = 0 WHERE id_utilisateur = :userId");
        return $query->execute(['userId' => $userId]);
    }
}
