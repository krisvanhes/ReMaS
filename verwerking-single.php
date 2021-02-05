<?php include 'includes/header.php';

$id = $_GET['id']; ?>

    <h2>Verwerking innamenummer: <?= $id ?></h2>

<?php


$stmt = $pdo->prepare("SELECT * FROM innameapparaat
                                INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID
                                WHERE Inname_ID = :id ");
$stmt->execute(['id' => $id]);
$process = $stmt->fetch();

if (!$process) {
    redirect_to('verwerking.php');
} else {
    ?>

<?php } ?>

<?php include 'includes/footer.php'; ?>