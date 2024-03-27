// máscara para o campo de CPF
function cpfMask(cpf) {
    $(cpf).mask('000.000.000-00', { reverse: true });
    return cpf;
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