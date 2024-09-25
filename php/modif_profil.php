<?php

require_once("../db/MyPDO.php");

class modifUtilisateur{

    public function modifInfo($id_user, $prenom, $nom, $email, $bio, $campus, $reseaux){
        $data = [
            'id' => $id_user,
            'prenom' => $prenom,
            'nom' => $nom,
            'bio' => $bio,
            'email' => $email,
            'campus' => $campus,
            'reseaux' => $reseaux
        ];

        $query = "UPDATE utilisateur SET prenom = :prenom, nom = :nom, bio = :bio, email = :email, campus = :campus, reseaux = :reseaux WHERE id = :id";
        $statement = MyPDO::getInstance()->prepare($query);
        if ($statement->execute($data)) {
            echo "Les informations ont été mises à jour avec succès.";
        } else {
            $errorInfo = $statement->errorInfo();
            echo "Erreur lors de la mise à jour : " . $errorInfo[2];
        }
    }
}