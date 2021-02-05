<?php
include 'includes/header.php';

$id = $_GET['id'];
$compontentId = $_GET['componentId'];

$sql = "DELETE FROM onderdeelapparaat WHERE Apparaat_ID = {$id} AND Onderdeel_ID = {$compontentId}";

$pdo->exec($sql);

redirect_to($_SERVER['HTTP_REFERER']);
?>