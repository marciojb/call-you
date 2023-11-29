<?php
include_once('../config/config.php');

// Verifique se é uma solicitação POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do corpo da requisição
    
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Verifique se os parâmetros necessários estão presentes
    if (isset($data['cpf'], $data['nova_senha'])) {
        $cpf_digitado = $data['cpf'];
        $nova_senha = password_hash($data['nova_senha'], PASSWORD_DEFAULT); // Hash da nova senha

        // Verifique se o CPF existe no banco de dados
        $query = "SELECT cpf FROM usuario WHERE cpf = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $cpf_digitado);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // CPF válido, atualize a senha no banco de dados
            $atualizar_query = "UPDATE usuario SET senha = ? WHERE cpf = ?";
            $stmt2 = $conexao->prepare($atualizar_query);
            $stmt2->bind_param("ss", $nova_senha, $cpf_digitado);

            if ($stmt2->execute()) {
                echo json_encode(["message" => "Senha atualizada com sucesso!", "status" => "success"]);
            } else {
                echo json_encode(["message" => "Erro ao atualizar a senha: " . $stmt2->error, "status" => "error"]);
            }
        } else {
            echo json_encode(["message" => "CPF não encontrado. Verifique o CPF e tente novamente.", "status" => "error"]);
        }

        // Feche a conexão após a execução
        $stmt->close();
        $stmt2->close();
    } }
?>
