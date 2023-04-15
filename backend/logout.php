<?php
require_once __DIR__.'/config.php';

$_SESSION['loggedin'] = false;
$_SESSION['user_id'] = 0;

session_destroy();

header('Location: /');
die();