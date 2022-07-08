//máscasras inputs dados empresariais
$(document).ready(function() {
    $('#cnpj_empresa').mask('00.000.000/0000-00');
    $('#cep_empresa').mask('00000-000');
    $('#celular_empresa').mask('(00)00000-0000');
    $('#telefone_empresa').mask('(00)0000-0000');
    $('#nome_empresa').on('keypress', function(e){
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    
    $('#cidade_empresa').on('keypress', function(e){
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    $('#numero_empresa').on('keypress', function(e){
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 47 && str < 58) {
            return true;
        }else{
            return (str == 8 || str == 0)?true:false;
        }
    })
});

//Controller das nav-tabs
$(function () {
    let hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('#tab_configuracoes a').click(function (e) {
        $(this).tab('show');
        let scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});

/*
checkbox para habilitar/desabilitar campos de perfil
se o checkbox estiver marcado, os campos devem ser habilitados para editar e inserir a nova senha e a senha antiga
se o checkbox estiver desmarcado, os campos devem ser desabilitados.
*/
function habilitarTrocaSenha() {
    let checkbox = document.getElementById('checkbox_senha_alterar_senha');
    let campo_antiga_senha = document.getElementById('senha_master_antiga');
    let campo_nova_senha = document.getElementById('senha_master_nova');
    let btn_salvar_senha = document.getElementById('btn_salvar_senha');

    if (checkbox.checked) {
        campo_antiga_senha.disabled = false;
        campo_nova_senha.disabled = false;

        campo_antiga_senha.required = true;
        campo_nova_senha.required = true;

        btn_salvar_senha.disabled = false;


    } else {
        campo_antiga_senha.disabled = true;
        campo_nova_senha.disabled = true;

        btn_salvar_senha.disabled = true;
    }

    btn_salvar_senha.addEventListener('click', function (event) {
        event.preventDefault();
        if (campo_antiga_senha.value == '' || campo_nova_senha.value == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos para alterar a senha!',
                confirmButtonText: 'Ok'
            });
        } else {
            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente alterar a senha?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {
                    let form = document.getElementById('form_alterar_senha_master');
                    form.method = 'POST';
                    form.action = 'configuracoes_controller.php'
                    form.submit();
                }
            })
        }
    });
}

function habilitarTrocaPermissao() {
    let checkbox = document.getElementById('checkbox_permissao_usuario');
    let permissao_usuario = document.getElementById('permissao_usuario');
    let usuario_permissao = document.getElementById('usuario_permissao');
    let btn_salvar_permissao = document.getElementById('btn_salvar_permissao');

    if (checkbox.checked) {
        permissao_usuario.disabled = false;
        usuario_permissao.disabled = false;

        permissao_usuario.required = true;
        usuario_permissao.required = true;

        btn_salvar_permissao.disabled = false;

    } else {
        permissao_usuario.disabled = true;
        usuario_permissao.disabled = true;

        btn_salvar_permissao.disabled = true;
    }

    btn_salvar_permissao.addEventListener('click', function (event) {
        event.preventDefault();
        if (permissao_usuario.value == '' || usuario_permissao.value == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos para alterar a permissão!',
                confirmButtonText: 'Ok'
            });
        } else {
            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente alterar a permissão?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {
                    let form = document.getElementById('form_alterar_permissao_usuario');
                    form.method = 'POST';
                    form.action = 'registra_controller.php?acao=permissao'
                    form.submit();
                }
            })
        }
    });
}

