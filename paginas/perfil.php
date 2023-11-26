<?php
session_start();
include_once('../config/config.php');

// Verifica se a conexão com o banco de dados foi estabelecida com sucesso
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$idUsuario = $_SESSION['id'];

$query = "SELECT * FROM usuario WHERE id = ?";
$stmt = $conexao->prepare($query);

// Verifica se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

// Associa o parâmetro à consulta preparada
$stmt->bind_param("i", $idUsuario);

// Executa a consulta preparada
$stmt->execute();

// Obtém o resultado da consulta preparada
$result = $stmt->get_result();

// Verifica se a execução da consulta foi bem-sucedida
if (!$result) {
    die("Erro na execução da consulta: " . $stmt->error);
}

// Verifica se há pelo menos uma linha de resultado
if ($result->num_rows > 0) {
    $perfil = $result->fetch_assoc();
    $hash_senha_banco = $perfil['senha'];
}

// Fecha a consulta preparada e a conexão com o banco de dados
$stmt->close();
$conexao->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Perfil do Usuário</title>
</head>

<body>
    <!-- header-->
    <?php require_once '../componentes/header.php'; ?>
    <div> <h1 id="perfil1" >Informações do Perfil</h1><br></div>
    <div id="perfil">
       

        <ul list-group>

            <li class="list-group-item" ><strong>Login:</strong>
                <?php echo $perfil['login']; ?>
            </li>


            <li class="list-group-item">><strong>Nome:</strong>
                <?php echo $perfil['nome']; ?>
            </li>


            <li class="list-group-item">><strong>Senha:</strong>
                <?php echo $perfil['senha']; ?>
            </li>


            <li class="list-group-item">><strong>CPF:</strong>
                <?php echo $perfil['cpf']; ?>
            </li>


            <li class="list-group-item">><strong>nome materno:</strong>
                <?php echo $perfil['nome_materno']; ?>
            </li>


            <li class="list-group-item">><strong>CEP:</strong>
                <?php echo $perfil['cep']; ?>
            </li>


            <li class="list-group-item">><strong>Data de Nascimento:</strong>
                <?php echo $perfil['data_nascimento']; ?>
            </li>


            <li class="list-group-item">><strong>Sexo:</strong>
                <?php echo $perfil['sexo']; ?>
            </li>


            <li class="list-group-item">><strong>Telefone Celular:</strong>
                <?php echo $perfil['telefone_cel']; ?>
            </li>


            <li class="list-group-item">><strong>Telefone Fixo:</strong>
                <?php echo $perfil['telefone_fixo']; ?>
            </li>
            <li class="list-group-item">><strong>cep:</strong>
                <?php echo $perfil['cep']; ?>
            </li>
            <li class="list-group-item">><strong>Complemento:</strong>
                <?php echo $perfil['complemento']; ?>
            </li>
        

            
        </ul>

        
    <?php
    ?>
    </div>
    <br><br>

    

    <!-- Footer -->
    <?php require_once '../componentes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>