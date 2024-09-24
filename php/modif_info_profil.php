<?php

require_once("modif_profil.php");
session_start();

$id_user = $_SESSION["id"];
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$bio = $_POST["bio"];
$campus = $_POST["campus"];

$exec = new modifUtilisateur;
$exec->modifInfo($id_user, $prenom, $nom, $email, $bio, $campus);