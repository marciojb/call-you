document.getElementById("meuBotao").addEventListener("click", function (event) {
    event.preventDefault();

    // Realize uma solicitação AJAX para o seu script PHP de login
    const login = document.querySelector("#login").value;
    const senha = document.querySelector("#senha").value;

   

    var elemento = document.getElementById("meuElemento");
    elemento.style.visibility = "visible";
    elemento.style.pointerEvents = "auto";

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
            // O login foi bem-sucedido, então adicione animações
            const imagem = document.querySelector(".mover");
            const input = document.querySelector(".esconder");
            const inputsenha = document.querySelector(".escondersenha");

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
