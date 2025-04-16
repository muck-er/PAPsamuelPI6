<?php
include "/src/php/db.php";

if (isset($_POST["email"])) {
    $email = trim($_POST["email"]);

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Este e-mail já está em uso."]);
    } else {
        echo json_encode(["status" => "success"]);
    }

    $stmt->close();
}

$conn->close();
?>
