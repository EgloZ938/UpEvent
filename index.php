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
        ?>
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
<script src="./script/app.js"></script>
</body>
</html>

