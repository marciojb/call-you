<?php
session_start();
include_once('../config/config.php');

// Verifique se é uma solicitação POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do corpo da requisição
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Verifique se os parâmetros necessários estão presentes
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if ($id !== null && isset($data['nova_senha'])) {
        $id_digitado = $id;
        
        //*<<
        $nova_senha = password_hash($data['nova_senha'], PASSWORD_DEFAULT); // Hash da nova senha

        // Verifique se o ID existe no banco de dados usando prepared statement
        $query = "SELECT id FROM usuario WHERE id = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $id_digitado);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // ID válido, atualize a senha no banco de dados usando prepared statement
            $atualizar_query = "UPDATE usuario SET senha = ? WHERE id = ?";
            $stmt2 = $conexao->prepare($atualizar_query);
            $stmt2->bind_param("ss", $nova_senha, $id_digitado);

            if ($stmt2->execute()) {
                echo json_encode(["message" => "Senha atualizada com sucesso!", "status" => "success"]);
            } else {
                echo json_encode(["message" => "Erro ao atualizar a senha: " . $stmt2->error, "status" => "error"]);
            }
        } else {
            echo json_encode(["message" => "ID não encontrado no banco de dados. Não é possível atualizar a senha.", "status" => "error"]);
        }

        // Feche a conexão após a execução
        $stmt->close();
        $stmt2->close();
    } else {
        echo json_encode(["message" => "Parâmetros insuficientes.", "status" => "error"]);
    }
   

}else{
    echo json_encode(['error' => 'Método de requisição inválido']);
    header('location: ../paginas/index.php');
}
?>
