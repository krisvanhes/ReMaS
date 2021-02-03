<?php

include 'includes/functions.php';

session_start();

$_SESSION = array();

session_destroy();

redirect_to('login.php');
exit;