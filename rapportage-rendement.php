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
            <th>Uitbetaald deze maand</th>
            <th>Uitbetaald totaal</th>
            <th>Inkomsten</th>
            <th>Totale opbrengst</th>
        </tr>
        </thead>
        <?php
        $thisMonth = $pdo->query("SELECT SUM(Vergoeding) FROM innameapparaat 
                                    INNER JOIN apparaten ON innameapparaat.apparaat_ID = apparaten.ID
                                    INNER JOIN innames ON innameapparaat.inname_ID = innames.ID
                                    WHERE Datum > curdate() - interval 1 month
                                    ")->fetch(PDO::FETCH_ASSOC);

        $out = $pdo->query("SELECT SUM(Vergoeding) FROM innameapparaat 
                                    INNER JOIN apparaten ON innameapparaat.apparaat_ID = apparaten.ID
                                    INNER JOIN innames ON innameapparaat.inname_ID = innames.ID
                                    ")->fetch(PDO::FETCH_ASSOC);

        $in = $pdo->query("SELECT SUM(Prijs) FROM uitgiftes")->fetch(PDO::FETCH_ASSOC);

        $total = $in["SUM(Prijs)"] - $out["SUM(Vergoeding)"];
        ?>
        <tr>
            <td>€<?= number_format($thisMonth["SUM(Vergoeding)"], '2', ',', '.') ?></td>
            <td>€<?= number_format($out["SUM(Vergoeding)"], '2', ',', '.') ?></td>
            <td>€<?= number_format($in["SUM(Prijs)"], '2', ',', '.') ?></td>
            <td>€<?= number_format($total, '2', ',', '.') ?></td>
        </tr>
    </table>

<?php include 'includes/footer.php'; ?>