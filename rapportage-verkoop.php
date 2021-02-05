<?php include 'includes/header.php'; ?>

    <button class="green-background highlight-btn print-btn margin-bottom" style="float:right"
            onclick="window.print(); return false;">Uitprinten
    </button>

    <table class="margin-bottom w-100">
        <thead>
        <tr>
            <th>Uitgave nummer</th>
            <th>Medewerker</th>
            <th>Onderdeel</th>
            <th>Gewicht (kg)</th>
            <th>Datum</th>
            <th>Prijs</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $outtakes = $pdo->query("SELECT uitgiftes.id, uitgiftes.Medewerker_ID, onderdelen.Naam, uitgiftes.Datum, uitgiftes.GewichtKg, uitgiftes.Prijs, medewerkers.Naam as MNaam
                                          FROM uitgiftes 
                                          INNER JOIN onderdelen ON uitgiftes.Onderdeel_ID = onderdelen.ID
                                          INNER JOIN medewerkers ON uitgiftes.Medewerker_ID = medewerkers.ID
                                          ORDER BY uitgiftes.Datum DESC")->fetchAll();

        $total = 0;
        foreach ($outtakes as $line) {
            $price = number_format($line['Prijs'], 2, ',', '.');

            $total += $line['Prijs'];
            ?>
            <tr>
                <td><?= $line['id'] ?></td>
                <td><?= $line['MNaam'] ?></td>
                <td><?= $line['Naam'] ?></td>
                <td class="text-right"><?= number_format($line['GewichtKg'], 2, ',', '.') ?></td>
                <td><?= $line['Datum'] ?></td>
                <td>€<?= $price ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5" class="text-right">Totaalbedrag</td>
            <td>€<?= number_format($total, 2, ',', '.') ?></td>
        </tr>
        </tbody>
    </table>

<?php include 'includes/footer.php'; ?>