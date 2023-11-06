<?php
include_once('../config/config.php');

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$cpf_valido = false;

if (isset($_POST['cpf']) && isset($_POST['nova_senha'])) {
    $cpf_digitado = $_POST['cpf'];
    $nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT); // Hash da nova senha

    // Verifique se o CPF existe no banco de dados
    $query = "SELECT cpf FROM usuario  WHERE cpf = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $cpf_digitado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $cpf_valido = true;
        // Atualize a senha no banco de dados
        $atualizar_query = "UPDATE usuario SET senha = ? WHERE cpf = ?";
        $stmt = $conexao->prepare($atualizar_query);
        $stmt->bind_param("ss", $nova_senha, $cpf_digitado);
        if ($stmt->execute()) {
            echo "<h1>Senha atualizada com sucesso!</h1>";
        } else {
            echo "<h1>Erro ao atualizar a senha.</h1>";
        }
    } else {
        echo "<h1>CPF não encontrado no banco de dados.</h1>";
    }
}
?>





