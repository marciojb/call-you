document.getElementById("meuBotao").addEventListener("click", function() {
    const imagem = document.querySelector(".imagem");
    const input = document.querySelector(".input");

    // Remove a classe que aciona a animação de movimento da imagem
    imagem.classList.remove("imagem");

    // Remove a classe que aciona a animação de esconder o input
    input.classList.remove("input");

    // Adiciona as classes novamente para reiniciar a animação
    setTimeout(function() {
        imagem.classList.add("imagem");
        input.classList.add("input");
    }, 10); // Pequeno atraso para reativar as animações
});