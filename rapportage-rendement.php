<?php include 'includes/header.php';

$date = new DateTime();
?>

    <h2>Rapportage rendement voor de maand <?= $date->format('Y-m') ?></h2>

    <button class="green-background highlight-btn print-btn margin-bottom" style="float:right"
            onclick="window.print(); return false;">Uitprinten
    </button>

    <table class="w-100">
        <thead>
        <tr>
            <th>Apparaat</th>
            <th>Uitbetaald</th>
            <th>Totale opbrengst</th>
        </tr>
        </thead>
        <?php

        $devices = $pdo->query("SELECT apparaten.Naam, SUM(apparaten.Vergoeding) AS total FROM innameapparaat
                                         INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID
                                         GROUP BY Apparaat_ID")->fetchAll();

        $out = $pdo->query("SELECT SUM(Prijs) as Prijs FROM uitgiftes")->fetch();

        $totalDevices = 0;
        foreach ($devices as $device) {
            $totalDevices += $device['total'];
            ?>
            <tr>
                <td><?= $device['Naam'] ?></td>
                <td>€<?= number_format($device['total'], '2', ',', '.') ?></td>
                <td></td>
            </tr>

        <?php } ?>

            <tr>
                <td>Totaal</td>
                <td>€<?= number_format($totalDevices, '2', ',', '.') ?></td>
                <td>€<?= number_format($out['Prijs'], '2', ',', '.') ?></td>
            </tr>
    </table>
<?php include 'includes/footer.php'; ?>