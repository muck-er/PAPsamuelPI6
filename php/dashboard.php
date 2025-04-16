<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

include "db.php";

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT descricao FROM planos_treino WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$planos = $result->fetch_all(MYSQLI_ASSOC);

header("Location: dashboard.html");
exit();
?>