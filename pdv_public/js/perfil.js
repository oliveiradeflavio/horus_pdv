//checkbox para habilitar/desabilitar campos de perfil
function habilitarTrocaSenha() {
    let checkbox = document.getElementById('checkbox_perfil_alterar_senha');
    let campo_antiga_senha = document.getElementById('antiga_senha_usuario');
    let campo_nova_senha = document.getElementById('nova_senha_usuario');

    if (checkbox.checked) {
        campo_antiga_senha.disabled = false;
        campo_nova_senha.disabled = false;

        campo_antiga_senha.required = true;
        campo_nova_senha.required = true;
        return true
    } else {
        campo_antiga_senha.disabled = true;
        campo_nova_senha.disabled = true;
        return false
    }
}
