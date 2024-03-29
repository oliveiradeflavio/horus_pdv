function display(modal) {
    clearInputs();
    let exibirModal = document.getElementById(modal);
    const form = document.querySelector("#formUpdateClient");
    if (form) {
        form.setAttribute("id", "formAddNewClient");
        form.querySelector("#btnSend").innerHTML = "Salvar";
        form.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
    }

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
rgMask(rgMask(document.querySelector("#rg")))
dateMask(dateMask(document.querySelector("#birth-date")))

const formAddNewClient = document.querySelector("#formAddNewClient");
formAddNewClient.addEventListener("submit", function (e) {
    e.preventDefault();

    if (validateInputs()) {

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
                    }).then((result) => {
                        if (result.isConfirmed) {
                            clearInputs();
                        }
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

const blockModalSearch = document.querySelector("#modal-search-client");
const formSearchClient = document.querySelector("#formSearchClient");
blockModalSearch.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        if (document.querySelector("#search-client").value === "") {
            e.preventDefault();
        }
    }
})
formSearchClient.addEventListener("submit", function (e) {
    e.preventDefault();

    let valueSearch = document.querySelector("#search-client").value;
    let action = document.querySelector('input[name="action_search"]').value;
    let csrf_token = document.querySelector('input[name="csrf_token_search"]').value;
    let result_search_table = document.querySelector("#result-search");
    let table_responsive = document.querySelector(".table-responsive");

    if (valueSearch != "") {
        showLoading();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/register_client_controller.php',
            async: true,
            data: {
                valueSearch: valueSearch,
                action: action,
                csrfToken: csrf_token
            },
            success: function (response) {
                hideLoading();
                if (response.error) {
                    clearInputs();
                    Swal.fire({
                        icon: 'error',
                        text: response.message,
                        allowOutsideClick: false
                    });
                }
                else {
                    showLoading();
                    table_responsive.classList.remove("d-none");
                    result_search_table.innerHTML = "";
                    let thead = document.createElement("thead");
                    thead.classList.add("text-center");
                    let tr = document.createElement("tr");
                    let th = document.createElement("th");

                    result_search_table.appendChild(thead);

                    th.setAttribute("scope", "col");
                    th.innerHTML = "Nome";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "CPF";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Ações";
                    tr.appendChild(th);

                    thead.appendChild(tr);

                    let tbody = document.createElement("tbody");

                    for (let i = 0; i < response.length; i++) {
                        //objeto cliente
                        let clientObj = {
                            id: response[i].id,
                            name: response[i].nome,
                            cpf: response[i].cpf,
                            rg: response[i].rg,
                            birth_date: response[i].data_nascimento,
                            age: response[i].idade,
                            cep: response[i].cep,
                            city: response[i].cidade,
                            state: response[i].uf,
                            address: response[i].endereco,
                            neighborhood: response[i].bairro,
                            street_complement: response[i].complemento,
                            number: response[i].numero,
                            reference_point: response[i].ponto_referencia,
                            telephone: response[i].telefone,
                            cellphone: response[i].celular,
                            email: response[i].email
                        }

                        tr = document.createElement("tr");
                        let td = document.createElement("td");

                        td.innerHTML = clientObj.name;
                        tr.appendChild(td);
                        td = document.createElement('td')

                        td.innerHTML = clientObj.cpf;
                        tr.appendChild(td);

                        let icon_edit = document.createElement("i");
                        icon_edit.setAttribute("class", "fas fa-edit");
                        icon_edit.style.cursor = "pointer";
                        icon_edit.addEventListener("click", function () {
                            // fechar o modal da pesquisa
                            $('#modal-search-client').modal('hide');
                            //abrir o modal de cadastro
                            display('modal-cad-client');

                            const btnUpdate = document.querySelector('#btnSend');
                            btnUpdate.innerHTML = "Alterar";
                            btnUpdate.setAttribute("class", "btn btn-warning");

                            const formUpdateClient = document.querySelector('#formAddNewClient')
                            formUpdateClient.setAttribute("id", "formUpdateClient");

                            //preencher os campos do modal de cadastro
                            document.querySelector('#customer-name').value = clientObj.name;
                            document.querySelector('#cpf').value = clientObj.cpf;
                            document.querySelector('#rg').value = clientObj.rg;
                            document.querySelector('#birth-date').value = clientObj.birth_date;
                            document.querySelector('#age').value = clientObj.age;
                            document.querySelector('#cep').value = clientObj.cep;
                            document.querySelector('#city').value = clientObj.city;
                            document.querySelector('#state').value = clientObj.state;
                            document.querySelector('#address').value = clientObj.address;
                            document.querySelector('#neighborhood').value = clientObj.neighborhood;
                            document.querySelector('#street-complement').value = clientObj.street_complement;
                            document.querySelector('#number').value = clientObj.number;
                            document.querySelector('#reference-point').value = clientObj.reference_point;
                            document.querySelector('#telephone').value = clientObj.telephone;
                            document.querySelector('#cellphone').value = clientObj.cellphone;
                            document.querySelector('#email').value = clientObj.email;

                            formUpdateClient.addEventListener("submit", function (e) {
                                e.preventDefault();

                                if (validateInputs()) {

                                    showLoading();

                                    let action = document.querySelector('input[name="action"]').value = 'update';
                                    let csrf_token = document.querySelector('input[name="csrf_token"]').value;
                                    let id = clientObj.id;

                                    newClientValues = {
                                        id: id,
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
                                                    text: response.message,
                                                    allowOutsideClick: false
                                                });
                                            } else {
                                                hideLoading();
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: response.message,
                                                    allowOutsideClick: false
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        clearInputs();
                                                        document.querySelector("#formSearchClient").submit();
                                                    }
                                                });
                                            }
                                        },
                                        error: function (response) {
                                            hideLoading();
                                            Swal.fire({
                                                icon: 'error',
                                                text: 'Erro ao atualizar cliente',
                                                allowOutsideClick: false
                                            });
                                        }
                                    });
                                }

                            });
                        });

                        td = document.createElement("td");
                        td.appendChild(icon_edit);
                        tr.appendChild(td);

                        let icon_delete = document.createElement("i");
                        icon_delete.setAttribute("class", "fas fa-trash-alt");
                        icon_delete.style.cursor = "pointer";
                        icon_delete.setAttribute("data-id", clientObj.id);
                        icon_delete.addEventListener("click", function () {
                            deleteClient(id = this.getAttribute("data-id"));
                        });

                        td = document.createElement("td");
                        td.appendChild(icon_delete);
                        tr.appendChild(td);

                        tbody.appendChild(tr);

                    }
                    result_search_table.appendChild(tbody);
                    hideLoading();
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao buscar cliente',
                    allowOutsideClick: false
                });
            }
        });
    }

});

