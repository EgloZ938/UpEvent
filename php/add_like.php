<?php

require_once("modif_profil.php");
session_start();

$id_user = $_SESSION["id"];
$id_user_liked = $_POST["id_user_liked"];

$exec = new modifUtilisateur;
$exec->addLike($id_user, $id_user_liked);