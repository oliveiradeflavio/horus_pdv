//mascaras input
$(document).ready(function () {
    $('#inputCelular').mask('(00)00000-0000');
    $('#inputCEP').mask('00000-000');
    $('#inputCPF').mask('000.000.000-00');
    $('#inputTelefone').mask('(00)0000-0000');

    $('#inputNome').on('keypress', function (e) {
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('#inputCidade').on('keypress', function (e) {
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('#inputBairro').on('keypress', function (e) {
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
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
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('#inputNomeFantasia').on('keypress', function (e) {
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
            return true;
        }

        e.preventDefault();
        return false;
    });

});

//PÁGINA DE PRODUTOS
$(document).ready(function () {
    //campo somente numeros
    $('#inputQuantidade').on('keypress', function (e) {
        let str = (e.keyCode ? e.keyCode : e.which);
        if (str > 47 && str < 58) {
            return true;
        }else{
            return (str == 8 || str == 0)?true:false;
        }
    });

    $('#inputPrecoUnitario').mask('R$ #.##0,00', {reverse: true});
    $('#inputPrecoTotal').mask('R$ #.##0,00');

});  
//fim mascaras input

//Quando os campos quantidade e preço unitário for preenchidos, o valor total será calculado automaticamente e atribuido no campo preço total.
function somaPrecoTotalCadastro(){

    let inputPrecoUnitario = document.getElementById("inputPrecoUnitario").value;
    let inputQuantidade = document.getElementById('inputQuantidade').value;
    let inputPrecoTotal = document.getElementById('inputPrecoTotal');

    inputPrecoUnitario = inputPrecoUnitario.replace(/[^0-9]/g, '');

    if (inputPrecoUnitario != '' && inputQuantidade != '') {
        inputPrecoTotal = parseFloat((inputPrecoUnitario) * inputQuantidade)
        inputPrecoTotal = inputPrecoTotal + '';
        inputPrecoTotal = parseInt(inputPrecoTotal.replace(/[\D]+/g, ''));
        inputPrecoTotal = inputPrecoTotal + '';
        inputPrecoTotal = inputPrecoTotal.replace(/([0-9]{2})$/g, ",$1");

        if (inputPrecoTotal.length > 6) {
            inputPrecoTotal = inputPrecoTotal.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

        inputPrecoTotal.value = inputPrecoTotal;
        if(inputPrecoTotal == 'NaN') inputPrecoTotal.value = ''
    
        document.getElementById('inputPrecoTotal').value = inputPrecoTotal;

    }
}

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

//Verifica se CNPJ é válido
function validarCNPJ(cnpj) {

    let inputCNPJ = document.getElementById('inputCNPJ');
 
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
    let email = document.getElementById("inputEmail").value;
    let reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(reg.test(email) == false) {
        return false;
    }else{
        return true;
    }
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
        document.getElementById('inputTelefone').value = (conteudo.ddd);

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
            document.getElementById('inputTelefone').value = "...";

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

//validando a data de nascimento, pegando no formato aaaa/mm/dd e transformando para o formato dd/mm/aaaa. Precisa ser maior de 18 anos
function validaDataNascimento(dtnascimento) {
    inputDtNascimento = document.getElementById('inputDtNascimento')
    if (dtnascimento) {
        let data = dtnascimento
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
            inputDtNascimento.placeholder = dtnascimento + ', idade mínima de 18 anos!';
            inputDtNascimento.value = "";
            return false;
        }

        return true;
    }
}

//Validação de campos no momento de cadastro de cliente. Se todos os campos estiverem preenchidos, o form será disparado para o controller.
function validaCampos() {
    let inputNome = document.getElementById('inputNome');
    let inputCPF = document.getElementById('inputCPF');
    let inputDtNascimento = document.getElementById('inputDtNascimento');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputNumero = document.getElementById('inputNumero');
    let inputBairro = document.getElementById('inputBairro');
    let inputCidade = document.getElementById('inputCidade');
    let inputEstado = document.getElementById('inputEstado');
    let inputCelular = document.getElementById('inputCelular');
    let formCadCliente = document.getElementById('formCadCliente');

    if (inputNome.value == "") {
        Swal.fire('Oops...', 'Nome não informado!', 'error');

    }
    else if (inputCPF.value == "") {
        Swal.fire('Oops...', 'CPF não informado!', 'error');

    }
    else if (inputDtNascimento.value == "") {
        Swal.fire('Oops...', 'Data de nascimento não informada!', 'error');
    
    }
    else if (inputCEP.value == "") {
        Swal.fire('Oops...', 'CEP não informado!', 'error');

    }
    else if (inputEndereco.value == "") {
        Swal.fire('Oops...', 'Endereço não informado!', 'error');

    }
    else if(inputNumero.value == "" || inputNumero.value == "0"){
        Swal.fire('Oops...', 'Número do endereço não informado!', 'error');
    }
    else if (inputBairro.value == "" || inputBairro.value.length < 3) {
        Swal.fire('Oops...', 'Bairro não informado!', 'error');

    }
    else if (inputCidade.value == "" || inputCidade.value.length < 3) {
        Swal.fire('Oops...', 'Cidade não informada!', 'error');

    }
    else if (inputEstado.value == "") {
        Swal.fire('Oops...', 'Estado não informado!', 'error');

    }
    else if (inputCelular.value == "" || inputCelular.value.length < 14) {
        Swal.fire('Oops...', 'Verifique o campo celular!', 'error');

    }
    else{
        formCadCliente.method = "POST";
        formCadCliente.action = "cad_cliente_controller.php";
        formCadCliente.submit();
    }
}

//Validação de campos no cadastro de fornecedores
function validaCamposFornecedor(){
    let inputCNPJ = document.getElementById('inputCNPJ');
    let inputRazaoSocial = document.getElementById('inputRazaoSocial');
    let inputNomeFantasia = document.getElementById('inputNomeFantasia');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputNumero = document.getElementById('inputNumero');
    let inputBairro = document.getElementById('inputBairro');
    let inputCidade = document.getElementById('inputCidade');
    let inputEstado = document.getElementById('inputEstado');
    let inputTelefone = document.getElementById('inputTelefone');
    let inputCelular = document.getElementById('inputCelular'); 
    let formCadFornecedor = document.getElementById('formCadFornecedor');

    if (inputCNPJ.value == "") {
        Swal.fire('Oops...', 'CNPJ não informado!', 'error');
    }
    else if (inputRazaoSocial.value == "") {
        Swal.fire('Oops...', 'Razão social não informada!', 'error');
    }
    else if (inputNomeFantasia.value == "") {
        Swal.fire('Oops...', 'Nome fantasia não informado!', 'error');
    }
    else if (inputCEP.value == "") {
        Swal.fire('Oops...', 'CEP não informado!', 'error');
    }
    else if (inputEndereco.value == "") {
        Swal.fire('Oops...', 'Endereço não informado!', 'error');
    }
    else if(inputNumero.value == "" || inputNumero.value == "0"){
        Swal.fire('Oops...', 'Número do endereço não informado!', 'error');
    }
    else if (inputBairro.value == "" || inputBairro.value.length < 3) {
        Swal.fire('Oops...', 'Bairro não informado!', 'error');
    }
    else if (inputCidade.value == "" || inputCidade.value.length < 3) {
        Swal.fire('Oops...', 'Cidade não informada!', 'error');
    }
    else if (inputEstado.value == "") {
        Swal.fire('Oops...', 'Estado não informado!', 'error');
    }
    else if (inputTelefone.value == "" || inputTelefone.value.length < 13) {
        Swal.fire('Oops...', 'Verifique o campo telefone!', 'error');
    }
    else if (inputCelular.value == "" || inputCelular.value.length < 14) {
        Swal.fire('Oops...', 'Verifique o campo celular!', 'error');
    }
    else if (!validaEmail()) {
        Swal.fire('Oops...', 'Verifique o campo email!', 'error');
    }
    else{
        formCadFornecedor.method = "POST";
        formCadFornecedor.action = "cad_fornecedor_controller.php?acao=inserir";
        formCadFornecedor.submit();
    }
}

//Valida campos na página de cadastro de produtos
function validaCamposProdutos(){
    let inputNomeProduto = document.getElementById('inputNomeProduto');
    let inputCodigo = document.getElementById('inputCodigo');
    let inputDescricao = document.getElementById('inputDescricaoProduto');
    let inputQuantidade = document.getElementById('inputQuantidade');
    let inputPrecoUnitario = document.getElementById('inputPrecoUnitario');
    let inputPrecoTotal = document.getElementById('inputPrecoTotal');
    let formCadProduto = document.getElementById('formCadProduto');

    if (inputNomeProduto.value == "") {
        Swal.fire('Oops...', 'Nome do produto não informado!', 'error');
    }
    else if (inputCodigo.value == "") {
        Swal.fire('Oops...', 'Código do produto não informado!', 'error');
    }
    else if (inputDescricao.value == "") {
        Swal.fire('Oops...', 'Descrição do produto não informada!', 'error');
    }
    else if (inputQuantidade.value == "") {
        Swal.fire('Oops...', 'Quantidade do produto não informada!', 'error');
    }
    else if (inputPrecoUnitario.value == "") {
        Swal.fire('Oops...', 'Preço unitário do produto não informado!', 'error');
    }
    else if (inputPrecoTotal.value == "") {
        Swal.fire('Oops...', 'Preço total do produto não informado!', 'error');
    }
    else{
        formCadProduto.method = "POST";
        formCadProduto.enctype = "multipart/form-data";
        formCadProduto.action = "cad_produto_controller.php?acao=inserir";
        formCadProduto.submit();
    }
}

//Função para validar a alteração do cliente. Basicamente é a mesma função da validação do cadastro
function validaAlteracao() {
    let inputNome = document.getElementById('inputNome');
    let inputCPF = document.getElementById('inputCPF');
    let inputDtNascimento = document.getElementById('inputDtNascimento');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputNumero = document.getElementById('inputNumero');
    let inputBairro = document.getElementById('inputBairro');
    let inputCidade = document.getElementById('inputCidade');
    let inputEstado = document.getElementById('inputEstado');
    let inputCelular = document.getElementById('inputCelular');

    if (inputNome.value == "") {
        Swal.fire('Oops...', 'Nome não informado!', 'error');
        return false;

    }
    else if (inputCPF.value == "") {
        Swal.fire('Oops...', 'CPF não informado!', 'error');
        return false;

    }
    else if (inputDtNascimento.value == "") {
        Swal.fire('Oops...', 'Data de nascimento não informada!', 'error');
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
    else if(inputNumero.value == "" || inputNumero.value == "0"){
        Swal.fire('Oops...', 'Número do endereço não informado!', 'error');
        return false;
    }
    else if (inputBairro.value == "" || inputBairro.value.length < 3) {
        Swal.fire('Oops...', 'Bairro não informado!', 'error');
        return false;

    }
    else if (inputCidade.value == "" || inputCidade.value.length < 3) {
        Swal.fire('Oops...', 'Cidade não informada!', 'error');
        return false;

    }
    else if (inputEstado.value == "") {
        Swal.fire('Oops...', 'Estado não informado!', 'error');
        return false;

    }
    else if (inputCelular.value == "" || inputCelular.value.length < 14) {
        Swal.fire('Oops...', 'Verifique o campo celular!', 'error');
        return false;

    }
    else{
       return true; 
    }

}

//Função para validar a alteração de fornecedor. Basicamente é a mesma função da validação do cadastro
function validaAlteracaoFornecedores(){
    let inputCNPJ = document.getElementById('inputCNPJ');
    let inputRazaoSocial = document.getElementById('inputRazaoSocial');
    let inputNomeFantasia = document.getElementById('inputNomeFantasia');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputNumero = document.getElementById('inputNumero');
    let inputBairro = document.getElementById('inputBairro');
    let inputCidade = document.getElementById('inputCidade');
    let inputEstado = document.getElementById('inputEstado');
    let inputTelefone = document.getElementById('inputTelefone');
    let inputCelular = document.getElementById('inputCelular'); 

    if (inputCNPJ.value == "") {
        Swal.fire('Oops...', 'CNPJ não informado!', 'error');
        return false;
    }
    else if (inputRazaoSocial.value == "") {
        Swal.fire('Oops...', 'Razão social não informada!', 'error');
        return false;
    }
    else if (inputNomeFantasia.value == "") {
        Swal.fire('Oops...', 'Nome fantasia não informado!', 'error');
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
    else if(inputNumero.value == "" || inputNumero.value == "0"){
        Swal.fire('Oops...', 'Número do endereço não informado!', 'error');
        return false;
    }
    else if (inputBairro.value == "" || inputBairro.value.length < 3) {
        Swal.fire('Oops...', 'Bairro não informado!', 'error');
        return false;
    }
    else if (inputCidade.value == "" || inputCidade.value.length < 3) {
        Swal.fire('Oops...', 'Cidade não informada!', 'error');
        return false;
    }
    else if (inputEstado.value == "") {
        Swal.fire('Oops...', 'Estado não informado!', 'error');
        return false;
    }
    else if (inputTelefone.value == "" || inputTelefone.value.length < 14) {
        Swal.fire('Oops...', 'Verifique o campo telefone!', 'error');
        return false;
    }
    else if (inputCelular.value == "" || inputCelular.value.length < 14) {
        Swal.fire('Oops...', 'Verifique o campo celular!', 'error');
        return false;
    }
    else{
        return true;
    }
}

//Função para mostrar as tabelas de clientes e fornecedores
function mostrarTabelaCadastros(){
    let el = document.getElementById('tabela_cad_clientes');
    let el_tb_fornecedores = document.getElementById('tabela_cad_fornecedores');

    if (el && el.style.display == 'none'){
        el.style.display = '';
        document.getElementById('txt_consultar').innerHTML = 'Ocultar tabela';

    }else if (el && el.style.display == ''){
        el.style.display = 'none';
        document.getElementById('txt_consultar').innerHTML = 'Consultar Clientes Cadastrados';

    }else if (el_tb_fornecedores && el_tb_fornecedores.style.display == 'none'){
        el_tb_fornecedores.style.display = '';
        document.getElementById('txt_consultar_fornecedores').innerHTML = 'Ocultar tabela';     
    }
    else if (el_tb_fornecedores && el_tb_fornecedores.style.display == ''){
        el_tb_fornecedores.style.display = 'none';
        document.getElementById('txt_consultar_fornecedores').innerHTML = 'Consultar Fornecedores Cadastrados';     
    }
}



//Função para excluir o cliente já cadastrado, passando o id do cliente como parâmetro e chamando o controller para excluir o cliente
//A função também é responsável por exibir um alerta de confirmação para o usuário antes de excluir o cliente pedindo uma senha master
function excluirCliente(id){
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Não, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Insira senha master para confirmar a exclusão!',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
            })
            .then((result) => {
            
                if (result.value) {
                    let pass = result.value;
                    location.href = "cad_cliente_controller.php?acao=excluir&id=" + id + "&p=" + pass;
                } 
            })            
        }
    })
}

//Excluindo o cliente da tabela de cadastro de clientes. Será acionado o botão Alterar e irá aparecer na página de cadastro de clientes
function editarCliente(id, cpf, nome, dt_nascimento, cep, endereco, numero, bairro, complemento, estado, cidade, celular){

    let btnCadastrarCliente = document.getElementById('btnCadastrarCliente');
    btnCadastrarCliente.disabled = true;
    
    let btnAlterarCliente = document.getElementById('btnAlterarCliente');
    btnAlterarCliente.style.display = 'inline';
    
    let formCadCliente = document.getElementById('formCadCliente');
    formCadCliente.setAttribute('action', 'cad_cliente_controller.php?acao=alterar&id=' + id);

    $('#inputCPF').val(cpf);
    $('#inputNome').val(nome);
    $('#inputDtNascimento').val(dt_nascimento);
    $('#inputCEP').val(cep);
    $('#inputEndereco').val(endereco);
    $('#inputNumero').val(numero);
    $('#inputBairro').val(bairro);
    $('#inputEnderecoComplemento').val(complemento);
    $('#inputEstado').val(estado);
    $('#inputCidade').val(cidade);
    $('#inputCelular').val(celular);

    btnAlterarCliente.onclick = function(){
        if(validaAlteracao()){
            formCadCliente.submit();
        }else{
            return false;
        }
    }
}

function excluirFornecedor(id){
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Não, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Insira senha master para confirmar a exclusão!',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
            })
            .then((result) => {
            
                if (result.value) {
                    let pass = result.value;
                    location.href = "cad_fornecedor_controller.php?acao=excluir&id=" + id + "&p=" + pass;
                } 
            })            
        }
    })
}

