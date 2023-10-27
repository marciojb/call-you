<?php   
if (isset($_POST['login']) && isset($_POST['senha'])) {
    var_dump($_POST);
    include_once('../config/config.php');
    
    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    
    $query = "SELECT * FROM usuario WHERE login = ? AND senha = ?";
    
    // Preparar a declaração
    if ($stmt = mysqli_prepare($conexao, $query)) {
        // Vincular os parâmetros
        mysqli_stmt_bind_param($stmt, "ss", $login, $senha);
        
        // Executar a consulta
        mysqli_stmt_execute($stmt);
        
        // Obter os resultados
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Credenciais corretas, o usuário está autenticado.
            echo "Login bem-sucedido";
        } else {
            // Credenciais incorretas, o usuário não está autenticado.
            echo "Credenciais inválidas";
        }
        
        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        // Tratamento de erro
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }
    
    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Dados de login não foram enviados corretamente.";
}
