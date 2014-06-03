<?php


include_once 'Security.php';

Security::instance()->logout();

header('Location: index.php');

?>

