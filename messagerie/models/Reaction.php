<?php
class Reaction {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ajouter une réaction
    public function addReaction($senderId, $receiverId, $reactionType) {
        $query = $this->db->prepare("INSERT INTO reactions (id_expediteur, id_destinataire, type_reaction)
                                     VALUES (:senderId, :receiverId, :reactionType)");
        return $query->execute([
            'senderId' => $senderId,
            'receiverId' => $receiverId,
            'reactionType' => $reactionType
        ]);
    }
}
