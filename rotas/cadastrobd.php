<?php
if(isset($_POST['submit'])) {
    include_once('../config/config.php');

    // Supondo que você tenha uma conexão válida com o banco de dados

    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $senha = $_POST['senha']; // Não precisa escapar a senha
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $nome_materno = mysqli_real_escape_string($conexao, $_POST['nome_materno']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $telefone_fixo = mysqli_real_escape_string($conexao, $_POST['telefone_fixo']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    
    // Gerar o hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Construa a consulta SQL corretamente usando prepared statements para inserir na tabela "usuario"
    $query_usuario = "INSERT INTO usuario (login, senha, nome, cpf, sexo, telefone_cel, telefone_fixo) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare a consulta para a tabela "usuario"
    $stmt_usuario = mysqli_prepare($conexao, $query_usuario);

    if ($stmt_usuario) {
        // Associe os parâmetros e execute a consulta para a tabela "usuario"
        mysqli_stmt_bind_param($stmt_usuario, "sssssss", $login, $senha_hash, $nome, $cpf, $sexo, $telefone_celular, $telefone_fixo);
        
        if (mysqli_stmt_execute($stmt_usuario)) {
            // Inserção na tabela "usuario" bem-sucedida
            echo "Inserção bem-sucedida na tabela usuario!";

            // Agora, insira os dados na tabela "perguntas_seguranca"
            $query_perguntas_seguranca = "INSERT INTO perguntas_seguranca (pergunta1nomeM, pergunta2CEP, pergunta3dataN) 
              VALUES (?, ?, ?)";
            
            // Prepare a consulta para a tabela "perguntas_seguranca"
            $stmt_perguntas_seguranca = mysqli_prepare($conexao, $query_perguntas_seguranca);

            if ($stmt_perguntas_seguranca) {
                // Associe os parâmetros e execute a consulta para a tabela "perguntas_seguranca"
                mysqli_stmt_bind_param($stmt_perguntas_seguranca, "sss", $nome_materno, $cep, $data_nascimento);
                
                if (mysqli_stmt_execute($stmt_perguntas_seguranca)) {
                    // Inserção na tabela "perguntas_seguranca" bem-sucedida
                    echo "Inserção bem-sucedida na tabela perguntas_seguranca!";
                } else {
                    echo "Erro ao inserir dados na tabela perguntas_seguranca: " . mysqli_error($conexao);
                }
                
                // Feche o statement da tabela "perguntas_seguranca"
                mysqli_stmt_close($stmt_perguntas_seguranca);
            } else {
                echo "Erro na preparação da consulta para a tabela perguntas_seguranca: " . mysqli_error($conexao);
            }
        } else {
            echo "Erro ao inserir dados na tabela usuario: " . mysqli_error($conexao);
        }
        
        // Feche o statement da tabela "usuario"
        mysqli_stmt_close($stmt_usuario);
    } else {
        echo "Erro na preparação da consulta para a tabela usuario: " . mysqli_error($conexao);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
