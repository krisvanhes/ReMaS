<?php include 'includes/header.php'; ?>

    <h2>Verwerking</h2>

    <table class="w-100">
        <thead>
        <tr>
            <th colspan="7">Innames</th>
        </tr>
        <tr>
            <th>Inname nummer</th>
            <th>Medewerker</th>
            <th>Tijdstip ontvangst</th>
            <th>Aanpassen</th>
        </tr>
        </thead>
        <?php

        $stmt = $pdo->prepare("SELECT innames.ID, innames.Medewerker_ID, innames.Datum
                                        FROM innames 
                                        INNER JOIN innameapparaat ON innameapparaat.Inname_ID = innames.ID
                                        WHERE innameapparaat.Ontleed = false
                                        ");
        $stmt->execute();
        $intakeLines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($intakeLines as $line) {
            $date = new DateTime($line['Datum']);
            ?>
            <tr>
                <td><?= $line['ID'] ?></td>
                <td><?= $line['Medewerker_ID'] ?></td>
                <td><?= $date->format('d-m-y H:m') ?></td>
                <td><a href="verwerking-single.php?id=<?= $line['ID'] ?>">Aanpassen</a></td>
            </tr>
        <?php } ?>
    </table>

<?php include 'includes/footer.php'; ?>