<?php include 'includes/header.php'; ?>
    <form method="POST">
        Inwoners gegevens <br>
        <input type="text" placeholder="Adres">
        <input type="submit" value="Opslaan" name="deviceSave">

        <hr>

        Apparaten <br>

        <div class="device-line">
            <input type="text" placeholder="Naam apparaat" name="device[0]">
            <input type="number" placeholder="Aantal" name="number[0]" min="0">
            <input type="number" placeholder="Vergoeding" name="compensation[0]" step="0.01">
            Gedemonteerd:<input id="mounted" type="checkbox" name="mounted[0]" value="1">
            <input type="button" value="+" onclick="extraDeviceLine()">
        </div>
    </form>

<?php
if (isset($_POST['deviceSave'])) {
    $data = [
        'name' => $name,
    ];
    $sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    $data = [
        'name' => $name,
    ];
    $sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}
?>

<?php include 'includes/footer.php'; ?>