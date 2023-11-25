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
/////////////////////////////////////cadastro///////////////////////////////


const body = document.querySelector('body')
			const toggle = document.getElementById('toggle');
			toggle.onclick = function(){
				toggle.classList.toggle('active')
				body.classList.toggle('active')}


