<?php
require_once("./db/MyPDO.php");
session_start();
if($_SESSION["id"]){
    $id_user = $_SESSION["id"];
    $connected = true;
}

if (isset($_GET['id_user'])) {
    $id_user_profil = $_GET['id_user'];
    if($id_user == $id_user_profil){
        $data = [
            'id' => $id_user
        ];
        $title_page = "Mon profil";
        $peutDeco = true;
    }
    else{
        $data = [
            'id' => $id_user_profil
        ];
        $peutDeco = false;
    }
}
else{
    $data = [
        'id' => $id_user
    ];
    $title_page = "Mon profil";
    $peutDeco = true;
}

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

if (isset($_GET['id_user'])) {
    if($id_user != $id_user_profil){
        $title_page = "Profil de $prenom";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/profil.css">
        <title><?php echo $title_page ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="profil-container">
                <div class="form-container">
                    <div class="img-container" id="img-container">
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
                        <?php
                            if($peutDeco == true){
                                ?>
                                <div class="deconnexion-container">
                                    <a href="./db/deconnexion.php"><div class="deco-btn">Se déconnecter</div></a>
                                </div>
                                <?php
                            }
                        ?>
                    </div>

                    <h2 class="c-2">Mes évenements : </h2>
                    <?php
                        $query2 = "SELECT * FROM evenement WHERE id_user_owner = :id";
                        $statement2 = MyPDO::getInstance()->prepare($query2);
                        $statement2->execute($data);
                        $result2 = $statement2->FetchAll();
                        $nbr_resultat = $statement2->rowCount();
                        if ($nbr_resultat < 1) {
                            $event = false;
                        }
                        else{
                            $event = true;
                        }
                        if($event == false){
                            ?>
                            <div class="card-event">
                                <h3>Vous n'avez pas créé d'évènements en cours...</h3>
                            </div>
                            <?php
                        }
                        else{
                            foreach($result2 as $row2){
                                $id_event = $row2["id"];
                                $titre = $row2["titre"];
                                $theme = $row2["theme"];
                                $lieu = $row2["lieu"];
                                $description = $row2["description"];
                                $date = $row2["date"];
                                $heure = $row2["heure"];
                                $nbr_participants = $row2["nbr_participants"];
                                $nbr_inscrit = $row2["nbr_inscrit"];
                                $finis = $row2["finis"];

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
                            ?>
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
                                if($peutDeco == true){
                                    ?>
                                    <div class="btn-gestion-container">
                                        <div class="modif-btn" data-id-event="<?php echo $id_event ?>">Modifier</div>
                                        <div class="suppr-btn" data-id-event="<?php echo $id_event ?>">Supprimer</div>
                                    </div>
                                    <?php
                                }
                                ?>
                        </div>
                            <?php
                            }
                        }
                    ?>
                    <h2 class="c-2">Je participe à :</h2>
                    <?php
                        $query3 = "SELECT * FROM inscrit WHERE id_user = :id";
                        $statement3 = MyPDO::getInstance()->prepare($query3);
                        $statement3->execute($data);
                        $result3 = $statement3->FetchAll();
                        $nbr_resultat2 = $statement3->rowCount();

                        if($nbr_resultat2 < 1){
                            ?>
                                <div class="card-event">
                                    <h3>Vous n'êtes inscrit à aucun évènement...</h3>
                                </div>
                            <?php
                        }
                        else{
                            foreach($result3 as $row3){
                                $id_evenement = $row3["id_evenement"];
                            }

                            $data2 = [
                                'id_evenement' => $id_evenement
                            ];

                            $query4 = "SELECT * FROM evenement WHERE id = :id_evenement";
                            $statement4 = MyPDO::getInstance()->prepare($query4);
                            $statement4->execute($data2);
                            $result4 = $statement4->FetchAll();

                            foreach($result4 as $row4){
                                $id_event = $row4["id"];
                                $titre = $row4["titre"];
                                $theme = $row4["theme"];
                                $lieu = $row4["lieu"];
                                $description = $row4["description"];
                                $date = $row4["date"];
                                $heure = $row4["heure"];
                                $nbr_participants = $row4["nbr_participants"];
                                $nbr_inscrit = $row4["nbr_inscrit"];
                                $finis = $row4["finis"];
                                $id_user_owner = $row4["id_user_owner"];

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

                                $data3 = [
                                    'id_user_owner' => $id_user_owner
                                ];

                                $query5 = "SELECT * FROM utilisateur WHERE id = :id_user_owner";
                                $statement5 = MyPDO::getInstance()->prepare($query5);
                                $statement5->execute($data3);
                                $result5 = $statement5->FetchAll();

                                foreach($result5 as $row5){
                                    $img_owner = $row5["pdp"];
                                }
                                ?>
                                <div class="card-event">
                                    <?php
                                        if($img == ''){
                                            ?>
                                            <div class="pfp-event-card pfp-cliquable" style="background-image: url('./assets/avatar_default.png');" data-target="<?php echo $id_user_owner ?>"></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="pfp-event-card pfp-cliquable" style="background-image: url('<?php echo $img_owner ?>');" data-target="<?php echo $id_user_owner ?>"></div>
                                            <?php
                                        }
                                        ?>
                                        <div class="f a-i">
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
                                        <div class="btn-gestion-container">
                                            <div class="desinscrire-btn btn-inscrit" id="desinscrire-btn" data-id-event="<?php echo $id_event ?>">Me désinscrire</div>
                                        </div>
                                </div>
                            <?php
                            }
                        }

                        if(isset($id_user_profil) && $id_user_profil != $id_user){
                            if($connected == true){
                                $data4 = [
                                    'id_user' => $id_user,
                                    'id_user_liked' => $id_user_profil
                                ];
    
                                $query6 = "SELECT * FROM liked WHERE id_user = :id_user AND id_user_liked = :id_user_liked";
                                $statement6 = MyPDO::getInstance()->prepare($query6);
                                $statement6->execute($data4);
                                $nbr_like_reel = $statement6->rowCount();
                                if($nbr_like_reel < 1){
                                    ?>
                                    <div class="profil_btn" id="like-btn" data-id-profil="<?php echo $id_user_profil ?>">J'aime</div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="profil_btn" id="dislike-btn" data-id-profil="<?php echo $id_user_profil ?>">Je n'aime plus</div>
                                    <?php
                                }
                            }
                        }
                        else{
                            ?>
                            <a href="./edit_profil.php"><div class="profil_btn">Editer profil</div></a>
                            <?php
                        }
                    ?> 
                </div>
            </div>
        </div>
        <script src="./script/profil.js"></script>
    </body>
</html>