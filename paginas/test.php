<?php
if(isset($_POST['submit'])) {
    print_r($_POST['nome']);
    print_r($_POST['login']);
    print_r($_POST['senha']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perguntas Aleatórias</title>
</head>
<body>
    <form action="test.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome">
        <label for="senha">Senha</label>
        <input type="text" name="senha">
        <label for="login">Login</label>
        <input type="text" name="login">
        <button type="submit" name="submit">Test</button>
    </form>
    <script></script>
</body>
</html>
