<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Perfil do Usuário</title>
</head>
<?php require_once '../componentes/header.php'; ?>
<?php if (isset($_SESSION["id"])) { ?>
    <br><br><br>
    <div>
        <div id="meuElemento">
            <form method="post" id="troca-senha1" action="../rotas/troca_senha1.php">
                <br>
                <h2>Troca de Senha</h2>
                <div id="campoSenha">
                    <div>
                        <label for="nova_senha">Nova Senha:</label>
                        <br>
                        <input type="password" name="nova_senha" id="nova_senha" placeholder="Digite a senha">
                    </div>
                    <div>
                    <label for="confirma_senha">Confirma Senha:</label>
                    <br>
                    <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme a senha">
                    </div>
                </div>
                <div>
                    <a href="../paginas/index.php"> voltar para home</a>
                </div>
                <button class="buttonSenha1" id="troca-senha-final" type="submit">Confirmar</button>
        </div>
    </div>
    </div>
    <br><br><br><br><br><br><br>
<?php } else {
    header("location: ../paginas/index.php");
} ?>
<?php require_once '../componentes/footer.php'; ?>
<script src="../script/troca-senha1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>