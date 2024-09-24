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
    $reseaux = $row["reseaux"];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/profil.css">
        <title>Mon profil</title>
    </head>

    <body>
        <div id="profil" class="profil" style="background-image: url('./assets/avatar_default.png');"></div>
        <div class="modify" style="background-image: url('./assets/crayon.png');"></div>

        <div class="container">
            <div class="form-grip">
                <div class="form-container">
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
                        <div class="f j-c" id="submit-container">
                            <button type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>