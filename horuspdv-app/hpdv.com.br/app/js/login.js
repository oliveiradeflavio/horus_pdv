window.onload = function () {
    resetURL();
}

function resetURL() {
    const url = window.location.href;
    const resultado = url.split('?')[0];
    history.pushState(null, null, resultado);
}

const btn_show_hidden_password = document.querySelector('.fa-eye-slash');
btn_show_hidden_password.addEventListener('click', function () {
    let input_password = document.querySelector('#accessPassword');
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

const formLogin = document.getElementById('formLogin');
formLogin.addEventListener('submit', function (e) {
    e.preventDefault();

    let accessUser = document.getElementById('accessUser').value;
    let accessPassword = document.getElementById('accessPassword').value;
    let csrf_token = document.querySelector('input[name="csrf_token"]').value;

    if (accessUser === '' || accessPassword === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    } else {
        showLoading();

        accessCredentials = {
            accessUser: accessUser,
            accessPassword: accessPassword,
            csrfToken: csrf_token
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/login_controller.php',
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
                    window.location.href = 'home';
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao tentar fazer login. Veriquei a sua conexão com a internet e tente novamente.'
                })
            }
        });
    }

});