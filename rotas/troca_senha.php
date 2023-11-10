<?php
include_once('../config/config.php');

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

if (isset($_POST['cpf'])) {
    $cpf_digitado = $_POST['cpf'];

    // Verifique se o CPF existe no banco de dados
    $query = "SELECT cpf FROM usuario WHERE cpf = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $cpf_digitado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // CPF válido, você pode enviar uma resposta para indicar que o CPF existe
        echo json_encode("CPF existe no banco de dados");
    } else {
        // CPF não encontrado, retorne uma resposta apropriada
        echo json_encode("CPF não encontrado no banco de dados");
    }
} elseif (isset($_POST['cpf'], $_POST['nova_senha'])) {
    $cpf_digitado = $_POST['cpf'];
    $nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT); // Hash da nova senha

    // Verifique se o CPF existe no banco de dados
    $query = "SELECT cpf FROM usuario WHERE cpf = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $cpf_digitado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // CPF válido, atualize a senha no banco de dados
        $atualizar_query = "UPDATE usuario SET senha = ? WHERE cpf = ?";
        $stmt = $conexao->prepare($atualizar_query);
        $stmt->bind_param("ss", $nova_senha, $cpf_digitado);
        if ($stmt->execute()) {
            $response = "Senha atualizada com sucesso!";
        } else {
            $response = "Erro ao atualizar a senha.";
        }
    } else {
        $response = "CPF não encontrado no banco de dados.";
    }
   
    echo json_encode($response); // Retorna a resposta em formato JSON
}
?>
