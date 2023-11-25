let isMasterOnly = localStorage.getItem('isMasterOnly') === '';

document.getElementById("toggleButton").addEventListener("click", function (event) {
    event.preventDefault();

    isMasterOnly = !isMasterOnly;
    console.log('isMasterOnly atualizado:', isMasterOnly);

    const escoderPerfil1 = document.getElementsByName("escoder_perfil")[0]; // Ajuste aqui
    escoderPerfil1.style.display = isMasterOnly ? "none" : "block";

    // Verifica se o botão está configurado para permitir apenas "master" e oculta ou exibe o segundo elemento "escoder_perfil"
    const escoderPerfil2 = document.getElementsByName("escoder_perfil")[1]; // Ajuste aqui
    escoderPerfil2.style.display = isMasterOnly ? "none" : "block";

    // Atualiza o texto do botão com base no estado atual
    this.innerText = isMasterOnly ? "Master" : "Cliente";
});

document.getElementById("meuBotao").addEventListener("click", function (event) {
    event.preventDefault();

    // Realize uma solicitação AJAX para o seu script PHP de login
    const login = document.querySelector("#login").value;
    const senha = document.querySelector("#senha").value;

    fetch('../rotas/loginbd.php', {
        method: 'POST',
        body: JSON.stringify({ login, senha }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na solicitação. Código de resposta: ' + response.status);
        }
        return response.json(); // Tratar a resposta como JSON
    })
    .then(data => {
        console.log('Resposta do servidor:', data);
        console.log('isMasterOnly:', isMasterOnly);

        const perfilUsuario = data.perfil;
        console.log('perfilUsuario:', perfilUsuario);

        // Verifica se o botão está configurado para permitir apenas "master"
        if (isMasterOnly && perfilUsuario !== 'master') {
            console.log('Apenas perfil "master" permitido. Faça o que for necessário.');
            // Limpa os campos de login
            document.querySelector("#login").value = "";
            document.querySelector("#senha").value = "";
            return;
        }

        if (perfilUsuario === 'master' && isMasterOnly) {
            // Se o perfil é "master" e o botão está configurado para permitir apenas "master", redirecione imediatamente
            fetch('../function/login_maste.php', {
                method: 'GET',
                credentials: 'include', // Inclui cookies na solicitação
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na solicitação. Código de resposta: ' + response.status);
                }
                // Continue com o redirecionamento após a sessão ser iniciada
                window.location.href = '../paginas/index.php';
            })
            .catch(error => {
                console.error('Erro no redirecionamento após iniciar a sessão:', error);
            });
        } else if (perfilUsuario === 'comum') {
            // Se o perfil é "comum", inicie as animações
            const imagem = document.querySelector(".mover");
            const input = document.querySelector(".esconder");
            const inputsenha = document.querySelector(".escondersenha");

            if (imagem && input && inputsenha) {
                // Verifica se os elementos existem antes de tentar acessar suas propriedades
                imagem.style.animation = "moverImagem 1s linear forwards";
                input.style.animation = "esconderInput 1s linear forwards";
                inputsenha.style.animation = "esconderInput 1s linear forwards";

                var elemento = document.getElementById("meuElemento");
                if (elemento) {
                    // Verifica se o elemento existe antes de tentar acessar suas propriedades
                    elemento.style.visibility = "visible";
                    elemento.style.pointerEvents = "auto";
                }
            } else {
                console.log('Elementos não encontrados para iniciar animações.');
            }
        } else {
            // Perfil desconhecido, faça o que for necessário
            console.log('Perfil desconhecido ou não fornecido pelo servidor:', perfilUsuario);
        }
    })
    .catch(error => {
        console.error('Erro na solicitação AJAX:', error);
    });
});
