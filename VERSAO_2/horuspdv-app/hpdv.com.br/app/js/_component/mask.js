// máscara para o campo de CPF
function cpfMask(cpf) {
    $(cpf).mask('000.000.000-00', { reverse: true });
    return cpf;

}