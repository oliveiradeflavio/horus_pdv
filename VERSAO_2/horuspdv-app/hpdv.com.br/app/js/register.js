function exibir(modal) {
    let exibirModal = document.getElementById(modal);
    $(exibirModal).modal('show');
}

//preview  imagem no input, quando o usuário carregar uma image, logo irá aparecer uma prewiew da mesma
// define o evento de clique do span com o X
function excluirImagem() {
    document.getElementById("preview-img").src = "../assets/img/avatar/produto-sem-imagem.webp";
    document.getElementById("imagem-produto").value = "";
    if (document.querySelector("#excluir-img-preview")) {
        document.querySelector("#excluir-img-preview").style.display = "none";
    }
}

if (document.querySelector("#excluir-img-preview")) {
    document.querySelector("#excluir-img-preview").addEventListener("click", excluirImagem);
};

function readImage() {

    if (this.files && this.files[0]) {
        let file = new FileReader();
        file.onload = function (e) {
            document.getElementById("preview-img").src = e.target.result;
        };
        file.readAsDataURL(this.files[0]);

        document.querySelector("#excluir-img-preview").style.display = "flex";
        document.querySelector("#excluir-img-preview").innerHTML = "Remover imagem";

    }
}

if (document.getElementById("imagem-produto")) {
    document.getElementById("imagem-produto").addEventListener("change", readImage, false);
};

//função que ativa o Label, irá abrir a janela para escolher a imagem
function selecionaImagem() {
    let input = document.getElementById("imagem-produto");
    let nome_arquivo = document.getElementById("nome-arquivo");

    if (input != null && nome_arquivo != null) {
        input.addEventListener("change", function () {
            nome_arquivo.textContent = input.value;
        })
    }
}
selecionaImagem();


