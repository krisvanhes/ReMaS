<?php include 'includes/header.php'; ?>

<?php
$role = $_SESSION['role'];

//if ($role != 1 || $role != 2 || $role != 3 || $role != 4) {
//    redirect_to('index.php');
//} else {
    ?>
    <h2>Standaard apparaat toevoegen</h2>

    <form method="post" class="d-grid form-edit-component" style="">

        <div><label for="componentName">Naam</label>
            <input id="componentName" type="text" name="componentName" placeholder="Laptop">
        </div>

        <div>
            <label for="componentDescription">Omschrijvijng</label>
            <input id="componentDescription" type="text" name="componentDescription"
                   placeholder="Dit is een omschrijving">
        </div>

        <div>
            <label for="componentPrice">Prijs per kilogram</label>
            <input id="componentPrice" type="number" step="0.01" name="componentPrice" placeholder="0.00">
        </div>

        <div>
            <label for="componentStock">Voorraad</label>
            <input id="componentStock" type="number" step="0.01" name="componentStock" placeholder="0.00">
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
            'price' => $_POST['componentPrice'],
            'stock' => $_POST['componentStock'],
        ];

        $sql = "INSERT INTO apparaat (Naam, Omschrijving, PrijsPerKg, VoorraadKg) VALUES (:name, :description, :price, :stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        redirect_to('onderhoud-onderdelen.php');
//    }
}
include 'includes/footer.php'; ?>