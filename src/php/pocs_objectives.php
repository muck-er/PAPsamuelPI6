<?php
session_start();
include "php/db.php";

// Verificar se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Usuário não autenticado."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];  // Usuário logado
    $objective = $_POST["objective"];
    $goal_detail = "";

    // Verificar qual objetivo foi escolhido e definir a meta
    if ($objective == "perder_peso") {
        $goal_detail = $_POST["peso_meta"];
    } elseif ($objective == "ganhar_musculo") {
        $goal_detail = $_POST["musculo_meta"];
    } elseif ($objective == "melhorar_condicao") {
        $goal_detail = $_POST["condicao_meta"];
    } elseif ($objective == "saude_geral") {
        $goal_detail = $_POST["saude_meta"];
    }

    // Agora vamos associar o objetivo com o usuário
    // Primeiro, verificar se o objetivo já existe na tabela user_goals
    $stmt = $conn->prepare("SELECT id FROM user_goals WHERE name = ?");
    $stmt->bind_param("s", $objective);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Objetivo já existe, vamos obter o ID do objetivo
        $goal = $result->fetch_assoc();
        $goal_id = $goal["id"];

        // Atualizar o objetivo do usuário na tabela users
        $update_stmt = $conn->prepare("UPDATE users SET goal_id = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $goal_id, $user_id);

        if ($update_stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Objetivo atualizado com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Falha ao atualizar objetivo do usuário."]);
        }

        $update_stmt->close();
    } else {
        // Caso o objetivo não exista, vamos inseri-lo
        $insert_stmt = $conn->prepare("INSERT INTO user_goals (name, description) VALUES (?, ?)");
        $description = "Descrição do objetivo: " . ucfirst(str_replace('_', ' ', $objective)); // Descrição básica
        $insert_stmt->bind_param("ss", $objective, $description);

        if ($insert_stmt->execute()) {
            $goal_id = $insert_stmt->insert_id;  // Pegar o ID do novo objetivo inserido

            // Agora atualizar o objetivo do usuário
            $update_stmt = $conn->prepare("UPDATE users SET goal_id = ? WHERE id = ?");
            $update_stmt->bind_param("ii", $goal_id, $user_id);

            if ($update_stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Objetivo atualizado com sucesso!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Falha ao atualizar objetivo do usuário."]);
            }

            $update_stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Falha ao salvar o novo objetivo"]);
        }

        $insert_stmt->close();
    }

    $stmt->close();
}

$conn->close();
?>
