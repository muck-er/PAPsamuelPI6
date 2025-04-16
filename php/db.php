<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "othrysfit";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
