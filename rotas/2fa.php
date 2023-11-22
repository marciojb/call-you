<?php
session_start();
include_once('../config/config.php');
if (isset($_SESSION["login"])) {
    $login = $_SESSION["login"];
    session_destroy();

    $query = "SELECT * FROM usuario WHERE login = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $userTable = $result->fetch_assoc();

    $mother = $_POST['pergunta1nomeM'];
    $cep = $_POST['pergunta2CEP'];
    $date = $_POST['pergunta3dataN'];


    if($mother === $userTable['nome_materno']){
        session_start();
        $_SESSION["id"]=$userTable['id'] ;
        $_SESSION["name"]=$userTable['nome'];
        header('location: ../paginas/index.php');
        die();
    }

    if($cep === $userTable['cep']){
        session_start();
        $_SESSION["id"]=$userTable['id'] ;
        $_SESSION["name"]=$userTable['nome'];
        header('location: ../paginas/index.php');
        die();
    }
    if($date === $userTable['data_nascimento']){
        session_start();
        $_SESSION["id"]=$userTable['id'] ;
        $_SESSION["name"]=$userTable['nome'];
        header('location: ../paginas/index.php');
        die();
    }

    session_destroy();
    header('location: ../paginas/login.php');

}
?>
