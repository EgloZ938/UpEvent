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
    <title>Main page</title>
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
<a href="evenement.html" class="croix"><i class="fa-solid fa-plus"></i></a>

<h1><a href="./">UpEvent</a></h1>
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
     $query2 = "SELECT * FROM evenement";
     $statement = MyPDO::getInstance()->prepare($query2);
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
            

            $data2 = [
                'id_user_owner' => $row["id_user_owner"]
            ];

            $query3 = "SELECT * FROM utilisateur WHERE id = :id_user_owner";
            $statement2 = MyPDO::getInstance()->prepare($query3);
            $statement2->execute($data2);
            $result2 = $statement2->FetchAll();

            foreach($result2 as $row2){
                $img_owner = $row2["pdp"];
            }
        ?>
    <div class="card_container">
        <div class="text-container">
            <!-- Titre -->
            <h2 class="title"><?php echo $titre; ?></h2>
            <!-- Images -->
            <?php
            if($img_owner == ''){
                ?>
                <a href="./profil.php">
                <div id="profil" class="profil" style="background-image: url('./assets/avatar_default.png');"></div>
                </a>
                <?php
            }
            else{
                ?>
                <div id="profil" class="profil" style="background-image: url('<?php echo $img_owner ?>');"></div>
                <?php
            }
            ?>
            <!-- prenom -->
            <p><?php echo $prenom; ?></p>
            <!-- Description -->
            <label class="description"><?php echo $description; ?></label>
        </div>  

        <div class="info-container">
            <!--Lieu-->
            <label class="lieu"><?php echo $lieu; ?></label>
            <!--Date-->
            <label class="date"><?php echo $date; ?></label>
        </div>

        <button type="button" class="event_button">S'inscrire</button>
        <div class="nb-container">
            <p class="personnes">Participants : <?php echo $nbr_inscrit ?> / <?php echo $nbr_participants ?> </p>
            </div>
</div>
    <?php
    }
    }
 else {
    
    echo "<p>Aucun événement disponible pour le moment.</p>";
}
?>
</header>
<script src="./script/app.js"></script>
</body>
</html>

