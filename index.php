<?php
require_once("./db/MyPDO.php");
session_start();
if($_SESSION["id"]){
    $id_user = $_SESSION["id"];
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
<i class="fa-solid fa-plus"></i>

<h1><a href="./index.html">UpEvent</a></h1>
<?php
    if($_SESSION["id"]){
        ?>
        <div class="profil">
            <img src="./assets/avatar_default.png" alt="profil">
        </div>
        <?php
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
</header>
<h1> connecté user id : <?php echo $id_user ?></h1>
<script src="./script/app.js"></script>
</body>
</html>

