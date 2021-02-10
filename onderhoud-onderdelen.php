<?php include 'includes/header.php'; ?>
    <h2>Onderhoud onderdelen</h2>

    <div method="POST" class="d-grid">
        <table class="margin-bottom">
            <thead>
            <tr>
                <th colspan="5" class="text-right">Nieuw onderdeel toevoegen</th>
                <th colspan="1">
                    <a href="onderhoud-onderdeel-toevoegen.php" class="add-compontent green-background highlight-btn">+</a>
                </th>
            </tr>
            <tr>
                <th>Naam onderdeel</th>
                <th>Omschrijving</th>
                <th>Prijs per KG</th>
                <th>Voorraad</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $stmt = $pdo->prepare("SELECT * FROM onderdelen");
            $stmt->execute();
            $components = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($components as $line) { ?>
                <tr>
                    <td><?= $line['Naam'] ?></td>
                    <td><?= $line['Omschrijving'] ?></td>
                    <td>€<?= number_format($line['PrijsPerKg'], 2, ',', '.') ?></td>
                    <td><?= $line['VoorraadKg'] ?></td>
                    <td class="text-center"><a class="" href="onderhoud-onderdeel.php?id=<?= $line['ID'] ?>"><i class="fas fa-edit edit"></i></a></td>
                    <td class="text-center"><a class="" href="onderhoud-onderdeel-verwijderen.php?id=<?= $line['ID'] ?>"><i class="fas fa-trash-alt delete"></i></a></td>
                </tr>
            <?php } ?>


            </tbody>
        </table>
    </div>

<?php include 'includes/footer.php'; ?>