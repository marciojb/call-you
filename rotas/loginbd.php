<?php
header('Content-Type: application/json');
include_once('../config/config.php');
if (isset($_POST['login']) && isset($_POST['senha'])) {
    // Inclua o arquivo de configuração
   

    // Obtém as credenciais do usuário e evita injeção de SQL
    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Consulta SQL preparada
    $query = "SELECT * FROM usuario WHERE login = ? AND senha = ?";
    
    // Prepara a consulta
    $stmt = $conexao->prepare($query);

    if ($stmt) {
        // Vincula os parâmetros
        $stmt->bind_param("ss", $login, $senha);

        // Executa a consulta
        $stmt->execute();

        // Obtém o resultado da consulta
        $result = $stmt->get_result();

        // Verifica se a consulta retornou alguma linha (ou seja, se as credenciais são válidas)
        if ($result->num_rows > 0) {
            $response = array('success' => true, 'message' => 'Login bem-sucedido');
        } else {
            $response = array('success' => false, 'message' => 'Credenciais inválidas');
        }

        // Fecha a consulta
        $stmt->close();
    } else {
        $response = array('success' => false, 'message' => 'Erro na consulta preparada');
    }
    
    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    // Caso as credenciais não tenham sido fornecidas na solicitação
    $response = array('success' => false, 'message' => 'Credenciais não fornecidas');
}

// Retorna a resposta em JSON
echo json_encode($response);


?>