function editarFornecedor(id, cnpj, razao_social, nome_fantasia, cep, endereco, numero, bairro, complemtno, estado, cidade, telefone, celular, email){

    let btnCadastrarFornecedor = document.getElementById('btnCadastrarFornecedor');
    btnCadastrarFornecedor.disabled = true;
    
    let btnAlterarFornecedor = document.getElementById('btnAlterarFornecedor');
    btnAlterarFornecedor.style.display = 'inline';

    let formCadForcenedor = document.getElementById('formCadFornecedor');
    formCadForcenedor.setAttribute('action', 'cad_fornecedor_controller.php?acao=alterar&id=' + id);

    $('#inputCNPJ').val(cnpj);
    $('#inputRazaoSocial').val(razao_social);
    $('#inputNomeFantasia').val(nome_fantasia);
    $('#inputCEP').val(cep);
    $('#inputEndereco').val(endereco);
    $('#inputNumero').val(numero);
    $('#inputBairro').val(bairro);
    $('#inputEnderecoComplemento').val(complemtno);
    $('#inputEstado').val(estado);
    $('#inputCidade').val(cidade);
    $('#inputTelefone').val(telefone);
    $('#inputCelular').val(celular);
    $('#inputEmail').val(email);

    btnAlterarFornecedor.onclick = function(){
        if(validaAlteracaoFornecedores()){
            formCadForcenedor.submit();
        }else{
            return false;
        }
    }
}

