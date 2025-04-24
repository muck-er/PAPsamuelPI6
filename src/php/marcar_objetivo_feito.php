<?php
session_start();
include 'db.php';

if (!isset($_SESSION['utilizador_id']) || !isset($_POST['id'])) {
    http_response_code(403);
    exit("Acesso negado.");
}

$user_id = $_SESSION['utilizador_id'];
$objetivo_id = intval($_POST['id']);

$sql = $conn->prepare("UPDATE objetivos SET concluido = TRUE WHERE id = ? AND user_id = ?");
$sql->bind_param("ii", $objetivo_id, $user_id);
$sql->execute();

echo "ok";
?>
