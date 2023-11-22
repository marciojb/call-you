document.querySelector("#confimar_login1").addEventListener("click", function (event) {
    console.log(event.target);
    event.preventDefault();

    
    const pergunta1nomeM = document.querySelector("#pergunta1nomeM").value;
    const pergunta2CEP = document.querySelector("#pergunta2CEP").value;
    const pergunta3dataN = document.querySelector("#pergunta3dataN").value;

    fetch('../rotas/2fa.php', {
        method: 'POST',
        body: JSON.stringify({  pergunta1nomeM, pergunta2CEP, pergunta3dataN }),
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
            // Manipule a resposta do servidor
            console.log(data);

            // Adicione lógica adicional aqui para lidar com a resposta
            if (data.status === 'success') {
                alert('Login bem-sucedido');
            } else {
                alert('Login mal-sucedido: ' + data.message);
                console.log({pergunta1nomeM, pergunta2CEP, pergunta3dataN });
            }
        })
        .catch(error => {
            console.error('Erro na solicitação AJAX:', error);
        });
});
