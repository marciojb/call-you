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
          <label class="label" for="login">Login:</label>
          <input type="text" class="input_1" id="login" name="login"><br>
        </div>

        <div class="div_input">
          <label class="label" for="nome">Nome:</label>
          <input class="input_1" type="text" id="nome" name="nome"><br>
        </div>

        <div class="div_input">
          <label class="label" for="data_nascimento">Data de Nascimento:</label>
          <input class="input_1" type="date" id="data_nascimento" name="data_nascimento"><br>
        </div>

        <div class="div_input">
          <label class="label" for="nome_materno">Nome Materno:</label>
          <input class="input_1" type="text" id="nome_materno" name="nome_materno"><br>
        </div>

        <div class="div_input">
          <label class="label" for="telefone_celular">Telefone Celular:</label>
          <input class="input_1" type="tel" id="telefone_celular" name="telefone_celular"><br>
        </div>

        <div class="div_input">
          <label class="label" for="cep">CEP:</label>
          <input class="input_1" type="text" id="cep" name="cep" oninput="pesquisacep(this.value)"><br>
        </div>

        <div class="div_input">
          <label class="label" for="bairro">Bairro:</label>
          <input class="input_1" type="text" id="bairro" name="bairro"><br>
        </div>
      </div>

      <div id="test_2">
        <div class="div_input">
          <label class="label" for="senha">Senha:</label>
          <input class="input_1" type="password" id="senha" name="senha"><br>
        </div>

        <div class="div_input">
          <label class="label" for="confirmar">Confirmar Senha:</label>
          <input class="input_1" type="password" id="confirmar" name="confirmar"><br>
        </div>

        <div class="div_input">
          <label class="label" for="cpf">CPF:</label>
          <input class="input_1" type="text" id="cpf" name="cpf"><br>
        </div>

        <div class="div_input">
          <label class="label" for="sexo">Sexo:</label>
          <select class="input_1" id="sexo" name="sexo">
            <option value="nenhum">Prefiro não dizer </option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
          </select>
        </div>

        <div class="div_input">
          <label class="label" for="telefone_fixo">Telefone Fixo:</label>
          <input class="input_1" type="tel" id="telefone_fixo" name="telefone_fixo"><br>
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
  <script src="../script/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>