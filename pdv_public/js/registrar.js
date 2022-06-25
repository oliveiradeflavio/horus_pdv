//preview  imagem no input, quando o usuário carregar uma image, logo irá aparecer uma prewiew da mesma
function readImage() {
    if (this.files && this.files[0]) {
        let file = new FileReader();
        file.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };       
        file.readAsDataURL(this.files[0]);
    }
}
document.getElementById("img-input").addEventListener("change", readImage, false);
//FIM preview  imagem no input

//função que ativa o Label, irá abrir a janela para escolher a imagem
function selecionaImagem(){
    let input = document.getElementById("img-input");
    let nome_arquivo = document.getElementById("nome-arquivo");

    input.addEventListener("change", function(){
        nome_arquivo.textContent = input.value;
    })
}
selecionaImagem();

//mascaras de input 
$(document).ready(function () {
    $('#cpf').mask('000.000.000-00');
    $('#nome').on('keypress', function (e) {
        //let regex = new RegExp("^[a-zA-Z ]+$");
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255 )  {
            return true;
        }

        e.preventDefault();
        return false;
    });
    $('#usuario').on('keyup', function (e) {
        let username = $('#usuario').val();
        username = username.toLowerCase();
        $('#usuario').val(username);
    });

});

//Verifica se CPF é válido
function testaCPF(cpf) {
    inputCPFRetorno = document.getElementById('cpf');
    if (typeof cpf !== "string") return false
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (cpf.length == 0) {   
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
            
        return false
    }
    var soma = 0
    var resto
    for (var i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(9, 10))) {
        return false
    }
    soma = 0
    for (var i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11)) resto = 0
    if (resto != parseInt(cpf.substring(10, 11))) {
       return false
    }
    return true
}

//verifica o email digitado
function validaEmail(){
    let email = document.getElementById("email").value;
    let reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(reg.test(email) == false) {
        return false;
    }else{
        return true;
    }
}

//validação campos obrigatórios do formulário
function validaCampos(){
    let cpf = document.getElementById("cpf").value;
    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let username = document.getElementById("usuario").value;
    let senha = document.getElementById("senha").value;
    let botaoRegistrar = document.getElementById("botaoRegistrar");

    if (cpf != "" && nome != "" && email != "" && username != "" && senha != ""){
        botaoRegistrar.disabled = false;
        if(senha.length < 6){   
            botaoRegistrar.disabled = true;
            Swal.fire({
                title: 'Atenção',
                text: 'A senha deve conter no mínimo 6 caracteres',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })

        }else if(!testaCPF(cpf)){
            botaoRegistrar.disabled = true;
            Swal.fire({
                title: 'Atenção',
                text: 'CPF inválido',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        
        }else if(nome < 10){
            botaoRegistrar.disabled = true;
            Swal.fire({
                title: 'Atenção',
                text: 'Digite seu nome completo',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        }else if(!validaEmail()){
            botaoRegistrar.disabled = true;
            Swal.fire({
                title: 'Atenção',
                text: 'Email inválido',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        }else if(username.length < 6){
            botaoRegistrar.disabled = true;
            Swal.fire({
                title: 'Atenção',
                text: 'O username deve conter no mínimo 6 caracteres',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        }

        return true;
    }else {
        botaoRegistrar.disabled = true;
        return false;
    }
}
