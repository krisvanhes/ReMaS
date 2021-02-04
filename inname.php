<?php include 'includes/header.php';

if (!empty($_SESSION['deviceError'])) {
    echo "<h2 class='error-message margin-bottom text-center'>Foutmelding: {$_SESSION['deviceError']}</h2>";
}?>
    <div class="layout layout-gap">
        <table>
            <thead>
            <tr>
                <th colspan="3">Alle apparaten</th>
            </tr>
            <tr>
                <th>Naam Apparaat</th>
                <th>Vergoeding</th>
                <th>Toevoegen</th>
            </tr>

            <?php
            $stmt = $pdo->query("SELECT * FROM apparaten");
            $devices = $stmt->fetchAll();

            foreach ($devices as $device) {

                $id = $device['ID'];
                $name = $device['Naam'];
                $compensation = number_format($device['Vergoeding'], 2, ',', '.');

                echo
                "<tr id='deviceInfo{$id}'>
                <td id='deviceName'>{$name}</td>
                <td id='deviceCompensation'>€{$compensation}</td>
                <td><button class='add-device-btn green-background highlight-btn' id='addDevice{$id}' onclick='addDeviceLine({$id})' type='button'>+</button></td>
            </tr>";

            } ?>
            </thead>
            <tbody></tbody>
        </table>

        <form method="POST" class="d-grid">
            <table class="margin-bottom">
                <thead>
                <tr>
                    <th colspan="2">Ingenomen</th>
                </tr>

                <tr>
                    <th>Naam Apparaat</th>
                    <th>Vergoeding</th>

                </tr>
                </thead>
                <tbody id="takenDevices">

                </tbody>
                <tr>
                    <th colspan="2" class="text-right">Totaalbedrag €<span id="amount">0,00</span></th> <!-- TODO: Totaalbedrag -->
                </tr>
            </table>
            <input class="submit-intake-btn green-background highlight-btn" type="submit" name="deviceSave">
        </form>
        <?php
        $_SESSION['deviceError'] = "";
        $_SESSION['deviceSuccess'] = "";

        if (isset($_POST['deviceSave'])) {
            if (isset($_POST['device_ID'])) {

                $deviceIds = $_POST['device_ID'];
                $employee = $_SESSION['id'];

                $data = [
                    'employee' => $employee,
                ];

                $sql = "INSERT INTO innames (Medewerker_ID) VALUES (:employee)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);

                $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
                $lastId = $stmt->fetchColumn();

                $_SESSION['lastIntake'] = $lastId;

                foreach ($deviceIds as $device) {
                    echo $device;

                    $data = [
                        'id' => $lastId,
                        'device' => $device,
                        'status' => 0
                    ];

                    $sql = "INSERT INTO innameapparaat (Inname_ID, Apparaat_ID, Ontleed) VALUES (:id, :device, :status)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($data);
                }
                redirect_to('inname-bon.php');
            } else {
                $_SESSION['deviceError'] = "Geen apparaten aangeklikt";
                redirect_to('inname.php');
            }
        }
        ?>
    </div>
<?php include 'includes/footer.php'; ?>