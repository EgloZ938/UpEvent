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

    public function addInscription($id_user, $id_event){
        $data = [
            'id_user' => $id_user,
            'id_event' => $id_event
        ];

        $query = "INSERT INTO inscrit (id, id_user, id_evenement) VALUES (NULL, :id_user, :id_event)";
        $statement = MyPDO::getInstance()->prepare($query);
        $success_inscription = $statement->execute($data);

        $data3 = [
            'id_event' => $id_event
        ];

        $queryEvent = "SELECT * FROM evenement WHERE id = :id_event";
        $statementEvent = MyPDO::getInstance()->prepare($queryEvent);
        $statementEvent->execute($data3);
        $result = $statementEvent->FetchAll();

        foreach($result as $row){
            $nbr_inscrit = $row["nbr_inscrit"];
        }

        $nbr_inscrit += 1;

        $data2 = [
            'nbr_inscrit' => $nbr_inscrit,
            'id_event' => $id_event
        ];

        $query2 = "UPDATE evenement SET nbr_inscrit = :nbr_inscrit WHERE id = :id_event";
        $statement2 = MyPDO::getInstance()->prepare($query2);
        $success_incrementation = $statement2->execute($data2);

        if($success_inscription && $success_incrementation){
            echo "réussite";
        }
        else{
            echo "échec";
        }
    }

    public function removeInscription($id_user, $id_event){
        $data = [
            'id_user' => $id_user,
            'id_event' => $id_event
        ];

        $query = "DELETE FROM inscrit WHERE id_user = :id_user AND id_evenement = :id_event";
        $statement = MyPDO::getInstance()->prepare($query);
        $success_desinscription = $statement->execute($data);

        $data3 = [
            'id_event' => $id_event
        ];

        $queryEvent = "SELECT * FROM evenement WHERE id = :id_event";
        $statementEvent = MyPDO::getInstance()->prepare($queryEvent);
        $statementEvent->execute($data3);
        $result = $statementEvent->FetchAll();

        foreach($result as $row){
            $nbr_inscrit = $row["nbr_inscrit"];
        }

        $nbr_inscrit -= 1;

        $data2 = [
            'nbr_inscrit' => $nbr_inscrit,
            'id_event' => $id_event
        ];

        $query2 = "UPDATE evenement SET nbr_inscrit = :nbr_inscrit WHERE id = :id_event";
        $statement2 = MyPDO::getInstance()->prepare($query2);
        $success_decrementation = $statement2->execute($data2);

        if($success_desinscription && $success_decrementation){
            echo "réussite";
        }
        else{
            echo "échec";
        }
    }
}