<?php
session_start();
session_destroy();
setcookie('email');
setcookie('password');
setcookie('tipo_conta');
header("Location: login");
?>