function habilitarRecuperacaoSenha(){
    let checkbox = document.getElementById('checkbox_recuperar_senha');
    let usuario_recuperacao_senha = document.getElementById('usuario_recuperar_senha');
    let input_nova_senha = document.getElementById('senha_usuario_recuperada_nova');
    let btn_salvar_recuperacao_senha = document.getElementById('btn_salvar_recuperar_senha');

    if(checkbox.checked){
        usuario_recuperacao_senha.disabled = false;
        input_nova_senha.disabled = false;

        usuario_recuperacao_senha.required = true;
        input_nova_senha.required = true;

        btn_salvar_recuperacao_senha.disabled = false;
    
    }else {
        usuario_recuperacao_senha.disabled = true;
        input_nova_senha.disabled = true;

        btn_salvar_recuperacao_senha.disabled = true;
    }

    btn_salvar_recuperacao_senha.addEventListener('click', function(event){
        event.preventDefault();
        if(usuario_recuperacao_senha.value == '' || input_nova_senha.value == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos para alterar a senha!',
                confirmButtonText: 'Ok'
            });
        }else if(input_nova_senha.value.length < 6){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'A senha deve ter no mínimo 6 caracteres!',
                confirmButtonText: 'Ok'
            });
        }else{
            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente alterar a senha?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if(result.value){
                    let form = document.getElementById('form_recuperar_senha');
                    form.method = 'POST';
                    form.action = 'registra_controller.php?acao=recuperar_senha'
                    form.submit();
                }
            })
        }
    });
}

function habilitarExcluirUsuario(){
    let checkbox = document.getElementById('checkbox_excluir_usuario');
    let usuario_excluir = document.getElementById('usuario_excluir');
    let btn_excluir_usuario = document.getElementById('btn_excluir_usuario');

    if(checkbox.checked){
        usuario_excluir.disabled = false;
        usuario_excluir.required = true;
        btn_excluir_usuario.disabled = false;
    
    }
    else {
        usuario_excluir.disabled = true;
        btn_excluir_usuario.disabled = true;
    }
    
    btn_excluir_usuario.addEventListener('click', function(event){
        event.preventDefault();
        if(usuario_excluir.value == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos para excluir o usuário!',
                confirmButtonText: 'Ok'
            });
        }else{
            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente excluir o usuário?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if(result.value){
                    let form = document.getElementById('form_excluir_usuario');
                    form.method = 'POST';
                    form.action = 'registra_controller.php?acao=excluir_usuario'
                    form.submit();
                }
            })
        }
    });

}

function habilitaDadosEmpresariais(){
    let checkbox = document.getElementById('checkbox_editar_dados_empresariais');

    let cnpj_empresa = document.getElementById('cnpj_empresa');
    let nome_empresa = document.getElementById('nome_empresa');
    let cep_empresa = document.getElementById('cep_empresa');
    let estado_empresa = document.getElementById('estado_empresa');
    let endereco_empresa = document.getElementById('endereco_empresa');
    let numero_empresa = document.getElementById('numero_empresa');
    let bairro_empresa = document.getElementById('bairro_empresa');
    let cidade_empresa = document.getElementById('cidade_empresa');
    let telefone_empresa = document.getElementById('telefone_empresa');
    let celular_empresa = document.getElementById('celular_empresa');
    let email_empresa = document.getElementById('email_empresa');
    let btn_dados_empresariais = document.getElementById('btn_salvar_dados_empresariais');

    if(checkbox.checked){
        cnpj_empresa.disabled = false;
        nome_empresa.disabled = false;
        cep_empresa.disabled = false;
        estado_empresa.disabled = false;
        endereco_empresa.disabled = false;
        numero_empresa.disabled = false;
        bairro_empresa.disabled = false;
        cidade_empresa.disabled = false;
        telefone_empresa.disabled = false;
        celular_empresa.disabled = false;
        email_empresa.disabled = false;
        btn_dados_empresariais.disabled = false;
    }
    else{
        cnpj_empresa.disabled = true;
        nome_empresa.disabled = true;
        cep_empresa.disabled = true;
        estado_empresa.disabled = true;
        endereco_empresa.disabled = true;
        numero_empresa.disabled = true;
        bairro_empresa.disabled = true;
        cidade_empresa.disabled = true;
        telefone_empresa.disabled = true;
        celular_empresa.disabled = true;
        email_empresa.disabled = true;
        btn_dados_empresariais.disabled = true;
    }
  
    btn_dados_empresariais.addEventListener('click', function(event){
        event.preventDefault();
        estado_empresa = estado_empresa.options[estado_empresa.selectedIndex].value;      
        
        if(cnpj_empresa.value == '' || nome_empresa.value == '' || cep_empresa.value == '' || estado_empresa == '' || endereco_empresa.value == '' || numero_empresa.value == '' || bairro_empresa.value == '' || cidade_empresa.value == '' || celular_empresa.value == '' || email_empresa.value == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha todos os campos para alterar os dados empresariais!',
                confirmButtonText: 'Ok'
            });
        
        }else if(telefone_empresa.value.length < 13){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'O telefone deve ter no mínimo 13 caracteres!',
                confirmButtonText: 'Ok'
            });
        
        }else if(celular_empresa.value.length < 14){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'O celular deve ter no mínimo 14 caracteres!',
                confirmButtonText: 'Ok'
            });
        
        }else if(!validaEmail()){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'O email informado não é válido!',
                confirmButtonText: 'Ok'
            });
        }else{
            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente salvar os dados empresariais?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if(result.value){
                    let form = document.getElementById('form_dados_empresariais');
                    form.method = 'POST';
                    form.action = 'dados_empresariais_controller.php'
                    form.submit();
                }
            })
        }
    }); 
}

