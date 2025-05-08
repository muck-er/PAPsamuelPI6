<?php
session_start();
include "db.php";

function limpar_input($data) {
    return htmlspecialchars(trim($data));
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = limpar_input($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        header("Location: /public/html/login.html?erro=vazio");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["nome"] = $user["nome"];
            header("Location: /public/html/dashboard.html");
            exit();
        } else {
            header("Location: /public/html/login.html?erro=senha");
            exit();
        }
    } else {
        header("Location: /public/html/login.html?erro=email");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
