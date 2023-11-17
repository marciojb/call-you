document.getElementById("confimar_login").addEventListener("submit", function (event) {
    event.preventDefault();
    const login = document.querySelector("#login").value;
    const senha = document.querySelector("#senha").value;
    const pergunta1nomeM = document.querySelector("#pergunta1nomeM").value;
    const pergunta2CEP = document.querySelector("#pergunta2CEP").value;
    const pergunta3dataN = document.querySelector("#pergunta3dataN").value;
    
    fetch('../rotas/2fa.php', {
        method: 'POST',
        body: JSON.stringify({ login,senha, pergunta1nomeM,pergunta2CEP,pergunta3dataN }),
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
            alert('login bem sucedido ');
            
        } else {
            alert('login mal sucedido ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro na solicitação AJAX:', error);
    });
});