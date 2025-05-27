<?php
session_start();
include "db.php";

function limpar_input($data)
{
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = limpar_input($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        header("Location: /public/html/authentication/login.html?erro=vazio");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["nome"] = $user["nome"];
            $_SESSION["user_role"] = $user["role"];
            if ($user["role"] === "admin") {
                $deleteStmt = $conn->prepare("DELETE FROM objetivos_user WHERE user_id = ?");
                $deleteStmt->bind_param("i", $user["id"]);
                $deleteStmt->execute();
                $deleteStmt->close();

                header("Location: /public/html/admin/admin.html");
            } else {
                header("Location: /public/html/dashboard/dashboard.html");
            }
            exit();
        } else {
            header("Location: /public/html/authentication/login.html?erro=senha");
            exit();
        }
    } else {
        header("Location: /public/html/authentication/login.html?erro=email");
        exit();
    }
}

$conn->close();
