<?php
session_start();
include_once('../config/config.php');

if (isset($_SESSION["login"])) {
    $login = $_SESSION["login"];

    $query = "SELECT * FROM usuario WHERE login = ?";
    $stmt = $conexao->prepare($query);

    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $userTable = $result->fetch_assoc();

    // Verifique se o usuário foi encontrado no banco de dados
    if ($userTable) {
        $_SESSION["id"] = $userTable['id'];
        $_SESSION["name"] = $userTable['nome'];
        $_SESSION["perfil"] = $userTable['perfil'];
        header('location: ../paginas/index.php');
        exit();
    } else {
        // O usuário não foi encontrado no banco de dados
        header('location: ../paginas/login.php');
        exit();
    }
} else {
    // $_SESSION["login"] não está definido, redirecione para a página de login
    header('location: ../paginas/login.php');
    exit();
}
?>
