<?php
session_start();
session_destroy();
unset($_COOKIE['usuario']);
setcookie('usuario','');
header('location:index.php')
?>