<?php

require_once("modif_profil.php");
session_start();

$id_user = $_SESSION["id"];


$exec = new modifUtilisateur;
$exec->modifPdp($_FILES, $id_user);