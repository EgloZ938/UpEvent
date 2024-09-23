<?php

require_once("connexion_inscription.php");

$email = $_POST["email"];
$password = $_POST["password"];

$exec = new connexionInscription;
$exec->connexion($email,$password);