/*
Função para preencher os campos com os valores do CEP. Irá pegar o valor do CEP e preencher os campos com os valores do CEP.
Estou usando uma requisição da api VIACEP.
*/
function meu_callback(conteudo) {
    if (!('erro' in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('endereco_empresa').value = (conteudo.logradouro);
        document.getElementById('bairro_empresa').value = (conteudo.bairro);
        document.getElementById('cidade_empresa').value = (conteudo.localidade);
        document.getElementById('estado_empresa').value = (conteudo.uf);        
        document.getElementById('celular_empresa').value = ('('+conteudo.ddd+')');
        document.getElementById('telefone_empresa').value = ('('+conteudo.ddd+')');

    } else {
        Swal.fire('Oops...', 'CEP não encontrado!', 'error');
    }
}

//Quando o campo cep perde o foco.
function pesquisarCEP(valor) {

    //Nova variável "cep" somente com dígitos.
    let cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //expressão regular para validar o CEP.	
        let validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('endereco_empresa').value = "";
            document.getElementById('bairro_empresa').value = "";
            document.getElementById('cidade_empresa').value = "";
            document.getElementById('estado_empresa').value = "";
            document.getElementById('celular_empresa').value = "";
            document.getElementById('telefone_empresa').value = "";

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

//Verifica se CNPJ é válido
function validarCNPJ(cnpj) {

    let inputCNPJ = document.getElementById('cnpj_empresa');
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14){
        inputCNPJ.placeholder = 'CNPJ inválido!';
        inputCNPJ.value = "";
        return false;
    }
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999"){
        
        inputCNPJ.placeholder = 'CNPJ inválido!';
        inputCNPJ.value = "";
        return false;
     }
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2){
            pos = 9;
      }
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)){
        inputCNPJ.placeholder = 'CNPJ inválido!';
        inputCNPJ.value = "";
        return false;
    }
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2){
            pos = 9;
      }
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)){
          inputCNPJ.placeholder = 'CNPJ inválido!';
          inputCNPJ.value = "";
          return false;
    }      
    return true;
}

//Verifica se o email é válido
function validaEmail(){
    let email = document.getElementById("email_empresa").value;
    let reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(reg.test(email) == false) {
        return false;
    }else{
        return true;
    }
}

//Reseta a URL da página, removendo todo o conteudo que tiver após o ?
function resetURL() {
    const url = window.location.href;
    const resultado = url.split('?')[0];
    history.pushState(null, null, resultado);
}