function deleteClient(id) {
    Swal.fire({
        icon: 'warning',
        text: 'Deseja realmente excluir esse cliente?',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controllers/register_client_controller.php',
                async: true,
                data: {
                    id: id,
                    action: 'delete',
                    csrfToken: document.querySelector('input[name="csrf_token_search"]').value
                },
                success: function (response) {
                    hideLoading();
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            allowOutsideClick: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.querySelector("#formSearchClient").submit();
                            }
                        });
                    }
                },
                error: function (response) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao excluir cliente',
                        allowOutsideClick: false
                    });
                }
            });
        }
    });
}


function validateInputs() {

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
            allowOutsideClick: false
        });
        return false;
    } else {

        let customer_name = document.querySelector('#customer-name').value;
        let cpf = document.querySelector('#cpf').value;
        let age = document.querySelector('#age').value;
        let email = document.querySelector('#email').value;

        if (customer_name.length < 3) {
            Swal.fire({
                icon: 'error',
                text: 'O nome do cliente deve ter no mínimo 3 caracteres',
                allowOutsideClick: false
            });
            return false;
        }

        if (cpf.length < 14 || cpfValidation(cpf) == false) {
            Swal.fire({
                icon: 'error',
                text: 'CPF inválido',
                allowOutsideClick: false
            });
            return false;
        }

        if (age === "") {
            Swal.fire({
                icon: 'error',
                text: 'Idade inválida',
                allowOutsideClick: false
            });
            return false;
        }

        if (email != "") {
            if (emailValidation(document.querySelector('#email').value == false)) {
                Swal.fire({
                    icon: 'error',
                    text: 'E-mail inválido',
                    allowOutsideClick: false
                });
                return;
            }
        }
        return true;
    }
}

function clearInputs() {
    url_page = window.location.href;
    url_page = url_page.split('#')[0];
    url_page = url_page.split('/web/')[1];
    if (url_page === "cadastro-cliente") {
        let inputs = [
            'customer-name', 'cpf', 'rg', 'birth-date', 'age', 'cep', 'city', 'state', 'address',
            'neighborhood', 'street-complement', 'number', 'reference-point', 'telephone', 'cellphone', 'email', "search-client"
        ]
        for (let i = 0; i < inputs.length; i++) {
            document.querySelector(`#${inputs[i]}`).value = "";
        }
    }
}