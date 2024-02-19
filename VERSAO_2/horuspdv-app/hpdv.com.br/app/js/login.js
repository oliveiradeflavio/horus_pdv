window.onload = function () {
    resetURL();
}

function resetURL() {
    const url = window.location.href;
    const resultado = url.split('?')[0];
    history.pushState(null, null, resultado);
}

const btn_mostra_oculta_senha = document.querySelector('.fa-eye-slash');
btn_mostra_oculta_senha.addEventListener('click', function () {
    let input_senha = document.querySelector('#password');
    if (input_senha.type == 'password') {
        input_senha.type = 'text';
        btn_mostra_oculta_senha.classList.remove('fa-eye-slash');
        btn_mostra_oculta_senha.classList.add('fa-eye');
    } else {
        input_senha.type = 'password';
        btn_mostra_oculta_senha.classList.remove('fa-eye');
        btn_mostra_oculta_senha.classList.add('fa-eye-slash');
    }
});

const formLogin = document.getElementById('form-login');
formLogin.addEventListener('submit', function (e) {
    e.preventDefault();

    let usuarioAcesso = document.getElementById('usuario-de-acesso').value;
    let senhaUsuario = document.getElementById('password').value;

    if (usuarioAcesso === '' || senhaUsuario === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    } else {
        console.log('Enviado form de login')
    }

});