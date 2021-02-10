<?php include 'includes/header.php'; ?>

    <h2>Rapportage werkvoorraad</h2>

    <button class="green-background highlight-btn print-btn margin-bottom" style="float:right"
            onclick="window.print(); return false;">Uitprinten
    </button>


    <table class="w-100">
        <thead>
        <tr>
            <th>Inname nummer</th>
            <th>Medewerker</th>
            <th>Apparaat naam</th>
            <th>Tijdstip ontvangst</th>
        </tr>
        </thead>

        <?php

        $stmt = $pdo->prepare("SELECT innames.ID, innames.Medewerker_ID, innames.Datum, apparaten.Naam
                                        FROM innameapparaat 
                                        INNER JOIN innames ON innameapparaat.Inname_ID = innames.ID
                                        INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID
                                        WHERE innameapparaat.Ontleed = false
                                        ORDER BY Datum ASC
                                        ");
        $stmt->execute();
        $intakeLines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($intakeLines as $line) {
            $dateSql = strtotime($line['Datum']);
            $date = date('d-m-y H:i', $dateSql);
            ?>
            <tr>
                <td><?= $line['ID'] ?></td>
                <td><?= $line['Medewerker_ID'] ?></td>
                <td><?= $line['Naam'] ?></td>
                <td><?= $date ?></td>
            </tr>
        <?php } ?>
    </table>

<?php include 'includes/footer.php'; ?>