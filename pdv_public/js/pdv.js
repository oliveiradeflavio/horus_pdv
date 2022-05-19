//mascaras input
$(document).ready(function () {
    $('#inputCelular').mask('(00) 00000-0000');
    $('#inputCEP').mask('00000-000');
    $('#inputCPF').mask('000.000.000-00');
    $('#inputTelefone').mask('(00) 0000-0000');

    $('#inputNome').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });

    $('#inputCidade').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });

    $('#inputBairro').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });
});

// ---- PÁGINA FORNECEDOR ----
$(document).ready(function () {
    $('#inputCNPJ').mask('00.000.000/0000-00');
    $('#inputRazaoSocial').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });

    $('#inputNomeFantasia').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });

});
//fim mascaras input

//Verifica se CPF é válido
function testaCPF(cpf) {
    inputCPFRetorno = document.getElementById('inputCPF');
    if (typeof cpf !== "string") return false
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (cpf.length == 0) {
        //Swal.fire("CPF não informado!");
        inputCPFRetorno.placeholder = 'CPF não informado!';
        return false
    }
    if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"
    ) {
        //Swal.fire('CPF: ' + cpf + ' inválido!');
        inputCPFRetorno.placeholder = 'CPF: ' + cpf + ' inválido!';
        inputCPFRetorno.value = "";
        return false
    }
    var soma = 0
    var resto
    for (var i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(9, 10))) {
        //Swal.fire('CPF: ' + cpf + ' inválido!');
        inputCPFRetorno.placeholder = 'CPF: ' + cpf + ' inválido!';
        inputCPFRetorno.value = "";
        return false
    }
    soma = 0
    for (var i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(10, 11))) {
        //Swal.fire('CPF: ' + cpf + ' inválido!');
        inputCPFRetorno.placeholder = 'CPF: ' + cpf + ' inválido!';
        inputCPFRetorno.value = "";
        return false
    }
    return true
}


//Função para preencher os campos com os valores do CEP.
function meu_callback(conteudo) {
    if (!('erro' in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('inputEndereco').value = (conteudo.logradouro);
        document.getElementById('inputBairro').value = (conteudo.bairro);
        document.getElementById('inputCidade').value = (conteudo.localidade);
        document.getElementById('inputEstado').value = (conteudo.uf);
        document.getElementById('inputEnderecoComplemento').value = (conteudo.complemento);
        document.getElementById('inputCelular').value = (conteudo.ddd);

    } else {
        Swal.fire('Oops...', 'CEP não encontrado!', 'error');
    }
}

//Quando o campo cep perde o foco.
function pesquisaCEP(valor) {


    //Nova variável "cep" somente com dígitos.
    let cep = valor.replace(/\D/g, '');



    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //expressão regular para validar o CEP.	
        let validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('inputEndereco').value = "...";
            document.getElementById('inputBairro').value = "...";
            document.getElementById('inputCidade').value = "...";
            document.getElementById('inputEstado').value = "...";
            document.getElementById('inputEnderecoComplemento').value = "...";
            document.getElementById('inputCelular').value = "...";

            //Cria um elemento javascript.
            let script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Inserre script no documento e carrega o conteúdo.	
            document.body.appendChild(script);
        }
        else {
            //cep é inválido.
            Swal.fire('Oops...', 'CEP inválido!', 'error');
        }
    } else {
        //cep sem valor, limpa formulário.

    }

}

function validaDataNascimento() {
    inputDtNascimento = document.getElementById('inputDtNascimento')
    if (inputDtNascimento.value) {
        let data = inputDtNascimento.value
        data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
        let data_array = data.split("-"); // quebra a data em array

        // para o IE onde será inserido no formato dd/MM/yyyy
        if (data_array[0].length != 4) {
            data = data_array[2] + "-" + data_array[1] + "-" + data_array[0]; // remonto a data no formato yyyy/MM/dd
        }

        // comparo as datas e calculo a idade
        let hoje = new Date();
        let nasc = new Date(data);
        let idade = hoje.getFullYear() - nasc.getFullYear();
        let m = hoje.getMonth() - nasc.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;

        if (idade < 18) {
            Swal.fire('Oops...', 'Idade mínima de 18 anos!', 'error');
            return false;
        }

        return true;

    }
}


function validaCampos() {
    let inputNome = document.getElementById('inputNome');
    let inputCPF = document.getElementById('inputCPF');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputBairro = document.getElementById('inputBairro');
    let inputCidade = document.getElementById('inputCidade');
    let inputEstado = document.getElementById('inputEstado');
    let inputCelular = document.getElementById('inputCelular');

    document.querySelector('#formCadCliente').addEventListener(
        'submit', function (event) {

            if (inputNome.value == "") {
                Swal.fire('Oops...', 'Nome não informado!', 'error');
                return false;
            }
            else if (inputCPF.value == "") {
                Swal.fire('Oops...', 'CPF não informado!', 'error');
                return false;
            }
            else if (inputCEP.value == "") {
                Swal.fire('Oops...', 'CEP não informado!', 'error');
                return false;
            }
            else if (inputEndereco.value == "") {
                Swal.fire('Oops...', 'Endereço não informado!', 'error');
                return false;
            }
            else if (inputBairro.value == "") {
                Swal.fire('Oops...', 'Bairro não informado!', 'error');
                return false;
            }
            else if (inputCidade.value == "") {
                Swal.fire('Oops...', 'Cidade não informada!', 'error');
                return false;
            }
            else if (inputEstado.value == "") {
                Swal.fire('Oops...', 'Estado não informado!', 'error');
                return false;
            }
            else if (inputCelular.value == "") {
                Swal.fire('Oops...', 'Celular não informado!', 'error');
                return false;
            }
        
            event.preventDefault();
            document.getElementById('formCadCliente').submit();
            console.log('cadastro com sucesso');
            return true;

        });

}
