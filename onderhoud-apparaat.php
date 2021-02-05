<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM apparaten WHERE id = :id");
$stmt->execute(['id' => $id]);
$device = $stmt->fetch();

if (!$device) {
    redirect_to('onderhoud-apparaten.php');
} else {
    ?>
    <h2>Onderhoud standaard apparaat: <?= $device['Naam'] ?></h2>

    <form method="post" class="d-grid form-edit-device">

        <div><label for="deviceName">Naam</label>
            <input id="deviceName" type="text" name="deviceName" value="<?= $device['Naam'] ?>">
        </div>

        <div>
            <label for="deviceDescription">Omschrijvijng</label>
            <input id="deviceDescription" type="text" name="deviceDescription" value="<?= $device['Omschrijving'] ?>">
        </div>

        <div>
            <label for="devicePrice">Vergoeding</label>
            <input id="devicePrice" type="number" step="0.01" name="devicePrice" value="<?= $device['Vergoeding'] ?>">
        </div>

        <div>
            <label for="deviceStock">Gewicht Gram</label>
            <input id="deviceStock" type="number" step="0.01" name="deviceStock" value="<?= $device['GewichtGram'] ?>">
        </div>

        <div>
            <input type="submit" value="Opslaan" name="updateDevice">
        </div>

        <hr>
        <h2>Huidige onderdelen</h2>

        <table class="margin-bottom">
            <thead>
            <tr>
                <th>Onderdeel</th>
                <th>Gewicht %</th>
                <th>Gewicht in gram</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $stmt = $pdo->prepare("SELECT onderdeelapparaat.Apparaat_ID, onderdelen.ID, onderdeelapparaat.Percentage, onderdelen.Naam, apparaten.GewichtGram 
                                            FROM onderdeelapparaat 
                                            INNER JOIN onderdelen ON onderdeelapparaat.Onderdeel_ID = onderdelen.ID
                                            INNER JOIN apparaten ON onderdeelapparaat.Apparaat_ID = {$id}
                                            WHERE onderdeelapparaat.Apparaat_ID = {$id}
                                           ");
            $stmt->execute();
            $compontents = $stmt->fetchAll();

            foreach ($compontents as $compontent) { ?>
                <tr>
                    <td><?= $compontent['Naam'] ?></td>
                    <td class="text-right"><?= $compontent['Percentage'] ?></td>
                    <td class="text-right"><?= $compontent['GewichtGram'] ?></td>
                    <td class="text-right"><a
                                href="onderhoud-apparaat-onderdeel-verwijderen.php?id=<?= $id ?>&componentId=<?= $compontent['ID'] ?>">Verwijderen</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>

    <?php
    if (isset($_POST['updateDevice'])) {
        $data = [
            'id' => $id,
            'name' => $_POST['deviceName'],
            'description' => $_POST['deviceDescription'],
            'price' => $_POST['devicePrice'],
            'stock' => $_POST['deviceStock']
        ];
        $sql = "UPDATE apparaten SET Naam=:name, Omschrijving=:description, Vergoeding=:price, GewichtGram=:stock WHERE ID=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        redirect_to('onderhoud-apparaten.php');
    }

    ?>
    <hr>

    <h2>Onderdelen toevoegen</h2>

    <form action="" method="post" style="display: grid; grid-template-columns: 2fr 2fr 1fr;grid-gap: 1rem;">

        <select name="newComponent" id="newComponent">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM onderdelen");
            $stmt->execute();
            $compontents = $stmt->fetchAll();

            foreach ($compontents as $compontent) { ?>
                <option value="<?= $compontent['ID'] ?>"><?= $compontent['Naam'] ?></option>
            <?php } ?>
        </select>

        <div style="justify-self: center;">
            <label for="componentPercent">Percentage</label>
            <input type="number" step="1" max="100" name="componentPercent" id="componentPercent"
                   placeholder="Percentage" value="0">
        </div>

        <input style="justify-self: end;" type="submit" class="add-device-btn highlight-btn green-background"
               name="addComponent" value="+">
    </form>
    <?php
    if (isset($_POST['addComponent'])) {
        $data = [
            'id' => $id,
            'componentId' => $_POST['newComponent'],
        ];

        $sql = "SELECT * FROM onderdeelapparaat WHERE Apparaat_ID = :id AND Onderdeel_ID = :componentId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetch();

        if ($result) {
            $data = [
                'id' => $id,
                'componentId' => $_POST['newComponent'],
                'percent' => $_POST['componentPercent']
            ];
            $sql = "UPDATE onderdeelapparaat SET Percentage=:percent WHERE Apparaat_ID=:id AND Onderdeel_ID = :componentId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        } else {
            $data = [
                'id' => $id,
                'componentId' => $_POST['newComponent'],
                'percent' => $_POST['componentPercent']
            ];

            $sql = "INSERT INTO onderdeelapparaat (Onderdeel_ID, Apparaat_ID, Percentage) VALUES (:componentId, :id, :percent) 
                ON DUPLICATE KEY UPDATE Onderdeel_ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        }

        redirect_to($_SERVER['HTTP_REFERER']);
    }
}
include 'includes/footer.php'; ?>