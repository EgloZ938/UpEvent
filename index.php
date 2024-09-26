
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
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
<a href="evenement.html" class="croix"><i class="fa-solid fa-plus" style="font-size: 45px;"></i></a>

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

<div class="ripple-background">
        <div class="circle xxlarge shade1"></div>
        <div class="circle xlarge shade2"></div>
        <div class="circle large shade3"></div>
        <div class="circle medium shade4"></div>
        <div class="circle small shade5"></div>
</div>



<div class="container">
    <img src="icons/" class="icon"/>
        <div class="text-container">
            <!-- Titre -->
            <h2 class="title">Titre Variable</h2>
            <!-- Image -->
            <img src="assets/avatar_default.png" class="pdp"/>
            <!-- Description -->
            <label class="description">Description<br>Pouvant prendre<br>plusieurs <br> lignes</label>
        </div>  

        <div class="info-container">
            <!--Lieu-->
            <label class="lieu">Lieu :</label>
            <!--Date-->
            <label class="date">Date :</label>
        </div>

        <button type="button" class="inscription">S'inscrire</button>
        <div class="nb-container">
            <label class="personnes">3 / 5</label>
            <i class="fa-solid fa-person"></i>
        </div>
</div>


            <!--Script de sélection de bouton + changement de couleur -->
            <script>
                function selectEventType(button) {
                    // Enlève la classe "selected" de tous les boutons
                    const buttons = document.querySelectorAll('.button');
                    buttons.forEach(btn => {
                        btn.classList.remove('selected');
                        // Réinitialise la couleur des boutons
                        btn.style.backgroundColor = ""; // Réinitialise la couleur de fond
                    });

                    // Ajoute la classe "selected" et change la couleur de fond du bouton cliqué
                    button.classList.add('selected');
                    button.style.backgroundColor = "#700A36";
                }
            </script>
<script src="./script/app.js"></script>
</body>
</html>

