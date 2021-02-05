<?php include 'includes/header.php';

$employeeId = $_SESSION['id'];
?>

    <form method="post" class="d-grid form-edit-device">

        <div><label for="outtakeEmployee">Medewerker</label>
            <input class="w-100" id="outtakeEmployee" type="text" name="outtakeEmployeeName"
                   placeholder="<?= $_SESSION['name'] ?>"
                   readonly>
            <input type="hidden" name="outtakeEmployeeId" value="<?= $employeeId ?>">
        </div>

        <div class="d-grid">
            <label for="outtakeComponent">Onderdeel</label>
            <select name="outtakeComponent" id="outtakeComponent">
                <?php
                $compontents = $pdo->query("SELECT * FROM onderdelen")->fetchAll();

                foreach ($compontents as $compontent) { ?>
                    <option value="<?= $compontent['ID'] ?>"><?= $compontent['Naam'] ?> ===>
                        Voorraad: <?= $compontent['VoorraadKg'] ?> kg
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label for="outtakeStock">Hoeveelheid (kg)</label>
            <input class="w-100" id="outtakeStock" type="number" step="0.01" value="0.00" name="outtakeStock"
                   value="<?= $device['GewichtGram'] ?>">
        </div>

        <input class="green-background highlight-btn text-right" type="submit" style="padding: 1rem;" value="Uitgeven"
               name="outtake">
    </form>
<?php

if (isset($_POST['outtake'])) {
    $compontentId = $_POST['outtakeComponent'];
    $compontent = $pdo->query("SELECT * FROM onderdelen WHERE ID = {$compontentId}")->fetch();

    if ($_POST['outtakeStock'] == 0.00 || $compontent['VoorraadKg'] <= 0) {
        redirect_to('uitgifte.php');
    } else {

        $weight = $_POST['outtakeStock'];

        $price = number_format(($weight / $compontent['PrijsPerKg']), 2, '.', '.');

        $data = [
            'employeeId' => $employeeId,
            'componentId' => $compontentId,
            'weight' => $weight,
            'price' => $price,
        ];

        $sql = "INSERT INTO uitgiftes (Medewerker_Id, Onderdeel_ID, GewichtKg, Prijs) VALUES (:employeeId, :componentId, :weight, :price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        $newWeight = number_format(($compontent['VoorraadKg'] - $weight), 2, '.', '.');

        $data = [
            'weight' => $newWeight,
            'id' => $compontentId
        ];

        $sql = "UPDATE onderdelen SET VoorraadKg=:weight WHERE id=:id";
        $pdo->prepare($sql)->execute($data);

        redirect_to('uitgifte.php');
    }
}
?>


<?php include 'includes/footer.php'; ?>