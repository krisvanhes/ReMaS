<?php include 'includes/header.php';

if (isset($_SESSION['lastIntake'])) {

    $stmt = $pdo->prepare("SELECT * FROM innames WHERE ID = :id");
    $stmt->execute(['id' => $_SESSION['lastIntake']]);
    $intake = $stmt->fetch(PDO::FETCH_ASSOC); ?>

    <h3>Superior Waste - ReMaS</h3>
    <h4>bon</h4>
    <p>Medewerker: <?= $intake['Medewerker_ID'] ?></p>
    <p>Bonnummer: <?= $intake['ID'] ?></p>

    <table>
        <?php

        $stmt = $pdo->prepare("SELECT apparaten.Naam, apparaten.Vergoeding, apparaten.ID FROM innameapparaat INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID  WHERE innameapparaat.Inname_ID = :id ");
        $stmt->execute(['id' => $_SESSION['lastIntake']]);
        $intakeLines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($intakeLines as $line) {
            ?>
            <tr>
                <td><?= $line['Vergoeding'] ?></td>
                <td><?= $line['Vergoeding'] ?></td>
            </tr>
        <?php } ?>
    </table>

<?php } ?>

<?php include 'includes/footer.php'; ?>