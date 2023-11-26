
////////////////login//////////////////////
function validateLogin() {
    var loginInput = document.getElementById('login');
    var loginMessage = document.getElementById('loginMessage');

    // Limpar o campo removendo qualquer caractere que não seja uma letra
    loginInput.value = loginInput.value.replace(/[^a-zA-Z]/g, '');

    // Verificar se o login possui exatamente 6 letras
    if (/^[a-zA-Z]{6}$/.test(loginInput.value)) {
        loginMessage.innerHTML = 'Login válido!';
        loginMessage.className = 'validv';
    } else {
        loginMessage.innerHTML = 'Login:';
        loginMessage.className = 'validf';
    }
}//////////////////nome//////////////////
function validateNome() {
    var nomeInput = document.getElementById('nome');
    var nomeMessage = document.getElementById('nomeMessage');

    // Limpar o campo removendo qualquer caractere que não seja uma letra
    nomeValue.value = nomeInput.value.replace(/[^a-zA-Z]/g, '');

    

    // Verificar se o nome tem entre 15 e 60 caracteres
    if (/^[a-zA-Z]{15,60}$/.test(nomeValue)) {
        nomeMessage.innerHTML = 'Nome válido!';
        nomeMessage.className = 'validv';
    } else {
        nomeMessage.innerHTML = 'Nome:';
        nomeMessage.className = 'validf';
    }
}
//////////////////////nome mae////////////////////////
function validatemae() {
    var maeInput = document.getElementById('nome_materno');
    var maeMessage = document.getElementById('nome_maternoMessage');

    // Limpar o campo removendo qualquer caractere que não seja uma letra
    var maeValue = maeInput.value.replace(/[^a-zA-Z]/g, '');

    // Verificar se o nome tem entre 15 e 60 caracteres
    if (/^[a-zA-Z]{15,60}$/.test(maeValue)) {
        maeMessage.innerHTML = 'Nome Materno:';
        maeMessage.className = 'validv';
    } else {
        maeMessage.innerHTML = 'Nome Materno inválido!';
        maeMessage.className = 'validf';
    }
}




//////////senha////////////////////
function validaSenha() {
    var senhaInput = document.getElementById('senha');
    var confirmar = document.getElementById('confirmar');
    var senhaMessage = document.getElementById('senhaMessage');
    var senhaMessage1 = document.getElementById('senhaMessage1');

    // Remover caracteres não alfabéticos
    var senhaLimpa = senhaInput.value.replace(/[^a-zA-Z]/g, '');

    // Verificar se as senhas são iguais e têm exatamente 8 letras
    if (senhaLimpa.length === 8 && senhaLimpa === confirmar.value) {
        senhaMessage.innerHTML = 'Senhas: ';
        senhaMessage.className = 'validv';
        senhaMessage1.innerHTML = 'Senhas: ';
        senhaMessage1.className = 'validv';
    } else {
        senhaMessage.innerHTML = 'Senhas:';
        senhaMessage.className = 'validf';
        senhaMessage1.innerHTML = 'Senhas não batem:';
        senhaMessage1.className = 'validf';
    }
}

////////////////////////cpf////////////////////////

 $(document).ready(function () {
    $("#cpf").mask("999.999.999-99");
});

function _cpf(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

function validarCPF(el) {
    var cpfInput = $("#cpf");
    var cpfMessage = $("#cpfMessage");

    var cpfValue = cpfInput.val().replace(/\D/g, ''); // Remove caracteres não numéricos

    if (_cpf(cpfValue)) {
        cpfMessage.html('CPF válido!');
        cpfMessage.removeClass('validf').addClass('validv');
    } else {
        cpfMessage.html('CPF inválido!');
        cpfMessage.removeClass('validv').addClass('validf');
    }
}

////////////////////////////////////////////////

$(document).ready(function () {
    $("#cep").mask("99999-999");
});

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    
    
}

function meu_callback(conteudo) {
    var cepMessage = document.getElementById('cepMessage');
    
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        cepMessage.innerHTML = 'CEP não Encontrado:';
        cepMessage.className = 'validf';
    }
}

