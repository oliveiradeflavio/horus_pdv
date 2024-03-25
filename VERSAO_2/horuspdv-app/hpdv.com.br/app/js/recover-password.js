cpfMask(document.querySelector('#cpf'));

const btnRecuperarSenha = document.getElementById('btnRecoverPassword');
btnRecuperarSenha.addEventListener('click', function () {
    let cpf = document.getElementById('cpf').value;
    let cpf_replace = cpf.replace(/\D/g, '');
    let accessUser = document.getElementById('accessUser').value;

    if (cpf === '' || accessUser === '') {
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
        });
        return;
    }
    else {
        showLoading();

        accessCredentials = {
            cpf: cpf,
            accessUser: accessUser
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/recover_password_controller.php',
            async: true,
            data: accessCredentials,

            success: function (response) {
                if (response.error) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: response.message
                    });
                }
                if (response.success) {
                    hideLoading();
                    Swal.fire({
                        icon: 'success',
                        text: response.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    });
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao recuperar senha'
                });
            }

        });
    }
});