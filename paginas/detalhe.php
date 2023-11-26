<?php
include_once('../config/config.php');

// Verifica se a conexão com o banco de dados foi estabelecida com sucesso
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

// Inicializa a variável $perfil
$perfil = [];

if (!empty($_GET["id"])) { // Use $_GET para obter parâmetros da URL
    $idUsuario = $_GET["id"]; // Recupera o ID da URL

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

    // Fecha a consulta preparada
    $stmt->close();
}

// Fecha a conexão com o banco de dados
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

    <title>Document</title>
</head>

<body>
<!-- header-->
<?php require_once '../componentes/header.php'; ?>
    <h1 class="detalhe_h1">detalhe do perfil:<?php echo $perfil['login']; ?></h1>
    <div id="perfil">
        <ul>
            <div class="li_perfil">
                <li><strong>Login:</strong>
                    <?php echo $perfil['login']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Nome:</strong>
                    <?php echo $perfil['nome']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Senha:</strong>
                    <?php echo $perfil['senha']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>CPF:</strong>
                    <?php echo $perfil['cpf']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>nome materno:</strong>
                    <?php echo $perfil['nome_materno']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>CEP:</strong>
                    <?php echo $perfil['cep']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Data de Nascimento:</strong>
                    <?php echo $perfil['data_nascimento']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Sexo:</strong>
                    <?php echo $perfil['sexo']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Telefone Celular:</strong>
                    <?php echo $perfil['telefone_cel']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Telefone Fixo:</strong>
                    <?php echo $perfil['telefone_fixo']; ?>
                </li>
            </div>
            <div class="li_perfil">
                <li><strong>Complemento:</strong>
                    <?php echo $perfil['complemento']; ?>
                </li>
            </ul>
        </div>
        <br><br>
<!-- footer-->
 <?php require_once '../componentes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>
</body>

</html>