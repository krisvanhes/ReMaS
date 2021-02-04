<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM apparaten WHERE id = :id");
$stmt->execute(['id' => $id]);
$component = $stmt->fetch();

if (!$component) {
    redirect_to('onderhoud-apparaten.php');
} else {
    ?>
    <h2>Onderhoud standaard apparaat: <?= $component['Naam'] ?></h2>

    <form method="post" class="d-grid form-edit-component" style="">

        <div><label for="componentName">Naam</label>
            <input id="componentName" type="text" name="componentName" value="<?= $component['Naam'] ?>">
        </div>

        <div>
            <label for="componentDescription">Omschrijvijng</label>
            <input id="componentDescription" type="text" name="componentDescription" value="<?= $component['Omschrijving'] ?>">
        </div>

        <div>
            <label for="componentPrice">Vergoeding</label>
            <input id="componentPrice" type="number" step="0.01" name="componentPrice" value="<?= $component['Vergoeding'] ?>">
        </div>

        <div>
            <label for="componentStock">Gewicht Gram</label>
            <input id="componentStock" type="number" step="0.01" name="componentStock" value="<?= $component['GewichtGram'] ?>">
        </div>

        <div>
            <input type="submit" value="Opslaan" name="updateComponent">
        </div>


    </form>
    <?php
    if (isset($_POST['updateComponent'])) {
        $data = [
            'id' => $id,
            'name' => $_POST['componentName'],
            'description' => $_POST['componentDescription'],
            'price' => $_POST['componentPrice'],
            'stock' => $_POST['componentStock'],
        ];
        $sql = "UPDATE onderdelen SET Naam=:name, Omschrijving=:description, PrijsPerKg=:price, VoorraadKg=:stock WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        redirect_to('onderhoud-onderdelen.php');
    }
}
include 'includes/footer.php'; ?>