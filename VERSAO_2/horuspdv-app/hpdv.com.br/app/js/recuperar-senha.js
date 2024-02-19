const btnRecuperarSenha = document.getElementById('btn-recuperar-senha');
btnRecuperarSenha.addEventListener('click', function () {
    let cpf = document.getElementById('cpf').value;
    let usuarioAcesso = document.getElementById('usuario-de-acesso').value;

    if (cpf === '' || usuarioAcesso === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    } else {
        // carregando de loading
        let loading = document.getElementById('loading');
        loading.innerHTML = '<div class="loader"></div>';
        loading.className = 'loader-container';
        loading.style.display = 'flex';
        // Swal.fire({
        //     icon: 'success',
        //     text: 'Link de recuperação de senha enviado para o e-mail cadastrado. O link é válido por 10 minutos.'
        // });
    }
});