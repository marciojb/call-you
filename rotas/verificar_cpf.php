<?php
include_once('../config/config.php');

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['cpf'])) {
        $cpfDigitado = $data['cpf'];

        // Verifique se o CPF existe no banco de dados
        $query = "SELECT cpf FROM usuario WHERE cpf = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $cpfDigitado);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // CPF válido, envie uma resposta indicando que o CPF existe
            echo json_encode(["message" => "CPF existe no banco de dados", "status" => "success", "cpfExiste" => true]);
        } else {
            // CPF não encontrado, retorne uma resposta indicando que o CPF não existe
            echo json_encode(["message" => "CPF não encontrado no banco de dados", "status" => "error", "cpfExiste" => false]);
        }
    } else {
        // Se o CPF não foi fornecido, retorne uma resposta indicando um erro
        echo json_encode(["message" => "CPF não fornecido", "status" => "error", "cpfExiste" => false]);
    }
} else {
    // Se o método de requisição não for POST, retorne uma resposta indicando um erro
    http_response_code(400);
    echo json_encode(['error' => 'Método de requisição inválido']);
}
?>
