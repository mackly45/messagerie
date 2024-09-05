<?php
class File {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Upload a shared file
    public function uploadFile($senderId, $receiverId, $file) {
        $fileName = htmlspecialchars($file['name']);
        $fileType = htmlspecialchars($file['type']);
        $filePath = 'uploads/' . $fileName;  // Ensure uploads folder is writable

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $query = $this->db->prepare("INSERT INTO fichiers (id_expediteur, id_destinataire, nom_fichier, type_fichier, chemin_fichier, taille_fichier)
                                         VALUES (:senderId, :receiverId, :fileName, :fileType, :filePath, :fileSize)");
            return $query->execute([
                'senderId' => $senderId,
                'receiverId' => $receiverId,
                'fileName' => $fileName,
                'fileType' => $fileType,
                'filePath' => $filePath,
                'fileSize' => $file['size']
            ]);
        }
        return false;
    }
}
