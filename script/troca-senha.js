document.getElementById("troca-senha-final").addEventListener("click", function (event) {
    event.preventDefault();

    const cpf = document.querySelector("#cpf").value;
    const novaSenha = document.querySelector("#nova_senha").value;
    const confirmaSenha = document.querySelector("#confirma_senha").value;

    // Validar o formato do CPF (exemplo simples)
    if (!validateCPF(cpf)) {
        Swal.fire("Erro", "CPF inválido. Por favor, verifique.", "error");
        console.error('CPF inválido.');
        return;
    }

    // Verificar se as senhas coincidem
    if (novaSenha !== confirmaSenha) {
        Swal.fire("Erro", "A senha não coincide. Por favor, verifique.", "error");
        console.error('As senhas não coincidem.');
        return;
    }

    // Desativar o botão enquanto a solicitação está em andamento
    document.getElementById("troca-senha-final").disabled = true;

    // Realizar solicitação AJAX para verificar o CPF no servidor
    fetch('../rotas/troca_senha.php', {
        method: 'POST',
        body: JSON.stringify({ cpf: cpf, nova_senha: novaSenha }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na solicitação');
            }
            return response.json(); // Tratar a resposta como JSON
        })
        .then(data => {
            // Manipular a resposta do servidor
            console.log(data);

            // Habilitar o botão novamente após a conclusão da solicitação
            document.getElementById("troca-senha-final").disabled = false;

            // Adicionar lógica adicional aqui para lidar com a resposta
            if (data.status === 'success') {
                Swal.fire("Sucesso", "Senha atualizada com sucesso!", "success").then(() => {
                    // Limpar os campos de senha
                    document.querySelector("#nova_senha").value = "";
                    document.querySelector("#confirma_senha").value = "";

                    // Redirecionar após o alerta ser fechado
                    window.location.href = "../paginas/login.php";
                });
            } else {
                Swal.fire('Erro ao atualizar a senha: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro na solicitação AJAX:', error);

            // Habilitar o botão novamente em caso de erro
            document.getElementById("troca-senha-final").disabled = false;
        });
});

// Função de validação simples para CPF (apenas como exemplo)
function validateCPF(cpf) {
    // Implemente a lógica de validação do CPF aqui
    // Retorna true se o CPF for válido, false caso contrário
    return true;
}
