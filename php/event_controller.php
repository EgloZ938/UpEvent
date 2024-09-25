<?php

require_once("../db/MyPDO.php");

class eventController{
    public function newEvent($id_user, $titre, $description, $categorie, $lieu, $date, $heure, $nbrParticipants){
            $data = [
                'id_user' => $id_user,
                'titre' => $titre,
                'description' => $description,
                'theme' => $categorie,
                'lieu' => $lieu,
                'date' => $date,
                'heure' => $heure,
                'nbrParticipants' => $nbrParticipants
            ];

            $query = "INSERT INTO evenement (id, titre, theme, lieu, description, date, heure, nbr_participants, nbr_inscrit, finis, id_user_owner) VALUES (NULL, :titre, :theme, :lieu, :description, :date, :heure, :nbrParticipants, '1', '0', :id_user)";
            $statement = MyPDO::getInstance()->prepare($query);
            if($statement->execute($data)){
                echo "réussite";
            }
            else{
                echo "echec";
            }
    }
}