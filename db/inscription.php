<?php

require_once("connexion_inscription.php");

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$password = $_POST["password"];

$exec = new connexionInscription;
$exec->inscription($prenom,$nom,$email,$password);