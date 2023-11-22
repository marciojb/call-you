
document.getElementsByName("mostrarPerguntas")[0].addEventListener("click", function () {
    var campos = ["pergunta1nomeM", "pergunta2CEP", "pergunta3dataN"];
    var campoAleatorio = campos[Math.floor(Math.random() * campos.length)];
    // Oculta todos os campos e seus rótulos
    for (var i = 0; i < campos.length; i++) {
        document.getElementById(campos[i]).style.display = "none";
        var labelForCampo = document.querySelector('label[for="' + campos[i] + '"]');
        if (labelForCampo) {
            labelForCampo.style.display = "none";
        }
    }
    // Exibe o campo e seu rótulo aleatório
    document.getElementById(campoAleatorio).style.display = "block";
    var labelForCampoAleatorio = document.querySelector('label[for="' + campoAleatorio + '"]');
    if (labelForCampoAleatorio) {
        labelForCampoAleatorio.style.display = "block";
    }
});




