<?php
if(isset($_POST['submit'])) {
    include_once('../config/config.php');

    // Supondo que você tenha uma conexão válida com o banco de dados

    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $senha = ($_POST['senha']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $nome_materno = mysqli_real_escape_string($conexao, $_POST['nome_materno']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $telefone_fixo = mysqli_real_escape_string($conexao, $_POST['telefone_fixo']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $perfil = 'comum';

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    // Construa a consulta SQL corretamente usando prepared statements
    $query = "INSERT INTO usuario (login, senha, nome, data_nascimento, cpf, nome_materno, sexo, telefone_cel, telefone_fixo, cep, complemento,perfil) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    
    // Prepare a consulta
    $stmt = mysqli_prepare($conexao, $query);

    if ($stmt) {
        // Associe os parâmetros e execute a consulta
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $login, $senha_hash, $nome, $data_nascimento, $cpf, $nome_materno, $sexo, $telefone_celular, $telefone_fixo, $cep, $complemento, $perfil);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Inserção bem-sucedida!";
            header('location: ../paginas/login.php');
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($conexao);
        }
        
        // Feche o statement
        mysqli_stmt_close($stmt);
    }  else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    } 

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}
?>