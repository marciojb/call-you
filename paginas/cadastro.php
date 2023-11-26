<!-- cadastro bd-->
<?php   require_once '../rotas\cadastrobd.php'; ?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>

  <!-- header-->
  <?php require_once '../componentes/header.php'; ?>

  <form class="formulario" action="cadastro.php" method="post">
    <div class="titulo"><br>
      <h1 class="texto-titulo">CADASTRO</h1>
    </div><br>

    <div class="test">

      <div id="test_1">
        <div class="div_input">
          <label class="label" id="loginMessage" for="label-login">Login:</label>
          <input type="text" class="input_1" id="login" minlength="6" maxlength="6" name="login" required oninput="validateLogin()"><br>
        </div>

        <div class="div_input">
          <label class="label" id="nomeMessage" for="label-nome">Nome:</label>
          <input class="input_1" type="text" minlength="15" maxlength="60" required id="nome" oninput="validateNome()" name="nome"><br>
        </div>

        <div class="div_input">
          <label class="label" id="data_Message" for="label-data_nascimento">Data de Nascimento:</label>
          <input class="input_1" type="date" required id="data_nascimento" name="data_nascimento" oninput="validadata()"><br>
        </div>

        <div class="div_input">
          <label class="label" id="nome_maternoMessage" for="label-nome_materno">Nome Materno:</label>
          <input class="input_1" required type="text" id="nome_materno" name="nome_materno" oninput="validatemae()"><br>
        </div>

        <div class="div_input">
          <label class="label" id="celularMessage" for="label-telefone_celular">Telefone Celular:</label>
          <input class="input_1" required type="tel" id="telefone_celular" name="telefone_celular" oninput="validaCelular()" ><br>
        </div>

        <div class="div_input">
          <label class="label" id="cepMessage" for="label-cep">CEP:</label>
          <input class="input_1" required type="text" id="cep" name="cep" oninput="pesquisacep(this.value)"><br>
        </div>

        <div class="div_input">
          <label class="label" for="bairro">Bairro:</label>
          <input class="input_1" type="text" id="bairro" name="bairro"><br>
        </div>
      </div>

      <div id="test_2">
        <div class="div_input">
          <label class="label" id="senhaMessage" for="senha">Senha:</label>
          <input class="input_1" required type="password" minlength="8" maxlength="8" oninput="validaSenha()" id="senha" name="senha"><br>
        </div>

        <div class="div_input">
          <label class="label" id="senhaMessage1" for="label-confirmar">Confirmar Senha:</label>
          <input class="input_1" required type="password" minlength="8" maxlength="8" id="confirmar" oninput="validaSenha()" name="confirmar"><br>
        </div>

        <div class="div_input">
          <label class="label" id="cpfMessage" for="label-cpf">CPF:</label>
          <input class="input_1" minlength="11" maxlength="11" oninput="validarCPF(this)" required type="text" id="cpf" name="cpf"><br>
        </div>

        <div class="div_input">
          <label class="label" id="sexoMessage"  for="label-sexo">Sexo:</label>
          <select class="input_1" required id="sexo" name="sexo" oninput="validateSexo()" >
            <option value="nenhum">Prefiro não dizer </option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
          </select>
        </div>

        <div class="div_input">
          <label class="label" id="fixoMessage" for="label-telefone_fixo">Telefone Fixo:</label>
          <input class="input_1" required type="tel" id="telefone_fixo" name="telefone_fixo" oninput="validafixo()" ><br>
        </div>

        <div class="div_input">
          <label class="label" for="rua">Rua:</label>
          <input class="input_1" class="div_input" type="text" id="rua" name="rua"><br>
        </div>

        <div class="div_input">
          <label class="label" for="cidade">Cidade:</label>
          <input class="input_1" type="text" id="cidade" name="cidade"><br>
        </div>

      </div>

      
      <label class="label" for="complemento">Complemento:</label>
      <input class="input_2" type="text" id="complemento" name="complemento"><br>
      <br><br>

      <div>
        <a href="../paginas/login.php">Já possui login?</a> 
      </div><br> <br>

      <div id="div_botao">
        <input class="botao" type="submit" name="submit" value="Cadastra">
        <input class="botao" type="submit" value="Limpa cadastro">
      </div>
    </div>
  </form>

  <!-- footer-->
  <?php require_once '../componentes/footer.php'; ?>
  <script src="../script/cadastro.js"></script>
  <script src="../script/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>