function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            
            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
            var cepMessage = document.getElementById('cepMessage');
            cepMessage.innerHTML = 'CEP: ';
            cepMessage.className = 'validv';

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            var cepMessage = document.getElementById('cepMessage');
            cepMessage.innerHTML = 'CEP é inválido. ';
            cepMessage.className = 'validf';
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}


/////////////////////valida anivesario///////////////////////////////
function validadata() {
    var dataMessage = document.getElementById('data_Message');
    var dataInput = document.getElementById("data_nascimento").value; // pega o valor do input

    // Substituir barras (ex. IE) "/" por hífen "-"
    var data = dataInput.replace(/\//g, "-");

    // Quebrar a data em array
    var data_array = data.split("-");

    // Para o IE onde será inserido no formato dd/MM/yyyy   
    if (data_array[0].length != 4) {
        data = data_array[2] + "-" + data_array[1] + "-" + data_array[0]; // remonto a data no formato yyyy/MM/dd
    }

    // Comparar as datas e calcular a idade
    var hoje = new Date();
    var nasc = new Date(data);
    var idade = hoje.getFullYear() - nasc.getFullYear();
    var m = hoje.getMonth() - nasc.getMonth();

    // Verificar se o aniversário já ocorreu este ano
    if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) {
        idade--;
    }

    if (idade < 18) {
        dataMessage.innerHTML = 'Menores de 18 anos não podem se cadastrar!';
        dataMessage.className = 'validf';
        return false;
    }

    if (idade >= 18 && idade <= 60) {
        dataMessage.innerHTML = 'Data de Nascimento:';
        dataMessage.className = 'validv';
        return true;
    }

    // Se for maior que 60, não vai acontecer nada!
    return false;
}

/////////////////////////////telefone////////////////////////////////
$(document).ready(function () {
    $("#telefone_celular").mask("(99)99999-9999");
});
$(document).ready(function () {
    $("#telefone_fixo").mask("(99)99999-9999");
});

function validaCelular() {
    var celularInput = document.getElementById('telefone_celular');
    var celularMessage = document.getElementById('celularMessage');

    // Limpar o campo removendo qualquer caractere que não seja um número
    var celularValue = celularInput.value.replace(/\D/g, '');

    // Verificar se o número de telefone tem exatamente 11 dígitos
    if (/^\d{11}$/.test(celularValue)) {
        celularMessage.innerHTML = 'Número de celular válido!';
        celularMessage.className = 'validv';
        return true;
    } else {
        celularMessage.innerHTML = 'Número de celular inválido!';
        celularMessage.className = 'validf';
        return false;
    }
}

function validafixo() {
    var telefone_fixo = document.getElementById('telefone_fixo');
    var fixoMessage = document.getElementById('fixoMessage');

    // Limpar o campo removendo qualquer caractere que não seja um número
    var fixoValue = telefone_fixo.value.replace(/\D/g, '');

    // Verificar se o número de telefone tem exatamente 11 dígitos
    if (/^\d{11}$/.test(fixoValue)) {
        fixoMessage.innerHTML = 'Número de celular válido!';
        fixoMessage.className = 'validv';
        return true;
    } else {
        fixoMessage.innerHTML = 'Número de celular inválido!';
        fixoMessage.className = 'validf';
        return false;
    }
}

//////////////////////////sexo/
function validateSexo() {
    var sexoInput = document.getElementById('sexo');
    var sexoMessage = document.getElementById('sexoMessage');

    var sexoValue = sexoInput.value;

    // Verificar se o sexo selecionado não é o valor padrão ("nenhum")
    if (sexoValue !== "nenhum") {
        sexoMessage.innerHTML = 'Sexo:';
        sexoMessage.className = 'validv';
        return true;
    } else {
        sexoMessage.innerHTML = 'Por favor, selecione um sexo.';
        sexoMessage.className = 'validf';
        return false;
    }
}

function JSalert(){

    swal("Congrats!", ", Your account is created!", "success");
    
    }

