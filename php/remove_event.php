<?php

require_once("event_controller.php");
session_start();

$id_user = $_SESSION["id"];
$id_event = $_POST["id_event"];

$exec = new eventController;
$exec->removeEvent($id_user, $id_event);