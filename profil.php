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
    $prenom = $row["prenom"];
    $nom = $row["nom"];
    $bio = $row["bio"];
    $campus = $row["campus"];
    $telephone = $row["telephone"];
    $email = $row["email"];
    $img = $row["pdp"];
    $reseaux = json_decode($row["reseaux"], true);

    $instagram = isset($reseaux['instagram']) ? $reseaux['instagram'] : '';
    $linkedin = isset($reseaux['linkedin']) ? $reseaux['linkedin'] : '';
    $twitter = isset($reseaux['twitter']) ? $reseaux['twitter'] : '';
    $discord = isset($reseaux['discord']) ? $reseaux['discord'] : '';

    $query2 = "SELECT * FROM liked WHERE id_user_liked = :id";
    $statement2 = MyPDO::getInstance()->prepare($query2);
    $statement2->execute($data);
    $nbr_like = $statement2->rowCount();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/profil.css">
        <title>Mon profil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="profil-container">
                <div class="form-container">
                    <div class="img-container" id="img-container" style="cursor: pointer;">
                        <?php
                        if($img == ''){
                            ?>
                            <div id="profil" class="profil" style="background-image: url('./assets/avatar_default.png');"></div>
                            <?php
                        } else {
                            ?>
                            <div id="profil" class="profil" style="background-image: url('<?php echo $img ?>');"></div>
                            <?php
                        }
                        ?>
                    </div>
                    <h2 class="pseudo"><?php echo $prenom. " " ?><span class="c-2"><?php echo $nom ?></span></h2>
                    <h3 class="pseudo"><?php echo $bio ?></h3>
                    <h3 class="pseudo">Cet utilisateur a reçu <span class="c-2"><?php echo $nbr_like ?></span> likes</h3>
                    <div class="container_info">
                        <h3>Email : <span class="c-2"><?php echo $email ?></span></h3>
                        <?php
                            if($campus != ''){
                                ?>
                                <h3>Campus : <span class="c-2"><?php echo $campus?></span></h3>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="container_social">
                        <div class="two_social">
                            <div class="social">
                                <i class="fa-brands fa-instagram"></i>
                                <div class="social_info"><?php echo $instagram ?></div>
                            </div>
                            <div class="social">
                                <i class="fa-brands fa-linkedin"></i>
                                <div class="social_info"><?php echo $linkedin?></div>
                            </div>
                        </div>
                        <div class="two_social">
                            <div class="social">
                                <i class="fa-brands fa-twitter"></i>
                                <div class="social_info"><?php echo $twitter?></div>
                            </div>
                            <div class="social">
                                <i class="fa-brands fa-discord"></i>
                                <div class="social_info"><?php echo $discord?></div>
                            </div>
                        </div>
                    </div>

                    <h2>Mes évenements : </h2>
                    
                    <div class="card-event">
                        <?php
                            if($img == ''){
                                ?>
                                <div class="pfp-event-card" style="background-image: url('./assets/avatar_default.png');"></div>
                                <?php
                            } else {
                                ?>
                                <div class="pfp-event-card" style="background-image: url('<?php echo $img ?>');"></div>
                                <?php
                            }
                        ?>
                        <div class="f a-i">
                            <h2 class="titre-event">Foot in Five</h2>
                            <div class="pastille-theme">
                                <div class="rond rouge"></div>
                                <div class="theme" data-target="id_event">SPORT</div>
                            </div>
                        </div>
                        <h4 class="adresse-event">26 Rue Hélène et François Missoffe</h4>
                        <div class="date-heure-container f a-i">
                            <h4 class="date">Date : <span class="c-2">26/09/2024</span></h4>
                            <h4 class="heure">Heure : <span class="c-2">19h00</span></h4>
                        </div>
                        <h4 class="desc-event">Match de foot indoor 5 contre 5, venez nombreux !</h4>
                        <div class="participants-container">
                            <div class="participants">Participants : 1 / <span class="c-2">10</span></div>
                        </div>
                    </div>
                    <a href="./edit_profil.php"><div class="edit_profil_btn">Editer profil</div></a>
                </div>
            </div>
        </div>
    </body>
</html>