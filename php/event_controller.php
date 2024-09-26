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

    public function modifEvent(){
        
    }

    public function removeEvent($id_user, $id_event){
        $dataParticipants = [
            'id_event' => $id_event
        ];
    
        $queryParticipants = "DELETE FROM inscrit WHERE id_evenement = :id_event";
        $statementParticipants = MyPDO::getInstance()->prepare($queryParticipants);
        $successParticipants = $statementParticipants->execute($dataParticipants);
    
        $dataEvent = [
            'id_event' => $id_event,
            'id_user' => $id_user
        ];
    
        $queryEvent = "DELETE FROM evenement WHERE id = :id_event AND id_user_owner = :id_user";
        $statementEvent = MyPDO::getInstance()->prepare($queryEvent);
        $successEvent = $statementEvent->execute($dataEvent);
    
        if ($successParticipants && $successEvent) {
            echo "L'événement et tous ses participants ont été supprimés avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'événement ou des participants.";
        }
    }
}