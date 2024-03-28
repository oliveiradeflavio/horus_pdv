//validação de cpf
function cpfValidation(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    // Elimina CPFs invalidos conhecidos	
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
    // Valida 1o digito	
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito	
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

//validação de email
function emailValidation(email) {
    let re = /\S+@\S+\.\S+/;
    return re.test(email);
}

//validação data de nascimento
function birthDateValidation(date_id) {
    const birthDateInput = document.querySelector(`#${date_id}`);

    const ageInput = document.querySelector("#age");

    //remover a formatação da dadata (dd/mm/yyyy) para (yyyymmdd)
    const birthDateValue = birthDateInput.value.split('/').reverse().join('-');

    if (isNaN(Date.parse(birthDateValue))) {
        if (birthDateInput.value === "") {
            ageInput.value = "";
            return false;
        }
    } else {
        if (birthDateInput.value === "") {
            ageInput.value = "";
            return false;
        } else {

            //calculo da idade
            const today = new Date();
            const birthDateSplit = birthDateValue.split('-'); //split para separar o ano, mês e dia
            const birhDateObj = new Date(birthDateSplit[0], birthDateSplit[1] - 1, birthDateSplit[2]); //cria um objeto com a data de nascimento
            let age = today.getFullYear() - birhDateObj.getFullYear(); //calculo da idade

            //se a data de nascimento ainda não ocorreu, subtrai 1 da idade
            if (today.getMonth() < birhDateObj.getMonth() || (today.getMonth() === birhDateObj.getMonth() && today.getDate() < birhDateObj.getDate())) {
                age--;
            }

            //esse tá vivendo bem mais que a média
            if (age > 130) {
                ageInput.value = "";
                return false;
            }

            //peenchendo o campo de idade
            ageInput.value = age;
            return true;
        }
    }
}

//VIACEP API
function getAddressByCep(cepValue) {

    let cep = cepValue.replace(/\D/g, ''); //remove tudo que não for número

    if (cep != "") {

        //validando o cep
        let validateCep = /^[0-9]{8}$/;

        if (validateCep.test(cep)) {

            showLoading();

            //criar um elemento js
            let elementJs = document.createElement("script");

            //adiciona o elemento js ao body
            elementJs.src = `https://viacep.com.br/ws/${cep}/json/?callback=fillAddress`;

            //adiciona o elemento js ao body
            document.body.appendChild(elementJs);

        } else {
            Swal.fire({
                icon: 'error',
                text: 'CEP inválido',
            });
        }
    } else {
        Swal.fire({
            icon: 'error',
            text: 'Campo CEP não pode estar vazio',
        });
    }
}

function fillAddress(value) {
    if (!("erro" in value)) {
        document.querySelector("#address").value = value.logradouro;
        document.querySelector("#neighborhood").value = value.bairro;
        document.querySelector("#city").value = value.localidade;
        document.querySelector("#state").value = value.uf;
    } else {
        Swal.fire({
            icon: 'error',
            text: 'CEP não encontrado',
        });
    }
    hideLoading();
}

