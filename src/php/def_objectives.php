<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: /public/html/login.html");
    exit();
}

// Aqui você pode obter o ID do usuário da sessão
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definir Objetivos</title>
    <link rel="stylesheet" href="/public/css/style-starter.css"> <!-- seu arquivo de estilo -->
</head>
<body>

    <div class="objectives-container">
        <h2>Defina seus Objetivos de Treino</h2>

        <form id="objectives-form">
            <label for="objective">Escolha seu objetivo:</label>
            <select name="objective" id="objective" required>
                <option value="perder_peso">Perder Peso</option>
                <option value="ganhar_musculo">Ganhar Músculo</option>
                <option value="melhorar_condicao">Melhorar Condição Física</option>
                <option value="saude_geral">Saúde Geral</option>
            </select>

            <div id="goal-details"></div> <!-- Detalhes do objetivo, como perguntas ou formulários específicos -->

            <button type="submit">Salvar Objetivo</button>
        </form>
    </div>

    <script>
        // Script para mostrar campos adicionais baseados no objetivo selecionado
        document.getElementById("objective").addEventListener("change", function() {
            var selectedGoal = this.value;
            var goalDetails = document.getElementById("goal-details");

            // Limpar os campos de objetivo anteriores
            goalDetails.innerHTML = "";

            if (selectedGoal == "perder_peso") {
                goalDetails.innerHTML = '<label for="peso_meta">Qual o seu peso meta?</label><input type="number" name="peso_meta" placeholder="Peso meta (kg)" required min="30" max="300">';
            } else if (selectedGoal == "ganhar_musculo") {
                goalDetails.innerHTML = '<label for="musculo_meta">Quantos quilos de músculo você gostaria de ganhar?</label><input type="number" name="musculo_meta" placeholder="Músculo meta (kg)" required min="0" max="50">';
            } else if (selectedGoal == "melhorar_condicao") {
                goalDetails.innerHTML = '<label for="condicao_meta">Em quanto tempo você gostaria de melhorar sua condição física?</label><input type="text" name="condicao_meta" placeholder="Ex: 3 meses">';
            } else if (selectedGoal == "saude_geral") {
                goalDetails.innerHTML = '<label for="saude_meta">Quais melhorias você espera para sua saúde?</label><input type="text" name="saude_meta" placeholder="Ex: Aumentar energia, melhorar sono">';
            }
        });

        // Envio do formulário
        document.getElementById("objectives-form").addEventListener("submit", function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.append("user_id", <?php echo $user_id; ?>); // Adicionar o ID do usuário

            fetch("/src/php/pocs_objectives.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status == "success") {
                    alert("Objetivo salvo com sucesso!");
                    window.location.href = "dashboard.php"; // Redireciona para o painel após salvar o objetivo
                } else {
                    alert("Erro ao salvar objetivo.");
                }
            })
            .catch(error => console.error("Erro:", error));
        });
    </script>

</body>
</html>
