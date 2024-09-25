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
         
         ?>
    <div class="event">
        <h2><?php echo htmlspecialchars($titre); ?></h2>
        <p><strong>Thème :</strong> <?php echo htmlspecialchars($theme); ?></p>
        <p><strong>Lieu :</strong> <?php echo htmlspecialchars($lieu); ?></p>
        <p><strong>Description :</strong> <?php echo htmlspecialchars($description); ?></p>
        <p><strong>Date :</strong> <?php echo htmlspecialchars($date); ?></p>
        <p><strong>Heure :</strong> <?php echo htmlspecialchars($heure); ?></p>
        <p><strong>Nombre de participants :</strong> <?php echo htmlspecialchars($nbr_participants); ?></p>
        <p><strong>Nombre d'inscrits :</strong> <?php echo htmlspecialchars($nbr_inscrit); ?></p>
        <p><strong>Organisateur :</strong> <?php echo htmlspecialchars($id_user_owner); ?></p>
    </div>
    <hr>
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

