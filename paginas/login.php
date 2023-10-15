<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>login</title>
</head>

<body>
  <!-- header-->
  <?php require_once '../componentes/header.php'; ?>


  <div class="">
    <div id="container_login" id="meuElemento" >
      <div id="section1">
        <form id="login_form" class="esconder" action="">
          <h2>LOGIN</h2><br>
          <label for="Email">Email</label><br>
          <input type="text" id="Email"> <br><br>

          <label for="password">Senha</label><br>
          <input type="text" id="password" type="password"><br>
          <a id="test" href="">Esqueci minha senha</a><br><br><br>

          <button id="meuBotao" class="buttonEntrar" type="submit">Entrar</button><br>
          <a href="cadastro.php">Não possuo cadastro</a><br>
        </form>
      </div>
      <div id="troca-senha" class="escoder11">
        <div id="meuElemento" >
          <form id="troca-senha " action="">
            <div class="escondersenha" ><br>
            <h2>troca senha</h2><br>
            <label for="">nova senha </label><br>
            <input type="password"><br><br>
            <label for="">comfirma senha </label>
            <input type="password"><br><br>
            <a href="login.php">Voltar área de login</a>
            <button id="buttonSenha" type="submit">comfimar</button>
            <a href="cadastro.php">Não possui cadastro?</a>
            </div>
            <div id="fa" class="esconder2fa">
            <h2>2fa</h2><br><br>
            <label for="">qual e a resposta ? </label>
            <input type="text">
            <button id="buttonSenha">comfimar</button>
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



  <script src="../script/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>