<?php include 'includes/header.php'; ?>

    <div class="container login-content">
        <h1>Het spijt ons..</h1>

        <p>Helaas is dit portaal alleen beschikbaar voor medewerkers van ReMaS</p>
        <p>Als je een account hebt kun je er hierboven mee inloggen</p>
    </div>

<?php
if (isset($_SESSION['loggedin'])) {
    redirect_to('index.php');
} else {

// Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        redirect_to('index.php');
    }

    $_SESSION['error'] = "";

// Processing form data when form is submitted
    if (isset($_POST['login'])) {

        // Check if username is empty
        if (empty(trim($_POST["email"]))) {
            $username_err = "Please enter email.";
        } else {
            $username = trim($_POST["email"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Prepare a select statement
        $sql = "SELECT ID, Email, Wachtwoord, Naam, Rol_ID FROM medewerkers WHERE Email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if email exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["ID"];
                        $email = $row["Email"];
                        $username = $row["Naam"];
                        $role = $row['Rol_ID'];
                        $hashed_password = $row["Wachtwoord"];

                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["name"] = $username;
                            $_SESSION["role"] = $role;

                            $_SESSION['error'] = "";
                            // Redirect user to welcome page
                            redirect_to('index.php');
                        } else {
                            // Display an error message if password is not valid
                            $_SESSION['error'] = "De gebruiker/het wachtwoord klopt niet";
                            redirect_to('login.php');
                        }
                    }
                }
            }
            unset($stmt);
        }

        unset($pdo);
    }
}

include 'includes/footer.php';
?>