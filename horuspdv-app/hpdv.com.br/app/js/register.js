function display(modal) {
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

cellPhoneMask(cellPhoneMask(document.querySelector("#cellphone")))
telephoneMask(telephoneMask(document.querySelector("#telephone")))
cepMask(cepMask(document.querySelector("#cep")))
cpfMask(cpfMask(document.querySelector("#cpf")))
dateMask(dateMask(document.querySelector("#birth-date")))


const formAddNewClient = document.querySelector("#formAddNewClient");
formAddNewClient.addEventListener("submit", function (e) {
    e.preventDefault();

    let requiredInputs = [
        'customer-name',
        'cpf',
        'birth-date',
        'age',
        'cep',
        'city',
        'state',
        'address',
        'neighborhood',
        'number',
        'cellphone'
    ];

    let isValid = true;

    for (let i = 0; i < requiredInputs.length; i++) {
        let input = document.querySelector(`#${requiredInputs[i]}`);
        if (input.value == "") {
            isValid = false;
            break;
        }
    }

    if (!isValid) {
        Swal.fire({
            icon: 'error',
            html: `Preencha os campos obrigatórios, <br>
             eles estão identificados com *. <br><br>
             Verifique se preencheu corretamente os campos.`,
        });
    } else {

        let customer_name = document.querySelector('#customer-name').value;
        let cpf = document.querySelector('#cpf').value;
        let age = document.querySelector('#age').value;
        let email = document.querySelector('#email').value;

        if (customer_name.length < 3) {
            Swal.fire({
                icon: 'error',
                text: 'O nome do cliente deve ter no mínimo 3 caracteres'
            });
            return;
        }

        if (cpf.length < 14 || cpfValidation(cpf) == false) {
            Swal.fire({
                icon: 'error',
                text: 'CPF inválido'
            });
            return;
        }

        if (age === "") {
            Swal.fire({
                icon: 'error',
                text: 'Idade inválida'
            });
            return;
        }

        if (email != "") {
            if (emailValidation(document.querySelector('#email').value == false)) {
                Swal.fire({
                    icon: 'error',
                    text: 'E-mail inválido'
                });
                return;
            }
        }


        showLoading();

        let csrf_token = document.querySelector('input[name="csrf_token"]').value;
        let action = document.querySelector('input[name="action"]').value;

        newClientValues = {
            customer_name: document.querySelector('#customer-name').value,
            cpf: document.querySelector('#cpf').value,
            rg: document.querySelector('#rg').value,
            birth_date: document.querySelector('#birth-date').value,
            age: document.querySelector('#age').value,
            cep: document.querySelector('#cep').value,
            city: document.querySelector('#city').value,
            state: document.querySelector('#state').value,
            address: document.querySelector('#address').value,
            neighborhood: document.querySelector('#neighborhood').value,
            street_complement: document.querySelector('#street-complement').value,
            number: document.querySelector('#number').value,
            reference_point: document.querySelector('#reference-point').value,
            telephone: document.querySelector('#telephone').value,
            cellphone: document.querySelector('#cellphone').value,
            email: document.querySelector('#email').value,
            csrfToken: csrf_token,
            action: action
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/register_client_controller.php',
            async: true,
            data: newClientValues,

            success: function (response) {
                if (response.error) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: response.message
                    });
                } else {
                    hideLoading();
                    Swal.fire({
                        icon: 'success',
                        text: response.message
                    });
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao cadastrar cliente'
                });
            }
        });
    }
});