<?php require_once '../rotas/troca_senha.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>login</title>
</head>

<body>
  <!-- header-->
  <?php require_once '../componentes/header.php'; ?>
  <!-- login -->
  <div class="">
    <div id="container_login" id="meuElemento">
      <div id="section1">
        <form id="login_form" method="post" action='' class="esconder">
          <h2>LOGIN</h2><br>
          <label for="login">login</label><br>
          <input type="text" id="login" name="login"><br><br>
          <label for="senha">Senha</label><br>
          <input type="password" id="senha" name="senha"><br>
          <a id="test" href="">Esqueci minha senha</a><br><br><br>
          <button id="meuBotao" class="buttonEntrar" name="mostrarPerguntas" type="submit">Entrar</button><br>
          <a href="cadastro.php">Não possuo cadastro</a><br>
        </form>
      </div>
      <!--                           troca senha                                                      -->
      <div id="troca-senha" class="escoder11">
        <div id="meuElemento">
          <form method="post" id="troca-senha" action="../rotas/troca_senha.php">
            <div class="escondersenha">
              <h2>Troca de Senha</h2>
              <label for="cpf">CPF:</label><br>
              <input type="text" name="cpf" placeholder="Digite o CPF" oninput="verificarCPF()" id="cpf">
              <div id="campoSenha" class="escondersenha" style="display: none;">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" id="nova_senha" placeholder="Digite a senha">
                <label for="confirma_senha">Confirma Senha:</label>
                <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme a senha">
              </div>
              <a href="login.php">Voltar à área de login</a>
              <button class="buttonSenha" id="troca-senha-final" type="submit">Confirmar</button>
              <a href="cadastro.php">Não possui cadastro?</a>
          </form>
          <!--                               2fa                                                    -->
        </div class="escoder11">
        <form method="post" action="../rotas/2fa.php">
          <div id="fa" class="esconder2fa fa">
            <h2>2FA</h2>
            <div>
              <label for="pergunta1nomeM">Qual é o nome da sua mãe?</label>
              <input type="text" name="pergunta1nomeM" id="pergunta1nomeM">
            </div>
            <div>
              <label for="pergunta2CEP">Qual é o CEP do seu endereço?</label>
              <input type="text" name="pergunta2CEP" id="pergunta2CEP">
            </div>
            <div>
              <label for="pergunta3dataN">Qual é a data do seu nascimento?</label>
              <input type="date" name="pergunta3dataN" id="pergunta3dataN">
            </div>
            <button id="confimar_login" name="confimar_login" type="submit" class="buttonEntrar">comfirmar</button>
            <br><br><br>
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
<script src="../script/2fa.js"></script>
<script src="../script/perguntas_segurança.js"></script>
<script src="../script/cpf_verificar.js"></script>
<script src="../script/login.js"></script>
<script src="../script/script.js"></script>
<script src="../script/troca-senha.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>