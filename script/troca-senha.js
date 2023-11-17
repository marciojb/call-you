document.getElementById("troca-senha").addEventListener("submit", function (event) {
    event.preventDefault();

    const cpf = document.querySelector("#cpf").value;
    const novaSenha = document.querySelector("#nova_senha").value;
    const confirmaSenha = document.querySelector("#confirma_senha").value;

    // Verificar se as senhas coincidem
    if (novaSenha !== confirmaSenha) {
        alert('a senha nao esta patendo ');
        console.error('As senhas não coincidem.');
        
        return;
    }

    // Realize a solicitação AJAX para verificar o CPF no servidor
    fetch('../rotas/troca_senha.php', {
        method: 'POST',
        body: JSON.stringify({ cpf, nova_senha: novaSenha }),
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
            alert('Senha atualizada com sucesso!');
            location.reload()
        } else {
            alert('Erro ao atualizar a senha: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro na solicitação AJAX:', error);
    });
});
