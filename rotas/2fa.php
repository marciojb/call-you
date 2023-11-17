<?php
// Iniciar ou retomar a sessão
session_start();
include_once('../config/config.php');

// Verificar se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados da requisição (por exemplo, login e respostas às perguntas de segurança)
    $login = $_POST['login'];
    $resposta1 = $_POST['pergunta1nomeM'];
    $resposta2 = $_POST['pergunta2CEP'];
    $resposta3 = $_POST['pergunta3dataN'];

    // Consultar o banco de dados para verificar o login e respostas às perguntas de segurança
    $query = "SELECT * FROM usuario WHERE login = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // O login existe
        $userRow = $result->fetch_assoc();
        $userId = $userRow['id'];

        // Verificar se há perguntas de segurança associadas a esse login
        $query = "SELECT * FROM perguntas_seguranca WHERE usuario_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Existem perguntas de segurança associadas a esse login
            $securityRow = $result->fetch_assoc();

            // Verificar as respostas às perguntas de segurança
            $resposta1_db = $securityRow['pergunta1nomeM'];
            $resposta2_db = $securityRow['pergunta2CEP'];
            $resposta3_db = $securityRow['pergunta3dataN'];

            if ($resposta1 == $resposta1_db && $resposta2 == $resposta2_db && $resposta3 == $resposta3_db) {
                // Respostas corretas
                // Definir uma variável de sessão para marcar o login bem-sucedido
                $_SESSION['user_logged_in'] = true;
                $response = array("status" => "success", "message" => "Login existe e respostas às perguntas de segurança corretas. Sessão iniciada.");
            } else {
                // Respostas incorretas
                $response = array("status" => "error", "message" => "Login existe, mas respostas às perguntas de segurança estão incorretas.");
            }
        } else {
            // Não há perguntas de segurança associadas a esse login
            $response = array("status" => "error", "message" => "Login existe, mas não há perguntas de segurança associadas.");
        }
    } else {
        // O login não existe
        $response = array("status" => "error", "message" => "Login não encontrado.");
    }
} else {
    // Se a requisição não for do tipo POST
    $response = array("status" => "error", "message" => "Método de requisição não suportado.");
}

// Fechar a conexão com o banco de dados
$stmt->close();
$conn->close();

// Enviar resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
