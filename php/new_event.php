<?php

require_once("event_controller.php");
session_start();

$id_user = $_SESSION["id"];
$titre = $_POST["titre"];
$description = $_POST["description"];
$categorie = $_POST["categorie"];
$lieu = $_POST["lieu"];
$date = $_POST["date"];
$heure = $_POST["heure"];
$nbrParticipants = $_POST["nbrParticipants"];

$exec = new eventController;
$exec->newEvent($id_user, $titre, $description, $categorie, $lieu, $date, $heure, $nbrParticipants);