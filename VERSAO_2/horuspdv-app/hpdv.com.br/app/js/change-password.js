function changePassword(atrribute, value) {
    let newPassword = document.getElementById('newPassword').value;
    let repeatPassword = document.getElementById('repeatPassword').value;

    if (newPassword === '' || repeatPassword === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    }

    if (newPassword.length < 6 || repeatPassword.length < 6) {
        Swal.fire({
            icon: 'warning',
            text: 'A senha deve conter no mínimo 6 caracteres'
        });
        return;
    }

    if (newPassword !== repeatPassword) {
        Swal.fire({
            icon: 'warning',
            text: 'As senhas não conferem'
        });
        return;
    }

    else {
        showLoading();

        accessCredentials = {
            newPassword: newPassword,
            repeatPassword: repeatPassword,
            atrribute: atrribute,
            value: value
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/change_password_controller.php',
            async: true,
            data: accessCredentials,

            success: function (response) {
                if (response.error) {
                    hideLoading();
                    console.log(response);
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
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "login";
                        }
                    });

                }
            },
            error: function (response) {
                hideLoading();
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao alterar senha'
                });
            }

        });
    }
}

const btn_show_hidden_password = document.querySelector('.fa-eye-slash');
btn_show_hidden_password.addEventListener('click', function () {
    let input_password = document.querySelector('#newPassword');
    if (input_password.type == 'password') {
        input_password.type = 'text';
        btn_show_hidden_password.classList.remove('fa-eye-slash');
        btn_show_hidden_password.classList.add('fa-eye');
    } else {
        input_password.type = 'password';
        btn_show_hidden_password.classList.remove('fa-eye');
        btn_show_hidden_password.classList.add('fa-eye-slash');
    }
});

const btn_show_hidden_repeat_password = document.querySelector('.fa-eye-slash-repeat');
btn_show_hidden_repeat_password.addEventListener('click', function () {
    let input_password = document.querySelector('#repeatPassword');
    if (input_password.type == 'password') {
        input_password.type = 'text';
        btn_show_hidden_repeat_password.classList.remove('fa-eye-slash-repeat');
        btn_show_hidden_repeat_password.classList.add('fa-eye');
    } else {
        input_password.type = 'password';
        btn_show_hidden_repeat_password.classList.remove('fa-eye');
        btn_show_hidden_repeat_password.classList.add('fa-eye-slash-repeat');
    }
});