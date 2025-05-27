<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"] ?? 'user';

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Campos em falta."]);
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;

        if ($role !== 'admin') {
            $stmt_obj = $conn->prepare("
                INSERT INTO objetivos_user (id, user_id, concluido)
                SELECT id, ?, 0 FROM objetivos_padrao
            ");
            $stmt_obj->bind_param("i", $user_id);
            $stmt_obj->execute();
            $stmt_obj->close();
        }

        echo json_encode(["status" => "success", "message" => "Conta criada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>