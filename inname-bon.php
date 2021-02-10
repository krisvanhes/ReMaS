<?php include 'includes/header.php';

if (isset($_SESSION['lastIntake'])) {

    $stmt = $pdo->prepare("SELECT * FROM innames WHERE ID = :id");
    $stmt->execute(['id' => $_SESSION['lastIntake']]);
    $intake = $stmt->fetch(PDO::FETCH_ASSOC);
    $date = new DateTime($intake['Datum']);

    $dateSql = strtotime($intake['Datum']);
    $date = date('d-m-y H:i', $dateSql);
    ?>


    <button class="green-background highlight-btn print-btn" style="float: right"
            onclick="window.print(); return false;">Uitprinten
    </button>

    <h3>Superior Waste - ReMaS</h3>
    <h4>bon</h4>
    <p><?= $date ?></p>
    <p>Medewerker: <?= $intake['Medewerker_ID'] ?></p>
    <p>Bonnummer: <?= $intake['ID'] ?></p>

    <table style="width: 100%">
        <?php

        $stmt = $pdo->prepare("SELECT apparaten.Naam, apparaten.Vergoeding, apparaten.ID FROM innameapparaat INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID  WHERE innameapparaat.Inname_ID = :id ");
        $stmt->execute(['id' => $_SESSION['lastIntake']]);
        $intakeLines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = 0.00;
        foreach ($intakeLines as $line) {
            $total += $line['Vergoeding'];
            ?>
            <tr>
                <td>1</td>
                <td><?= $line['Naam'] ?></td>
                <td>€<?= number_format($line['Vergoeding'], 2, ',', '.') ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td colspan="2">Totaal</td>
            <td>€ <?= number_format($total, 2, ',', '.') ?></td>
        </tr>
    </table>

<?php } else {
    redirect_to('inname.php');
} ?>

<?php include 'includes/footer.php'; ?>