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
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/edit_profil.css">
        <title>Mon profil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div class="container">
            <div class="form-grip">
                <div class="form-container">
                    <form method="post" id="formulaire-img" enctype="multipart/form-data" action="./php/modif_pdp.php">
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

                        <input type="file" name="pdp" id="pdp" style="display: none;">
                        <div id="submit-img-container">
                            <button type="submit" id="submit-img">Modifier l'image</button>
                        </div>
                    </form>
                    <form method="post" id="formulaire">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?php echo $prenom?>">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom?>">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email?>">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" cols="30" rows="10"><?php echo $bio?></textarea>
                        <label for="campus">Campus</label>
                        <input type="text" name="campus" id="campus" placeholder="Campus" value="<?php echo $campus?>">
                        <div class="social-container">
                            <div class="two-social1">
                                <i class="fa-brands fa-instagram"></i>
                                <input type="text" name="instagram" id="instagram"  placeholder="instagram" value="<?php echo $instagram ?>">
                                <i class="fa-brands fa-linkedin"></i>
                                <input type="text" name="linkedin" id="linkedin" placeholder="linkedin" value="<?php echo $linkedin ?>">
                            </div>
                            <div class="two-social1">
                                <i class="fa-brands fa-twitter"></i>
                                <input type="text" name="twitter" id="twitter" placeholder="twitter" value="<?php echo $twitter ?>">
                                <i class="fa-brands fa-discord"></i>
                                <input type="text" name="discord" id="discord" placeholder="discord" value="<?php echo $discord ?>">
                            </div>
                        </div>
                        <div class="f j-c" id="submit-container">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="./script/profil.js"></script>
    </body>
</html>