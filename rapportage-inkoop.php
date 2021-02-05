<?php include 'includes/header.php'; ?>
    <h2>Rapportage inkoop</h2>
    <button class="green-background highlight-btn print-btn margin-bottom" style="float:right" onclick="window.print(); return false;">Uitprinten</button>
    <table class="margin-bottom">
        <thead>
        <tr>
            <th>Apparaat</th>
            <th>Maand</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->prepare("SELECT apparaten.Naam, innames.Datum FROM innameapparaat 
                                        INNER JOIN apparaten ON innameapparaat.Apparaat_ID = apparaten.ID 
                                        INNER JOIN innames ON innameapparaat.Inname_ID = innames.ID  
                                        WHERE Datum > curdate() - interval 6 month");
        $stmt->execute([]);
        $intakes = $stmt->fetchAll();

        foreach ($intakes as $intake) {
            $date = new DateTime($intake['Datum']);
            ?>
            <tr>
                <td><?= $date->format('Ym') ?></td>
                <td><?= $intake['Naam'] ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php include 'includes/footer.php'; ?>