<?php include 'includes/header.php'; ?>
    <h2>Onderhoud innames</h2>
<!---->
<!--    <div method="POST" class="d-grid">-->
<!--        <table class="margin-bottom">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Inname nummer</th>-->
<!--                <th>Inname apparaat nummer</th>-->
<!--                <th>Medewerker</th>-->
<!--                <th>Datum</th>-->
<!--                <th>Ontleed</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!---->
<!--            --><?php
//            $stmt = $pdo->prepare("SELECT innames.ID, medewerkers.Naam, innames.Datum, innameapparaat.ID AS iaID, innameapparaat.Ontleed FROM innameapparaat
//                                            INNER JOIN innames ON innameapparaat.Inname_ID = innames.id
//                                            INNER JOIN medewerkers ON innames.Medewerker_ID = medewerkers.id");
//            $stmt->execute();
//            $intakes = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//            foreach ($intakes as $key => $line) {
//                ?>
<!--                <form action="">-->
<!--                    <tr>-->
<!--                        <td>--><?//= $line['ID'] ?><!--</td>-->
<!--                        <td>--><?//= $line['iaID'] ?><!--</td>-->
<!--                        <td>--><?//= "{$line['Naam']}" ?><!--</td>-->
<!--                        <td>--><?//= $line['Datum'] ?><!--</td>-->
<!--                        <td><input type="checkbox" value="--><?//= $line['Ontleed'] ?><!--"></td>-->
<!--                    </tr>-->
<!--                </form>-->
<!--            --><?php //} ?>
<!---->
<!---->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<?php include 'includes/footer.php'; ?>