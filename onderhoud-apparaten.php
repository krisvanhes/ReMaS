<?php include 'includes/header.php'; ?>
    <h2>Onderhoud standaard apparaten</h2>

    <div method="POST" class="d-grid">
        <table class="margin-bottom">
            <thead>
            <tr>
                <th colspan="5" class="text-right">Nieuw apparaat toevoegen</th>
                <th colspan="1">
                    <a href="onderhoud-apparaat-toevoegen.php"
                       class="add-compontent green-background highlight-btn">+</a>
                </th>
            </tr>
            <tr>
                <th>Naam apparaat</th>
                <th>Omschrijving</th>
                <th>Vergoeding</th>
                <th>Gewicht in gram</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $stmt = $pdo->prepare("SELECT * FROM apparaten");
            $stmt->execute();
            $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($devices as $line) { ?>
                <tr>
                    <td><?= $line['Naam'] ?></td>
                    <td><?= $line['Omschrijving'] ?></td>
                    <td>€<?= number_format($line['Vergoeding'], 2, ',', '.') ?></td>
                    <td><?= $line['GewichtGram'] ?></td>
                    <td class="text-center"><a class="" href="onderhoud-apparaat.php?id=<?= $line['ID'] ?>"><i class="fas fa-edit edit"></i></a></td>
                    <td class="text-center"><a class="" href="onderhoud-apparaat-verwijderen.php?id=<?= $line['ID'] ?>"><i class="fas fa-trash-alt delete"></i></a>
                    </td>
                </tr>
            <?php } ?>


            </tbody>
        </table>
    </div>

<?php include 'includes/footer.php'; ?>