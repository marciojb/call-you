
document.getElementsByName("mostrarPerguntas")[0].addEventListener("click", function () {
    // Verifica se o login e a senha estão preenchidos
    var login = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;

    if (login && senha) {
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
    } else {
        // Caso login ou senha não estejam preenchidos, você pode mostrar uma mensagem ou realizar outra ação
        console.log("Preencha o login e a senha antes de mostrar as perguntas.");
    }
});





