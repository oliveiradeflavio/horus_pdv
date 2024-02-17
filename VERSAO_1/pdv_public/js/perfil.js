/*
checkbox para habilitar/desabilitar campos de perfil
se o checkbox estiver marcado, os campos devem ser habilitados para editar e inserir a nova senha e a senha antiga
se o checkbox estiver desmarcado, os campos devem ser desabilitados.
*/
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

//função que ativa o Label, irá abrir a janela para escolher a imagem
function selecionaImagem(){
    let input = document.getElementById("foto_perfil");
    let nome_arquivo = document.getElementById("nome-arquivo");

    input.addEventListener("change", function(){
        nome_arquivo.textContent = input.value;
    })
}
selecionaImagem();
