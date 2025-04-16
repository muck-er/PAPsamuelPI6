<?php
session_start();
include '/src/php/db.php'; // Inclua a conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: /public/html/login.html"); // Redireciona para login se não estiver logado
    exit();
}

// Buscar os dados do usuário no banco de dados
$user_id = $_SESSION['user_id'];
$query = "SELECT nome, idade, peso, altura, objetivo, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Obter os dados do usuário
} else {
    echo "Erro ao buscar dados do usuário.";
    exit();
}

$stmt->close();
$conn->close();
?>
