<?php include 'includes/header.php';
$role = $_SESSION['role'];

// if user is the role: Applicatiebeheerder / Administrator
if ($role == 5 || $role == 6) { ?>
    Medewerkers
    <?php include 'includes/footer.php';
} else {
    redirect_to('index.php');
} ?>