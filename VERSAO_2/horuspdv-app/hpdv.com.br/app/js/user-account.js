$('#select_delete_user').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});
$('#select_user_permission').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

cpfMask(cpfMask(document.querySelector('#cpf')));


const formNewUser = document.getElementById('formNewUser');
formNewUser.addEventListener('submit', function (e) {
    e.preventDefault();

    let cpf = document.getElementById('cpf').value;
    let cpf_replace = cpf.replace(/\D/g, '');
    let name = document.getElementById('customer-client').value;
    let email = document.getElementById('email');
    let user_access = document.getElementById('user-access').value;

    if (cpf === '' || name === '' || email.value === '' || user_access === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    }

    if (cpf.length < 11 || cpf.length > 14 || !cpfValidation(cpf_replace)) {
        Swal.fire({
            icon: 'warning',
            text: 'CPF inválido'
        })
    }

    if (!emailValidation(email)) {
        Swal.fire({
            icon: 'warning',
            text: 'Email inválido'
        })
    }
});

