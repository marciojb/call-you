document.getElementById("troca-senha-final").addEventListener("click", function (event) {
    event.preventDefault();

    const novaSenha = document.querySelector("#nova_senha").value;
    const confirmaSenha = document.querySelector("#confirma_senha").value;

    // Verificar se as senhas coincidem
    if (novaSenha !== confirmaSenha) {
        Swal.fire("Erro", "A senha não coincide. Por favor, verifique.", "error");
        console.error('As senhas não coincidem.');
        return;
    }

    // Realizar solicitação AJAX para verificar o CPF no servidor
    fetch('../rotas/troca_senha1.php', {
        method: 'POST',
        body: JSON.stringify({ nova_senha: novaSenha }),
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
            // Adicionar lógica adicional aqui para lidar com a resposta
            console.log(data);

            if (data.status === 'success') {
                Swal.fire("Sucesso", "Senha atualizada com sucesso!", "success").then(() => {
                    // Redirecionar após o alerta ser fechado
                    window.location.href = "../paginas/index.php";
                });
            } else {
                Swal.fire("Erro", "Erro ao atualizar a senha: " + data.message, "error");
            }
        })
        .catch(error => {
            console.error('Erro na solicitação AJAX:', error);
        });
});
