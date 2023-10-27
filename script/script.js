
///////////////////////////////////login///////////////////////////////////////

document.getElementById("test").addEventListener("click", function(event) {
    event.preventDefault();
    const imagem = document.querySelector(".mover");
    const input = document.querySelector(".esconder");
    const input2fa = document.querySelector(".esconder2fa");
    var elemento = document.getElementById("meuElemento");
    elemento.style.visibility = "visible";
    elemento.style.pointerEvents = "auto"; 

    // Remove a propriedade 'animation: none;' para ativar as animações
    imagem.style.animation = "moverImagem 1s linear forwards";
    input.style.animation = "esconderInput 1s linear forwards" ;
    input2fa.style.animation = "esconderInput 1s linear forwards";
    
});

document.getElementById("meuBotao").addEventListener("click", function(event) {
    event.preventDefault();

    // Realize uma solicitação AJAX para o seu script PHP de login
    const login = document.getElementById("login").value; 
    const senha = document.getElementById("senha").value; 
    
    fetch('../rotas/loginbd.php', {
        method: 'POST',
        body: JSON.stringify({ login, senha }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.loginSucesso === true) {
            // O login foi bem-sucedido, execute as ações
            const imagem = document.querySelector(".mover");
            const input = document.querySelector(".esconder");
            const inputsenha = document.querySelector(".escondersenha");
            var elemento = document.getElementById("meuElemento");
            elemento.style.visibility = "visible";
            elemento.style.pointerEvents = "auto";

            // Remove a propriedade 'animation: none;' para ativar as animações
            imagem.style.animation = "moverImagem 1s linear forwards";
            input.style.animation = "esconderInput 1s linear forwards";
            inputsenha.style.animation = "esconderInput 1s linear forwards";
        } else {
            // O login não foi bem-sucedido, você pode tratar isso de acordo com sua necessidade
            console.log("Login falhou");
        }
    });
});


const perguntas = [
    "Qual o nome da sua mãe?",
    "Qual a data do seu nascimento?",
    "Qual o CEP do seu endereço?"
];

const paragrafoPergunta = document.getElementById("pergunta");
const botaoGerarPergunta = document.querySelector(".gerarPergunta");

botaoGerarPergunta.addEventListener("click", function() {
    const perguntaAleatoria = perguntas[Math.floor(Math.random() * perguntas.length)];
    paragrafoPergunta.textContent = perguntaAleatoria;
});

// Mostrar a primeira pergunta quando a página é carregada
mostrarProximaPergunta();

/////////////////////////////////////cadastro///////////////////////////////

(function(){

	const cep = document.querySelector("input[name=cep]");
  
  cep.addEventListener('blur', e=> {
  		const value = cep.value.replace(/[^0-9]+/, '');
      const url = `https://viacep.com.br/ws/${value}/json/`;
      
      fetch(url)
      .then( response => response.json())
      .then( json => {
      		
          if( json.logradouro ) {
          	document.querySelector('input[name=rua]').value = json.logradouro;
            document.querySelector('input[name=bairro]').value = json.bairro;
            document.querySelector('input[name=cidade]').value = json.localidade;
            
          }
      
      });
      
      
  });

	





})();

