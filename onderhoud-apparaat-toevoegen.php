<?php include 'includes/header.php'; ?>

    <h2>Standaard apparaat toevoegen</h2>

    <form method="post" class="d-grid form-edit-component" style="">

        <div><label for="componentName">Naam</label>
            <input id="componentName" type="text" name="componentName" placeholder="Laptop" required>
        </div>

        <div>
            <label for="componentDescription">Omschrijvijng</label>
            <input id="componentDescription" type="text" name="componentDescription"
                   placeholder="Dit is een omschrijving" required>
        </div>

        <div>
            <label for="deviceCompensation">Vergoeding</label>
            <input id="deviceCompensation" type="number" step="0.01" name="deviceCompensation" placeholder="0.00" required>
        </div>

        <div>
            <label for="deviceWeight">Gewicht in grammen</label>
            <input id="deviceWeight" type="number" step="0.01" name="deviceWeight" placeholder="0.00" required>
        </div>

        <div>
            <input type="submit" value="Opslaan" name="addComponent">
        </div>
    </form>
<?php
if (isset($_POST['addComponent'])) {
    $data = [
        'name' => $_POST['componentName'],
        'description' => $_POST['componentDescription'],
        'compensation' => $_POST['deviceCompensation'],
        'weight' => $_POST['deviceWeight'],
    ];

    $sql = "INSERT INTO apparaten (Naam, Omschrijving, Vergoeding, GewichtGram) VALUES (:name, :description, :compensation, :weight)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    redirect_to('onderhoud-apparaten.php');
}
include 'includes/footer.php'; ?>