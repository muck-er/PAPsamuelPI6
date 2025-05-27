<?php
session_start();
session_destroy();
header("Location: /public/html/authentication/login.html");
exit();
?>
