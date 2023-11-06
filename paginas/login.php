<?php   require_once '../rotas/troca_senha.php'; ?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>login</title>
</head>
<body>
  <!-- header-->
  <?php require_once '../componentes/header.php'; ?>
  <div class="">
    <div id="container_login" id="meuElemento" >
      <div id="section1">
        <form id="login_form"  method="post" action='../rotas\loginbd.php' class="esconder" >
          <h2>LOGIN</h2><br>
          <label for="login">login</label><br>
          <input type="text" id="login" name="login"><br><br>
          <label for="senha">Senha</label><br>
          <input type="password" id="senha" name="senha"><br>
          <a id="test" href="">Esqueci minha senha</a><br><br><br>
          <button id="meuBotao" class="buttonEntrar gerarPergunta" type="submit" name="submit"  type="submit">Entrar</button><br>
          <a href="cadastro.php">Não possuo cadastro</a><br>
        </form>
      </div>
      <div id="troca-senha" class="escoder11">
        <div id="meuElemento" >
          <form method="post" action="" id="troca-senha ">
            <div class="escondersenha" ><br>
            <h2>troca senha</h2><br>
           <label for="">cpf </label><br>
           <input type="text" name="cpf" for="cpf" id="cpf"><br><br>
           <div id="campoSenha" style="display: none;">
           <label for="">Nova Senha:</label>
           <input type="password" name="nova_senha" id="nova_senha">
           <label for="">confirma senha</label>
           <input type="password" id="confirma_senha"><br><br>
           </div><br><br>
            <a href="login.php">Voltar área de login</a>
            <button id="buttonSenha" type="submit">comfimar</button>
            <a href="cadastro.php">Não possui cadastro?</a>
            </div>
            <div id="fa" class="esconder2fa">
            <h2>2fa</h2><br><br>
            <p id="pergunta"></p>
            <label for="">qual e a resposta ? </label>
            <input type="text">
            <button id="buttonSenha"type="submit" value="Trocar Senha"> >comfimar</button>
            </div>
          </form>
        </div>
      </div>
      <div id="section2" class="mover">
        <img src="../img/undraw_around_the_world_re_rb1p.svg" alt="">
      </div>
    </div>
  </div>
   <!-- footer-->
   <?php require_once '../componentes/footer.php'; ?>
 
</body>
<script>


document.getElementById("meuBotao").addEventListener("click", function (event) {
    event.preventDefault();

    // Realize uma solicitação AJAX para o seu script PHP de login
    const login = document.querySelector("#login").value;
    const senha = document.querySelector("#senha").value;
    if (login.trim() === '' || senha.trim() === '') {
    console.log('Campos em branco. Preencha os campos de login e senha.');
    return;
}
    fetch('../rotas/loginbd.php', {
        method: 'POST',
        body: JSON.stringify({ login, senha }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na solicitação');
        }
        return response.json(); // Trate a resposta como JSON
    })
    .then(data => {
      console.log('Resposta do servidor:', data);
        if (data.success === true) {
            // O login foi bem-sucedido, execute as ações
            const imagem = document.querySelector(".mover");
            const input = document.querySelector(".esconder");
            const inputsenha = document.querySelector(".escondersenha");
            var elemento = document.getElementById("meuElemento");
            elemento.style.visibility = "visible";
            elemento.style.pointerEvents = "auto";

            // Remove a propriedade 'animation: none;' para ativar as animações
            imagem.style.animation = "moverImagem 1s linear forwards";
            input.style.animation = "esconderInput 1s linear forwards";
            inputsenha.style.animation = "esconderInput 1s linear forwards";
        } else {
            // O login não foi bem-sucedido, você pode tratar isso de acordo com sua necessidade
            console.log("Login falhou: " + data.message);
        }
    })
    .catch(error => {
        console.error('Erro na solicitação AJAX:', error);
    });
});
/////////////////////troca senha ////////////////////////////////////////
$(document).ready(function() {
    var cpf_valido = <?php echo $cpf_valido ? 'true' : 'false'; ?>;
    var cpfInput = $("#cpf");
    var campoSenha = $("#campoSenha");

    cpfInput.on("input", function() {
        var cpf = cpfInput.val().trim();
        if (cpf_valido && cpf) {
            campoSenha.show();
        } else {
            campoSenha.hide();
        }
    });

    // Verifique o CPF quando a página carregar
    if (cpf_valido && cpfInput.val().trim()) {
        campoSenha.show();
    }
});
</script>
<script src="../script/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>