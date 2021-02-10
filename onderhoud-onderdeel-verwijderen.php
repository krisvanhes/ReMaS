<?php
include 'includes/header.php';

$id = $_GET['id'];

$sql = "DELETE FROM onderdelen WHERE ID = {$id}";

$pdo->exec($sql);

redirect_to($_SERVER['HTTP_REFERER']);
?>