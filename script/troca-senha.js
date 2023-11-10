// Verifique o CPF quando a página carregar
if ($("#cpf").val().trim()) {
        $.ajax({
            url: '../rotas/troca_senha.php',
            type: 'POST',
            data: { cpf: $("#cpf").val().trim() },
            dataType: 'json',
            success: function(response) {
                if (response === "CPF existe no banco de dados") {
                    $("#campoSenha").show();
                }
            }
        });
    }

    $(document).ready(function() {
        var cpfInput = $("#cpf");
        var novaSenhaInput = $("#nova_senha");
        var confirmaSenhaInput = $("#confirma_senha");
    
        // Quando o botão "Confirmar" for clicado
        $("#buttonSenha").click(function() {
            var cpf = cpfInput.val().trim();
            var novaSenha = novaSenhaInput.val();
            var confirmaSenha = confirmaSenhaInput.val();
    
            if (novaSenha === confirmaSenha) {
                // Realize a ação que você deseja aqui (por exemplo, enviar dados para o servidor via AJAX)
                $.ajax({
                    type: "POST",
                    url: '../rotas/troca_senha.php',
                    data: {
                        cpf: cpf,
                        nova_senha: novaSenha
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response === "Senha atualizada com sucesso!") {
                            alert("Senha atualizada com sucesso!");
                        } else {
                            alert("Erro ao atualizar a senha: " + response);
                        }
                    }
                });
            } else {
                alert("Por favor, verifique as senhas antes de continuar.");
            }
        });
    });
    
