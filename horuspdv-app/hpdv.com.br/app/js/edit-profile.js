const btn_show_hidden_password = document.querySelector('.fa-eye-slash');
btn_show_hidden_password.addEventListener('click', function () {
    let input_password = document.querySelector('#oldPassword');
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
    let input_password = document.querySelector('#newPassword');
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


function cbChangePassword() {
    let chbox = document.getElementById('chboxChangePassword');
    let inputOldPassword = document.getElementById('oldPassword');
    let inputNewPassword = document.getElementById('newPassword');

    if (chbox.checked) {
        inputOldPassword.disabled = false;
        inputNewPassword.disabled = false;

        inputOldPassword.required = true;
        inputNewPassword.required = true;

        inputNewPassword.value = '';
        inputOldPassword.value = '';
    } else {
        inputOldPassword.disabled = true;
        inputNewPassword.disabled = true;

        inputOldPassword.required = false;
        inputNewPassword.required = false;

        inputNewPassword.value = '';
        inputOldPassword.value = '';

        inputOldPassword.type = 'password';
        inputNewPassword.type = 'password';

        btn_show_hidden_repeat_password.classList.remove('fa-eye');
        btn_show_hidden_repeat_password.classList.add('fa-eye-slash-repeat');

        btn_show_hidden_password.classList.remove('fa-eye');
        btn_show_hidden_password.classList.add('fa-eye-slash');

    }
}

const formEditProfile = document.getElementById('formEditProfile');
formEditProfile.addEventListener('submit', function (e) {
    e.preventDefault();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email');
    let oldPassword = document.getElementById('oldPassword').value;
    let newPassword = document.getElementById('newPassword').value;
    let statusChangePassword = document.getElementById('chboxChangePassword');
    let csrf_token = document.querySelector('input[name="csrf_token"]').value;

    if (statusChangePassword.checked) {
        if (oldPassword === '' || newPassword === '') {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'Para alterar a senha, preencha os campos de senha antiga e nova senha.',
            })
        }

        if (oldPassword.length < 6 || newPassword.length < 6) {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'A senha deve ter no mínimo 6 caracteres.',
            })
        }

        if (email.value === '' || name === '' || name.length < 2) {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'Preencha todos os campos.',
            })
        }

        if (!emailValidation(email.value)) {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'E-mail inválido.',
            })
        }

        else {

            showLoading();

            accessCredentials = {
                name: name,
                email: email.value,
                oldPassword: oldPassword,
                newPassword: newPassword,
                csrfToken: csrf_token,
                statusChangePassword: statusChangePassword.checked
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controllers/edit_profile_controller.php',
                async: true,
                data: accessCredentials,

                success: function (response) {
                    if (response.error) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                        })
                    }
                    if (response.success) {
                        hideLoading();
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                        })
                    }
                },
                error: function (response) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao tentar alterar os dados.',
                    })
                }
            });

        }
    } else {
        if (email === '' || name === '' || name.length < 2) {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'Preencha todos os campos.',
            })
        }

        if (!emailValidation(email.value)) {
            Swal.fire({
                icon: 'error',
                title: "Atenção!",
                text: 'E-mail inválido.',
            })
        }

        else {

            showLoading();

            accessCredentials = {
                name: name,
                email: email.value,
                csrfToken: csrf_token,
                statusChangePassword: statusChangePassword.checked
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controllers/edit_profile_controller.php',
                async: true,
                data: accessCredentials,

                success: function (response) {
                    if (response.error) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                        })
                    }
                    if (response.success) {
                        hideLoading();
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                        })
                    }
                },
                error: function (response) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao tentar alterar os dados.',
                    })
                }
            });

        }
    }
});


