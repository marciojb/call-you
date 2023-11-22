<?php
session_start();
include_once('../config/config.php');

$response = array("status" => "error", "message" => "Erro desconhecido ao obter perguntas de segurança do banco de dados.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (isset($_SESSION["login"])) {
        $login = $_SESSION["login"];

        // Verificando a conexão com o banco de dados
        if (!$conexao) {
            $response = array("status" => "error", "message" => "Erro na conexão com o banco de dados: " . mysqli_connect_error());
        } else {
            $query = "SELECT * FROM usuario WHERE login = ?";
            $stmt = $conexao->prepare($query);
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $userRow = $result->fetch_assoc();
                $userId = $userRow['id'];

                $stmtSecurity = $conexao->prepare("SELECT * FROM perguntas_seguranca WHERE id = ?");
                $stmtSecurity->bind_param("i", $userId);
                $stmtSecurity->execute();
                $resultSecurity = $stmtSecurity->get_result();

                if ($resultSecurity->num_rows > 0) {
                    $securityQuestions = $resultSecurity->fetch_all(MYSQLI_ASSOC);

                    if (!empty($securityQuestions)) {
                        $resposta1_db = $securityQuestions[0]['pergunta1nomeM'];
                        $resposta2_db = $securityQuestions[0]['pergunta2CEP'];
                        $resposta3_db = $securityQuestions[0]['pergunta3dataN'];

                        if (
                            isset($data['pergunta1nomeM']) &&
                            isset($data['pergunta2CEP']) &&
                            isset($data['pergunta3dataN']) &&
                            $data['pergunta1nomeM'] == $resposta1_db &&
                            $data['pergunta2CEP'] == $resposta2_db &&
                            $data['pergunta3dataN'] == $resposta3_db
                        ) {
                            $_SESSION['user_logged_in'] = true;
                            $response = array("status" => "success", "message" => "Login existe e respostas às perguntas de segurança estão corretas. Sessão iniciada.");
                        } else {
                            $response = array("status" => "error", "message" => "Respostas às perguntas de segurança estão incorretas.");
                        }
                    } else {
                        $response = array("status" => "error", "message" => "Login existe, mas não há perguntas de segurança associadas.");
                    }
                } else {
                    $response = array("status" => "error", "message" => "Erro ao obter perguntas de segurança do banco de dados: " . $stmtSecurity->error);
                }
            } else {
                $response = array("status" => "error", "message" => "Login não encontrado.");
            }

            $stmtSecurity->close();
            $stmt->close();
        }
    } else {
        $response = array("status" => "error", "message" => "Chave 'login' não está presente nos dados recebidos.");
    }
} else {
    $response = array("status" => "error", "message" => "Método de requisição não suportado.");
}

$conexao->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
