<?php include 'includes/header.php';
$role = $_SESSION['role'];

// if user is the role: Applicatiebeheerder / Administrator
if ($role == 5 || $role == 6) { ?>
    <h2>Medewerker toevoegen</h2>

    <form method="post" class="d-grid form-edit-component" style="">

        <div><label for="employeeName">Naam</label>
            <input class="w-100" id="employeeName" type="text" name="employeeName" placeholder="Albert Jacobs" required>
        </div>

        <div>
            <label for="employeeEmail">Omschrijvijng</label>
            <input class="w-100" id="employeeEmail" type="text" name="employeeEmail"
                   placeholder="albert@jacobs.com" required>
        </div>

        <div>
            <label for="employeePassword">Wachtwoord</label>
            <input class="w-100" id="employeePassword" type="password" name="employeePassword" placeholder="********" required>
        </div>

        <select name="employeeRole" id="employeeRole">
            <?php
            $roles = $pdo->query("SELECT * FROM rollen")->fetchAll();

            foreach ($roles as $role) { ?>
                <option value="<?= $role['ID'] ?>"><?= $role['Naam'] ?></option>
            <?php } ?>
        </select>

        <div>
            <input type="submit" value="Opslaan" name="addEmployee">
        </div>
    </form>
    <?php
    if (isset($_POST['addEmployee'])) {
        $password = password_hash($_POST['employeePassword'], PASSWORD_DEFAULT);

        $data = [
            'name' => $_POST['employeeName'],
            'email' => $_POST['employeeEmail'],
            'password' => $password,
            'role' => $_POST['employeeRole'],
        ];

        $sql = "INSERT INTO medewerkers (Naam, Email, Wachtwoord, Rol_ID) VALUES (:name, :email, :password, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        redirect_to('onderhoud-medewerkers.php');
    }

    include 'includes/footer.php';
} else {
    redirect_to('index.php');
} ?>