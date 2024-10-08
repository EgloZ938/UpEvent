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

    public function modifPdp($file, $id_user){
        $upload_dir = '../assets/pdp/';
        $chemin = './assets/pdp/';

        if (isset($file['pdp']) && $file['pdp']['error'] == 0) {
            $image_name = basename($file['pdp']['name']);
            $image_tmp_name = $file['pdp']['tmp_name'];

            $image_path = $upload_dir . $image_name;
            $chemin_image = $chemin . $image_name;

            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $query = "UPDATE utilisateur SET pdp = :pdp WHERE id = :id";
                $statement = MyPDO::getInstance()->prepare($query);
                $statement->execute([
                    'pdp' => $chemin_image,
                    'id' => $id_user
                ]);
                header("Location: ../profil.php");
                exit();
            } 
            else {
                echo "Erreur lors du déplacement du fichier.";
            }
        } else {
            echo "Aucun fichier ou erreur lors de l'upload.";
        }
    }

    public function addLike($id_user, $id_user_liked){
        $data = [
            'id_user' => $id_user,
            'id_user_liked' => $id_user_liked
        ];

        $query = "INSERT INTO liked (id, id_user, id_user_liked) VALUES (NULL, :id_user, :id_user_liked)";
        $statement = MyPDO::getInstance()->prepare($query);
        if($statement->execute($data)){
            echo "like ajouté";
        }
        else{
            echo "erreur";
        }
    }

    public function removeLike($id_user, $id_user_liked){
        $data = [
            'id_user' => $id_user,
            'id_user_liked' => $id_user_liked
        ];
    
        $query = "DELETE FROM liked WHERE id_user = :id_user AND id_user_liked = :id_user_liked";
        $statement = MyPDO::getInstance()->prepare($query);
        
        if($statement->execute($data)){
            echo "like supprimé";
        }
        else{
            echo "erreur lors de la suppression";
        }
    }
}