//Função para limpar os campos quando o botão Cancelar é acionado, porém se o o usuário estiver alterando ele também irá limpar
// os campos e irá fazer um reload da página
function resetaCampos(){
    limpaCampos();
    let el_alterar_cliente = document.getElementById('btnAlterarCliente');
    let btn_cadatrar_cliente = document.getElementById('btnCadastrarCliente');

    let el_alterar_fornecedor = document.getElementById('btnAlterarFornecedor');
    let btn_cadastrar_fornecdor = document.getElementById('btnCadastrarFornecedor');

    if (el_alterar_cliente && el_alterar_cliente.style.display == 'inline' || btn_cadatrar_cliente && btn_cadatrar_cliente.disabled == true){
        document.location.reload();
    }
    if (el_alterar_fornecedor && el_alterar_fornecedor.style.display == 'inline' || btn_cadastrar_fornecdor && btn_cadastrar_fornecdor.disabled == true){
        document.location.reload();
    }
}

//Funcão irá limpar os campos do formulário de cadastro de clientes
function limpaCampos(){
    let inputCPF = document.getElementById('inputCPF');
    let inputNome = document.getElementById('inputNome');
    let inputDtNascimento = document.getElementById('inputDtNascimento');
    let inputCEP = document.getElementById('inputCEP');
    let inputEndereco = document.getElementById('inputEndereco');
    let inputNumero = document.getElementById('inputNumero');
    let inputBairro = document.getElementById('inputBairro');
    let inputComplemento = document.getElementById('inputEnderecoComplemento');
    let inputEstado = document.getElementById('inputEstado');
    let inputCidade = document.getElementById('inputCidade');
    let inputCelular = document.getElementById('inputCelular');
    
    let inputCNPJ = document.getElementById('inputCNPJ');
    let inputRazaoSocial = document.getElementById('inputRazaoSocial');
    let inputNomeFantasia = document.getElementById('inputNomeFantasia');
    let inputTelefone = document.getElementById('inputTelefone');
    let inputEmail = document.getElementById('inputEmail');

    if (inputCPF){
        inputCPF.value = '';
    }
    if (inputNome){
        inputNome.value = '';
    }
    if (inputDtNascimento){
        inputDtNascimento.value = '';
    }
    if (inputCEP){
        inputCEP.value = '';
    }
    if (inputEndereco){
        inputEndereco.value = '';
    }
    if (inputNumero){
        inputNumero.value = '';
    }
    if (inputBairro){
        inputBairro.value = '';
    }
    if (inputComplemento){
        inputComplemento.value = '';
    }
    if (inputEstado){
        inputEstado.value = '';
    }
    if (inputCidade){
        inputCidade.value = '';
    }
    if (inputCelular){
        inputCelular.value = '';
    }
    if (inputCNPJ){
        inputCNPJ.value = '';
    }
    if (inputRazaoSocial){
        inputRazaoSocial.value = '';
    }
    if (inputNomeFantasia){
        inputNomeFantasia.value = '';
    }
    if (inputTelefone){
        inputTelefone.value = '';
    }
    if (inputEmail){
        inputEmail.value = '';
    }

}

//Função de ajuda de como preencher os campos do cadadastro de clientes (crud) e também fazer a consulta. Para não dizer que não tem algo explicado
function ajuda_cad_cliente(){
    Swal.fire({
        title: 'Ajuda',
        text: 'Para cadastrar um novo cliente, preencha os campos corretamente e clique em cadastrar.\n\nPara alterar o cadastro de um cliente, clique no botão Alterar e preencha os campos corretamente.\n\nPara excluir um cliente, clique no botão Excluir e digite a senha master para confirmar a exclusão.\n\nVocê poderá consultar os clientes cadastrados clicando no texto Consultar.',
        icon: 'info',
        confirmButtonText: 'Fechar'
    })
}

    
