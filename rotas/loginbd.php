<?php
include_once('../config/config.php');
session_start();
// Verifique se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicialize o array de resposta
    $response = array();

    // Obtém o corpo da solicitação POST como um objeto JSON
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Verifica se o JSON foi decodificado com sucesso
    if ($data !== null) {
        // Obtém as credenciais do usuário a partir do objeto JSON
        $login = $data['login'];
        $senha = $data['senha'];

        // Consulta SQL preparada
        $query = "SELECT * FROM usuario WHERE login = ?";

        // Prepara a consulta
        $stmt = $conexao->prepare($query);

        if ($stmt) {
            // Vincula o parâmetro
            $stmt->bind_param("s", $login);

            // Executa a consulta
            $stmt->execute();

            // Obtém o resultado da consulta
            $result = $stmt->get_result();

            // Verifica se a consulta retornou alguma linha (ou seja, se o usuário existe)
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hash_senha_banco = $row['senha'];

                // Verifique a senha usando password_verify
                if (password_verify($senha, $hash_senha_banco)) {
                    $response['success'] = true;
                    $response['message'] = 'Login bem-sucedido';
                    $_SESSION["login"]= $login;
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Senha incorreta';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Usuário não encontrado';
            }

            // Fecha a consulta
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = 'Erro na consulta preparada';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'JSON inválido na solicitação';
    }
} else {
    // Caso a solicitação não seja POST
    $response['success'] = false;
    $response['message'] = 'Método de solicitaçãoz inválido';
}

// Define o cabeçalho Content-Type como JSON
header('Content-Type: application/json');

// Retorna a resposta em JSON
echo json_encode($response);
?> 