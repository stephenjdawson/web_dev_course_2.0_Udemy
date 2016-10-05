<?php

session_start();
session_destroy();
setcookie("id", "", time() - 60*60);
$_COOKIE["id"] = "";
header('Location: secret_diary_login.php');
exit;

?>