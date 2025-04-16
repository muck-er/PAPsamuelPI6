<?php
session_start();
include "db.php";

// Função para limpar dados de entrada (prevenir XSS)
function limpar_input($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpeza de dados de entrada
    $email = limpar_input($_POST["email"]);
    $password = $_POST["password"]; // Senha não precisa ser limpa, pois é apenas comparada
    
    // Verificar se os campos não estão vazios
    if (empty($email) || empty($password)) {
        echo "<script>alert('Por favor, preencha todos os campos.');window.location.href='login.html';</script>";
        exit();
    }

    // Preparar e executar consulta SQL
    $stmt = $conn->prepare("SELECT id, nome, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Regenerar ID de sessão para segurança
            session_regenerate_id(true);

            // Armazenar informações do usuário na sessão
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["nome"] = $user["nome"];

            // Redirecionar para a página de escolha de objetivos (onde o usuário define os objetivos de treino)
            header("Location: php/def_objectives.php");
            exit();
        } else {
            echo "<script>alert('Senha incorreta!');window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado!');window.location.href='login.html';</script>";
    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
