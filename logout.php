<?php

session_start();

// unset na sesiski promenlivi

$_SESSION = array();

// unistime sesijata

session_destroy();

// redirektiranje na login

header('location:login.php');
exit;

?>