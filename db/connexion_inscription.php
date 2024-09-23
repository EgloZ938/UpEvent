<?php

require_once("MyPDO.php");

class connexionInscription{

    public function connexion($email,$password){
        $data1 = [
            'email' => $email
        ];

        $query = "SELECT * FROM utilisateur WHERE email LIKE :email LIMIT 1";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute($data1);
        $result = $statement->FetchAll();
        $nbr_resultat = $statement->rowCount();

        foreach($result as $row){
            $id = $row["id"];
            $email = $row["email"];
            $mdp_bdd = $row["mdp"];
        }

        if($nbr_resultat < 1){
            echo "email introuvable";
        }
        else{
            $mdp = $this->hashMdp($password);
            if($mdp == $mdp_bdd){
                echo "conected";
                session_start();
                $_SESSION['id'] = $id;
            }
            else{
                echo "mauvais mot de passe";
            }
        }
    }

    public function inscription($prenom,$nom,$email,$password){

        $data1 = [
            'email' => $email
        ];

        $query = "SELECT * FROM utilisateur WHERE email LIKE :email";
        $statement = MyPDO::getInstance()->prepare($query);
        $statement->execute($data1);
        $result = $statement->FetchAll();
        $nbr_resultat = $statement->rowCount();

        foreach($result as $row){
            $id = $row["id"];
        }
        
        if($nbr_resultat >= 1){
            echo "mail_existant";
        }
        else{
            $mdp = $this->hashMdp($password);
    
            $data2 = [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $mdp
            ];

            $query = "INSERT INTO utilisateur (id, nom, prenom, bio, campus, telephone, email, mdp, pdp, reseaux) VALUES (NULL, :nom, :prenom, 'null', 'null', 'null', :email, :password, 'null', 'null')";
            $statement = MyPDO::getInstance()->prepare($query);
            $statement->execute($data2);

            
            $query = "SELECT * FROM utilisateur WHERE email LIKE :email";
            $statement = MyPDO::getInstance()->prepare($query);
            $statement->execute($data1);
            $result = $statement->FetchAll();

            foreach($result as $row){
                $id = $row["id"];
            }

            session_start();
            $_SESSION['id'] = $id;
            echo "inscription_reussie";
        }

    }

    public function hashMdp($mdp){
        return hash('ripemd160', 'assoup7' . $mdp);
    }
}