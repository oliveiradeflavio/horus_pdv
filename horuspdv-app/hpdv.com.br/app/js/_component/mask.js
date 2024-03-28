// máscara para o campo de CPF
function cpfMask(cpf) {
    $(cpf).mask('000.000.000-00', { reverse: true });
    return cpf;
}

//mascara de celular
function cellPhoneMask(phone) {
    $(phone).mask('(00) 00000-0000');
    return phone;
}

//mascara de telefone
function telephoneMask(phone) {
    $(phone).mask('(00) 0000-0000');
    return phone;
}

function cepMask(cep) {
    $(cep).mask('00000-000');
    return cep;
}

function dateMask(date) {
    $(date).mask('00/00/0000', { reverse: true });
    return date;
}

//Máscara para campo onde somente será permitido a digitação de texto (campos como nome, sobrenome, etc)
$('.text_only').on('keypress', function (e) {
    const str = (e.keyCode ? e.keyCode : e.which);
    if (str > 64 && str < 91 || str > 96 && str < 123 || str == 32 || str > 192 && str < 223 || str > 224 && str < 255) {
        return true;
    }
    e.preventDefault();
    return false;
});