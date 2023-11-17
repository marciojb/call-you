<?php
include_once('../config/config.php');

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
      if(isset($data['cpf'], $data['nova_senha'])) {
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
                exit(); // Adicione esta linha para interromper a execução após enviar a resposta JSON
            } else {
                echo json_encode(["message" => "Erro ao atualizar a senha: " . $stmt2->error, "status" => "error"]);
            }
        } else {
            echo json_encode(["message" => "CPF não encontrado no banco de dados. Não é possível atualizar a senha.", "status" => "error"]);
        }
    } else {
        echo json_encode(["message" => "Requisição inválida. Parâmetros ausentes.", "status" => "error"]);
    }
}
?>
