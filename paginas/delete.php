<?php

if (!empty($_GET['id'])) {
    include_once('../config/config.php');

    $id = $_GET['id'];

    // Use uma instrução preparada para evitar ataques de injeção de SQL
    $sqlDelete = "DELETE FROM usuario WHERE id = ?";
    $stmtDelete = $conexao->prepare($sqlDelete);

    if ($stmtDelete) {
        // Associe o parâmetro à instrução preparada
        $stmtDelete->bind_param("i", $id);

        // Execute a instrução preparada
        $stmtDelete->execute();

        // Verifique se a exclusão foi bem-sucedida
        if ($stmtDelete->affected_rows > 0) {
            // Redirecione para a página de usuários após excluir o usuário
            header('Location: ../paginas/usuarios.php');
            exit();
        }

        // Feche a instrução preparada
        $stmtDelete->close();
    }
}

// Se algo der errado, redirecione para a página de usuários
header('Location: ../paginas/usuarios.php');
?>
