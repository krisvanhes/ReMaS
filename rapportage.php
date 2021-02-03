<?php include 'includes/header.php';
$role = $_SESSION['role'];

if ($role !== 6 && isset($_SESSION['loggedin'])) { ?>

<?php include 'includes/footer.php';}
else{
 redirect_to('index.php');
} ?>