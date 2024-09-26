<?php
require_once("./db/MyPDO.php");
session_start();
if($_SESSION["id"]){
    $id_user = $_SESSION["id"];
}

$data = [
    'id' => $id_user
];

$query = "SELECT * FROM utilisateur WHERE id = :id";
$statement = MyPDO::getInstance()->prepare($query);
$statement->execute($data);
$result = $statement->FetchAll();

foreach($result as $row){
    $img = $row["pdp"];
    $prenom = $row["prenom"];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page </title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    
    <link rel="icon" href="./assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <a href="evenement.html" class="croix"><i class="fa-solid fa-plus" style="font-size: 45px;"></i></a>
        <h1><a href="./">UpEvent</a></h1>
    </header>

<?php
    if($_SESSION["id"]){
        if($img == ''){
            ?>
            <a href="./profil.php">
            <div id="profil" class="profil" style="background-image: url('./assets/avatar_default.png');"></div>
        </a>
            <?php
        }
        else{
            ?>
            <div id="profil" class="profil" style="background-image: url('<?php echo $img ?>');"></div>
            <?php
        }
    }
    else{
        ?>
        <section class="buttons-container">
            <a class="button button-signup" href="./inscription.html">Inscription</a>
            <a class="button button-login" href="./connexion.html">Connexion</a>
        </section>
        <button class="mobile-menu-button" aria-label="Menu d'authentification">☰</button>
        <div class="mobile-menu">
            <a class="button button-signup" href="./inscription.html">Inscription</a>
            <a class="button button-login" href="./connexion.html">Connexion</a>
        </div>
        <?php
    }
?>
<div class="container">
    <?php
    $query = "SELECT * FROM evenement";
    $statement = MyPDO::getInstance()->prepare($query);
    $statement->execute();
    $result = $statement->FetchAll();
    $nbr_resultat = $statement->rowCount();

    if ($nbr_resultat > 0) {
        foreach($result as $row){
            $id = $row["id"];
            $titre = $row["titre"];
            $theme = $row["theme"];
            $lieu = $row["lieu"];
            $description = $row["description"];
            $date = $row["date"];
            $heure = $row["heure"];
            $nbr_participants = $row["nbr_participants"];
            $nbr_inscrit = $row["nbr_inscrit"];
            $finis = $row["finis"];
            $id_user_owner = $row["id_user_owner"];
        
            if($theme == "Sport"){
                $class_theme = "rouge";
            }
            elseif($theme == "Divertissement"){
                $class_theme = "jaune";
            }
            elseif($theme == "Travail"){
                $class_theme = "bleu";
            }
            else{
                $class_theme = "marine";
            }

            $data2 = [
                'id_user_owner' => $id_user_owner
            ];

            $query2 = "SELECT * FROM utilisateur WHERE id = :id_user_owner";
            $statement2 = MyPDO::getInstance()->prepare($query2);
            $statement2->execute($data2);
            $result2 = $statement2->FetchAll();

            foreach($result2 as $row2){
                $img_owner = $row2["pdp"];
            }
            ?>
            <div class="card-event">
            <?php
                if($img_owner == ''){
                    ?>
                    <div class="pfp-event-card pfp-cliquable" style="background-image: url('./assets/avatar_default.png');" data-target="<?php echo $id_user_owner ?>"></div>
                    <?php
                } else {
                    ?>
                    <div class="pfp-event-card pfp-cliquable" style="background-image: url('<?php echo $img_owner ?>');" data-target="<?php echo $id_user_owner ?>"></div>
                    <?php
                }
                ?>
                <div class="f a-i flex-container-titre">
                    <h2 class="titre-event"><?php echo $titre ?></h2>
                    <div class="pastille-theme">
                        <div class="rond <?php echo $class_theme ?>"></div>
                        <div class="theme" data-target="id_event"><?php echo $theme ?></div>
                    </div>
                </div>
                <h4 class="adresse-event"><?php echo $lieu ?></h4>
                <div class="date-heure-container f a-i">
                    <h4 class="date">Date : <span class="c-2"><?php echo $date ?></span></h4>
                    <h4 class="heure">Heure : <span class="c-2"><?php echo $heure ?></span></h4>
                </div>
                <h4 class="desc-event"><?php echo $description ?></h4>
                <div class="participants-container">
                    <div class="participants">Participants : <?php echo $nbr_inscrit ?> / <span class="c-2"><?php echo $nbr_participants ?></span></div>
                </div>
                <?php 

                    $data3 = [
                        'id_user' => $id_user,
                        'id_event' => $id
                    ];

                    $query3 = "SELECT * FROM inscrit WHERE id_user = :id_user AND id_evenement = :id_event";
                    $statement3 = MyPDO::getInstance()->prepare($query3);
                    $statement3->execute($data3);
                    $result3 = $statement3->FetchAll();
                    $nbr_resultat2 = $statement3->rowCount();

                    if($nbr_resultat2 < 1){
                        ?>
                        <div class="btn-gestion-container">
                            <div class="inscrire-btn btn-inscrit" data-id-event="<?php echo $id ?>">M'inscrire</div>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="btn-gestion-container">
                            <div class="desinscrire-btn btn-inscrit" data-id-event="<?php echo $id ?>">Me désinscrire</div>
                        </div>
                        <?php
                    }
                ?>
        </div>
        <?php 
        }
        ?>
        </div>
        <?php
    }
    else {
        echo "<p>Aucun événement disponible pour le moment.</p>";
    }
?>
<script src="./script/app.js"></script>
</body>
</html>

