<?php
session_start();
session_destroy();
header("Location: /public/html/login.html");
exit();
?>
