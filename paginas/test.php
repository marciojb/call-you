<form method="post" action="../rotas/2fa.php">
    <div id="fa" class="esconder2fa">
        <h2>2FA</h2><br><br>
        <div>
            <label for="pergunta1nomeM">Qual é o nome da sua mãe?</label>
            <input type="text" name="pergunta1nomeM" id="pergunta1nomeM">
        </div>
        <div>
            <label for="pergunta2CEP">Qual é o CEP do seu endereço?</label>
            <input type="text" name= "pergunta2CEP" id="pergunta2CEP">
        </div>
        <div>
            <label for="pergunta3dataN">Qual é a data do seu nascimento?</label>
            <input type="date" name="pergunta3dataN" id="pergunta3dataN">
        </div>
        <button id="mostrarPerguntas" class="buttonEntrar" type="button">Mostrar Pergunta</button>
    </div>
</form>

<script>
 document.getElementById("mostrarPerguntas").addEventListener("click", function() {
    var div2fa = document.getElementById("fa");
    var campos = ["pergunta1nomeM", "pergunta2CEP", "pergunta3dataN"];
    var campoAleatorio = campos[Math.floor(Math.random() * campos.length)];

    // Oculta todos os campos e seus rótulos
    for (var i = 0; i < campos.length; i++) {
        document.getElementById(campos[i]).style.display = "none";
        document.querySelector('label[for="' + campos[i] + '"]').style.display = "none";
    }

    // Exibe o campo e seu rótulo aleatório
    document.getElementById(campoAleatorio).style.display = "block";
    document.querySelector('label[for="' + campoAleatorio + '"]').style.display = "block";

    this.style.display = "none";
});

</script>