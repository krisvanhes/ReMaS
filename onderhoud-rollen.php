<?php include 'includes/header.php';
$role = $_SESSION['role'];

// if user is not the role: Administrator
if ($role == 5 || $role == 6) { ?>
Rollen
    <?php include 'includes/footer.php';
} else {
    redirect_to('index.php');
} ?>