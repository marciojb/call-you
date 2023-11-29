function verificarCPF() {
    const cpfInput = document.getElementById('cpf');
    const campoSenha = document.getElementById('campoSenha');

    let cpf = cpfInput.value

    // CPF válido, fazer a solicitação ao servidor para verificar no banco de dados
    fetch('../rotas/verificar_cpf.php', {
        method: 'POST',
        body: JSON.stringify({ cpf }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na solicitação');
        }
        return response.json();
    })
    .then(data => {
        console.log('Resposta do servidor:', data); // Adicione esta linha para verificar a resposta do servidor no console
        const cpfExiste = data.cpfExiste;

        if (cpfExiste) {
            // CPF existe no banco de dados, exiba a senha
            campoSenha.style.display = 'block';
        } else {
            // CPF não existe no banco de dados
            campoSenha.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Erro na solicitação:', error);
        // Trate o erro conforme necessário
        campoSenha.style.display = 'none';
    });

    // Indica que a função foi chamada e a solicitação está em andamento
    return true;
}
