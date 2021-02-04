<?php include 'includes/header.php'; ?>
    <h2>Onderhoud innames</h2>

    <div method="POST" class="d-grid">
        <table class="margin-bottom">
            <thead>
            <tr>
                <th>Inname nummer</th>
                <th>Medewerker</th>
                <th>Apparaat</th>
                <th>Vergoeding</th>
                <th>Datum</th>
                <th>Aanpassen</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $stmt = $pdo->prepare("SELECT * FROM innameapparaat
                                            INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID 
                                            INNER JOIN innames ON innameapparaat.Inname_ID = innames.ID ORDER BY Datum DESC
                                            ");
            $stmt->execute();
            $intakes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($intakes as $key => $line) {
                ?>
                <tr>
                    <td><?= $line['ID'] ?></td>
                    <td><?= "{$line['Medewerker_ID']}" ?></td>
                    <td><?= "{$line['Naam']}" ?></td>
                    <td>€<?= number_format($line['Vergoeding'], 2, ',', '.') ?></td>
                    <td><?= $line['Datum'] ?></td>
                    <td><a class="" href="onderhoud-inname.php?id=<?= $line['ID'] ?>">Aanpassen</a></td>
                </tr>
            <?php } ?>


            </tbody>
        </table>
    </div>

<?php include 'includes/footer.php'; ?>