<?php
// Iniciar ou retomar a sessão
session_start();
include_once('../config/config.php');
// Conexão com o banco de dados (substitua as credenciais conforme necessário)


// Verifique se o login existe
$login = "login"; // Substitua pelo nome de usuário que você deseja verificar
$query = "SELECT * FROM usuario WHERE login = '$login'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // O login existe
    $userRow = $result->fetch_assoc();
    $userId = $userRow['id'];

    // Verifique se há perguntas de segurança associadas a esse login
    $query = "SELECT * FROM perguntas_seguranca WHERE usuario_id = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Existem perguntas de segurança associadas a esse login
        $securityRow = $result->fetch_assoc();
        
        // Verifique as respostas às perguntas de segurança
        $resposta1 = $securityRow['pergunta1nomeM'];
        $resposta2 = $securityRow['pergunta2CEP'];
        $resposta3 = $securityRow['pergunta3dataN'];

        if ($resposta1 == 'resposta1' && $resposta2 == 'resposta2' && $resposta3 == 'resposta3') {
            // Respostas corretas
            // Defina uma variável de sessão para marcar o login bem-sucedido
            $_SESSION['user_logged_in'] = true;
            echo "Login existe e as respostas às perguntas de segurança estão corretas. Sessão iniciada.";
        } else {
            // Respostas incorretas
            echo "Login existe, mas as respostas às perguntas de segurança estão incorretas.";
        }
    } else {
        // Não há perguntas de segurança associadas a esse login
        echo "Login existe, mas não há perguntas de segurança associadas.";
    }
} else {
    // O login não existe
    echo "Login não encontrado.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
