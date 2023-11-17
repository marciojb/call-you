function verificarCPF() {
    const cpfInput = document.getElementById('cpf');
    const campoSenha = document.getElementById('campoSenha');

    const cpf = cpfInput.value.replace(/\D/g, ''); // Remover caracteres não numéricos do CPF

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
        return response.json(); // Trate a resposta como JSON
    })
    .then(data => {
        const cpfExiste = data.cpfExiste;

        if (cpfExiste) {
            campoSenha.style.display = 'block';
        } else {
            campoSenha.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Erro na solicitação:', error);
        // Trate o erro conforme necessário
    });
}
