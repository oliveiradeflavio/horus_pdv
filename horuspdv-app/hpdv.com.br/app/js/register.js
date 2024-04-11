function display(modal) {
    let exibirModal = document.getElementById(modal);
    const formUpdateClient = document.querySelector("#formUpdateClient");
    const formUpdateProvider = document.querySelector("#formUpdateProvider");
    const formUpdateProduct = document.querySelector("#formUpdateProduct");
    if (formUpdateClient) {
        clearInputs();
        formUpdateClient.setAttribute("id", "formAddNewClient");
        formUpdateClient.querySelector("#btnSend").innerHTML = "Salvar";
        formUpdateClient.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
    }

    if (formUpdateProvider) {
        clearInputs();
        formUpdateProvider.setAttribute("id", "formAddNewProvider");
        formUpdateProvider.querySelector("#btnSend").innerHTML = "Salvar";
        formUpdateProvider.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
    }

    if (formUpdateProduct) {
        clearInputs();
        formUpdateProduct.setAttribute("id", "formCadProduct");
        formUpdateProduct.querySelector("#btnSend").innerHTML = "Salvar";
        formUpdateProduct.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
    }

    $(exibirModal).modal('show');
}

// limpar os campos dos inputs das páginas
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
    if (url_page === "cadastro-fornecedor") {
        let inputs = [
            'company-name', 'fantasy-name', 'cnpj', 'cep', 'city', 'cep', 'city', 'state', 'address',
            'neighborhood', 'street-complement', 'number', 'reference-point', 'telephone', 'cellphone', 'email', "search-provider"
        ]
        for (let i = 0; i < inputs.length; i++) {
            document.querySelector(`#${inputs[i]}`).value = "";
        }
    }

    if (url_page === "cadastro-produto") {
        let inputs = [
            'product-name', 'product-code', 'product-supplier', 'product-description', 'product-qnt',
            'product-unit-price', 'product-sale-price', 'total-price-on-product', 'img-product', 'file-name', 'search-product'
        ]
        for (let i = 0; i < inputs.length; i++) {
            document.querySelector(`#${inputs[i]}`).value = "";
        }
        document.getElementById("preview-img").src = "../assets/img/products/produto-sem-imagem.webp";
        document.getElementById("delete-img-preview").style.display = "none";

    }
}


//validação dos campos de inputs da página de cadastro de cliente
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

// validar os campos inputs da página de fornecedor
function validateInputsProvider() {
    let requiredInputs = [
        'company-name',
        'fantasy-name',
        'cnpj',
        'cep',
        'city',
        'state',
        'address',
        'neighborhood',
        'number',
        'cellphone'
    ]

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
        let company_name = document.querySelector('#company-name').value;
        let fantasy_name = document.querySelector('#fantasy-name').value;
        let cnpj = document.querySelector('#cnpj').value;
        let email = document.querySelector('#email').value;

        if (company_name.length < 3) {
            Swal.fire({
                icon: 'error',
                text: 'O nome da empresa deve ter no mínimo 3 caracteres',
                allowOutsideClick: false
            });
            return false;
        }

        if (fantasy_name.length < 3) {
            Swal.fire({
                icon: 'error',
                text: 'O nome fantasia deve ter no mínimo 3 caracteres',
                allowOutsideClick: false
            });
            return false;
        }

        if (cnpj.length < 18 || cnpjValidation(cnpj) == false) {
            Swal.fire({
                icon: 'error',
                text: 'CNPJ inválido',
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

function validateInputsProduct() {
    let requiredInputs = [
        'product-name',
        'product-code',
        'product-supplier',
        'product-description',
        'product-qnt',
        'product-unit-price',
        'product-sale-price',
        'total-price-on-product',
    ]

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
        let product_name = document.querySelector('#product-name').value;
        let product_qnt = document.querySelector('#product-qnt');
        let product_supplier = document.querySelector('#product-supplier')
        product_supplier = product_supplier.options[product_supplier.selectedIndex];

        if (product_name.length < 3) {
            Swal.fire({
                icon: 'error',
                text: 'O nome do produto deve ter no mínimo 3 caracteres',
                allowOutsideClick: false
            });
            return false;
        }

        if (product_qnt.value < 1) {
            Swal.fire({
                icon: 'error',
                text: 'A quantidade do produto deve ser maior que 0',
                allowOutsideClick: false
            });
            return false;
        }

        if (product_supplier.value === "") {
            Swal.fire({
                icon: 'error',
                text: 'Selecione um fornecedor',
                allowOutsideClick: false
            });
            return false;
        }

        return true;
    }
}

// mascaras dos inputs da página de cadastro de cliente e fornecedor
cellPhoneMask(cellPhoneMask(document.querySelector("#cellphone")))
telephoneMask(telephoneMask(document.querySelector("#telephone")))
cepMask(cepMask(document.querySelector("#cep")))
cpfMask(cpfMask(document.querySelector("#cpf")))
rgMask(rgMask(document.querySelector("#rg")))
dateMask(dateMask(document.querySelector("#birth-date")))
cnpjMask(cnpjMask(document.querySelector("#cnpj")))

//mascaras dos inputs da página de cadastro de produto
unitPriceMask(unitPriceMask(document.querySelector("#product-unit-price")))
salePriceMask(salePriceMask(document.querySelector("#product-sale-price")))
priceTotalMask(priceTotalMask(document.querySelector("#total-price-on-product")))

// forms da pagina de cadastro de cliente
const formAddNewClient = document.querySelector("#formAddNewClient")
if (formAddNewClient) {
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
}

const blockModalSearch = document.querySelector("#modal-search-client");
const formSearchClient = document.querySelector("#formSearchClient");
if (blockModalSearch) {
    blockModalSearch.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            if (document.querySelector("#search-client").value === "") {
                e.preventDefault();
            }
        }
    })
}
if (formSearchClient) {
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
                                //formatando a data para o padrão brasileiro dd/mm/yyyy
                                let date = clientObj.birth_date.split("-");
                                let birth_date = date[2] + "/" + date[1] + "/" + date[0];
                                document.querySelector('#birth-date').value = birth_date;
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
}

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

//forms da página de fornecedor
const formAddNewProvider = document.querySelector("#formAddNewProvider");
if (formAddNewProvider) {

    formAddNewProvider.addEventListener("submit", function (e) {
        e.preventDefault();

        if (validateInputsProvider()) {
            showLoading();

            let csrf_token = document.querySelector('input[name="csrf_token"]').value;
            let action = document.querySelector('input[name="action"]').value;

            newProviderValues = {
                company_name: document.querySelector('#company-name').value,
                fantasy_name: document.querySelector('#fantasy-name').value,
                cnpj: document.querySelector('#cnpj').value,
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
                type: "POST",
                dataType: "json",
                url: "../controllers/register_provider_controller.php",
                async: true,
                data: newProviderValues,

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
                        text: 'Erro ao cadastrar fornecedor'
                    });
                }
            })
        }
    });
}

// pesquisa fornecedor
const blockModalSearchProvider = document.querySelector("#modal-search-provider");
if (blockModalSearchProvider) {
    blockModalSearchProvider.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            if (document.querySelector("#search-provider").value === "") {
                e.preventDefault();
            }
        }
    })
}
const formSearchProvider = document.querySelector("#formSearchProvider");
if (formSearchProvider) {
    formSearchProvider.addEventListener("submit", function (e) {
        e.preventDefault();

        let valueSearch = document.querySelector("#search-provider").value;
        let action = document.querySelector('input[name="action_search"]').value;
        let csrf_token = document.querySelector('input[name="csrf_token_search"]').value;
        let result_search_table = document.querySelector("#result-search");
        let table_responsive = document.querySelector(".table-responsive");

        if (valueSearch != "") {
            showLoading();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                async: true,
                url: '../controllers/register_provider_controller.php',
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
                    } else {
                        showLoading();
                        table_responsive.classList.remove("d-none");
                        result_search_table.innerHTML = "";
                        let thead = document.createElement("thead");
                        thead.classList.add("text-center");
                        let tr = document.createElement("tr");
                        let th = document.createElement("th");

                        result_search_table.appendChild(thead);

                        th.setAttribute("scope", "col");
                        th.innerHTML = "Razão Social";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Nome Fantasia";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "CNPJ";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Ações";
                        tr.appendChild(th);

                        thead.appendChild(tr);

                        let tbody = document.createElement("tbody");

                        for (let i = 0; i < response.length; i++) {
                            //objeto fornecedor
                            let providerObj = {
                                id: response[i].id,
                                company_name: response[i].razao_social,
                                fantasy_name: response[i].nome_fantasia,
                                cnpj: response[i].cnpj,
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

                            td.innerHTML = providerObj.company_name;
                            tr.appendChild(td);
                            td = document.createElement('td')

                            td.innerHTML = providerObj.fantasy_name;
                            tr.appendChild(td);
                            td = document.createElement('td')

                            td.innerHTML = providerObj.cnpj;
                            tr.appendChild(td);

                            let icon_edit = document.createElement("i");
                            icon_edit.setAttribute("class", "fas fa-edit");
                            icon_edit.style.cursor = "pointer";
                            icon_edit.addEventListener("click", function () {
                                //fechar o modal de pesquisa
                                $('#modal-search-provider').modal('hide');
                                //abrir o modal de cadastro de fornecedor
                                display('modal-cad-provider');

                                const btnUpdate = document.querySelector('#btnSend');
                                btnUpdate.innerHTML = "Alterar";
                                btnUpdate.setAttribute("class", "btn btn-warning");

                                const formUpdateProvider = document.querySelector('#formAddNewProvider')
                                formUpdateProvider.setAttribute("id", "formUpdateProvider");

                                //preencher os campos do modal de cadastro
                                document.querySelector('#company-name').value = providerObj.company_name;
                                document.querySelector('#fantasy-name').value = providerObj.fantasy_name;
                                document.querySelector('#cnpj').value = providerObj.cnpj;
                                document.querySelector('#cep').value = providerObj.cep;
                                document.querySelector('#city').value = providerObj.city;
                                document.querySelector('#state').value = providerObj.state;
                                document.querySelector('#address').value = providerObj.address;
                                document.querySelector('#neighborhood').value = providerObj.neighborhood;
                                document.querySelector('#street-complement').value = providerObj.street_complement;
                                document.querySelector('#number').value = providerObj.number;
                                document.querySelector('#reference-point').value = providerObj.reference_point;
                                document.querySelector('#telephone').value = providerObj.telephone;
                                document.querySelector('#cellphone').value = providerObj.cellphone;
                                document.querySelector('#email').value = providerObj.email;

                                formUpdateProvider.addEventListener("submit", function (e) {
                                    e.preventDefault();

                                    if (validateInputsProvider()) {
                                        showLoading();

                                        let action = document.querySelector('input[name="action"]').value = 'update';
                                        let csrf_token = document.querySelector('input[name="csrf_token"]').value;
                                        let id = providerObj.id;

                                        newProviderValues = {
                                            id: id,
                                            company_name: document.querySelector('#company-name').value,
                                            fantasy_name: document.querySelector('#fantasy-name').value,
                                            cnpj: document.querySelector('#cnpj').value,
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
                                            url: '../controllers/register_provider_controller.php',
                                            async: true,
                                            data: newProviderValues,

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
                                                            document.querySelector("#formSearchProvider").submit();
                                                        }
                                                    });
                                                }
                                            }
                                        })
                                    }
                                });
                            });

                            td = document.createElement("td");
                            td.appendChild(icon_edit);
                            tr.appendChild(td);

                            let icon_delete = document.createElement("i");
                            icon_delete.setAttribute("class", "fas fa-trash-alt");
                            icon_delete.style.cursor = "pointer";
                            icon_delete.setAttribute("data-id", providerObj.id);
                            icon_delete.addEventListener("click", function () {
                                deleteProvider(id = this.getAttribute("data-id"));
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
                        text: 'Erro ao buscar fornecedor',
                        allowOutsideClick: false
                    });
                }
            })
        }
    });
}

function deleteProvider(id) {
    Swal.fire({
        icon: 'warning',
        text: 'Deseja realmente excluir esse fornecedor?',
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
                url: '../controllers/register_provider_controller.php',
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
                                document.querySelector("#formSearchProvider").submit();
                            }
                        });
                    }
                },
                error: function (response) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao excluir fornecedor',
                        allowOutsideClick: false
                    });
                }
            });
        }
    });
}

// pagina de cadastro de produto

//preview  imagem no input, quando o usuário carregar uma image, logo irá aparecer uma prewiew da mesma
// define o evento de clique do span com o X
function excluirImagem() {
    document.getElementById("preview-img").src = "../assets/img/products/produto-sem-imagem.webp";
    document.getElementById("img-product").value = "";
    if (document.querySelector("#delete-img-preview")) {
        document.querySelector("#delete-img-preview").style.display = "none";
    }
}

if (document.querySelector("#delete-img-preview")) {
    document.querySelector("#delete-img-preview").addEventListener("click", excluirImagem);
};

function readImage() {

    if (this.files && this.files[0]) {
        let file = new FileReader();
        file.onload = function (e) {
            document.getElementById("preview-img").src = e.target.result;
        };
        file.readAsDataURL(this.files[0]);

        document.querySelector("#delete-img-preview").style.display = "flex";
        document.querySelector("#delete-img-preview").innerHTML = "Remover imagem";

    }
}

if (document.getElementById("img-product")) {
    document.getElementById("img-product").addEventListener("change", readImage, false);
};

//função que ativa o Label, irá abrir a janela para escolher a imagem
function selecionaImagem() {
    let input = document.getElementById("img-product");
    let nome_arquivo = document.getElementById("file-name");

    if (input != null && nome_arquivo != null) {
        input.addEventListener("change", function () {
            nome_arquivo.textContent = input.value;
        })
    }
}
selecionaImagem();

//form de página de cadastro de produto
function previewSumPriceTotal() {

    let qnt = document.querySelector("#product-qnt").value;
    let unit_price = document.querySelector("#product-unit-price").value;
    let total_price = document.querySelector("#total-price-on-product");

    unit_price = unit_price.replace(/[^0-9]/g, '');

    if (unit_price != "" && qnt != "") {
        total_price = parseFloat((unit_price) * qnt);
        total_price = total_price + '';
        total_price = parseInt(total_price.replace(/[^0-9]/g, ''));
        total_price = total_price + "";
        total_price = total_price.replace(/(\d{2})$/, ',$1');

        if (total_price.length > 6) {
            total_price = total_price.replace(/(\d{3}),(\d{2}$)/, '.$1,$2');
        }

        total_price.value = total_price;;
        if (total_price === "NaN") {
            total_price = "0,00";
        }
        document.querySelector("#total-price-on-product").value = total_price;
    }

}
const formCadProduct = document.querySelector("#formCadProduct");
const btnSend = document.querySelector("#btnSend");
if (formCadProduct) {

    btnSend.addEventListener("click", function (e) {
        e.preventDefault();
        if (validateInputsProduct()) {
            showLoading();
            formCadProduct.action = "../controllers/register_product_controller.php";
            formCadProduct.submit();
        }

    });
}
//bloquear a ação do enter
const blockModalSearchProduct = document.querySelector("#modal-search-product");
if (blockModalSearchProduct) {
    blockModalSearchProduct.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            if (document.querySelector("#search-product").value === "") {
                e.preventDefault();
            }
        }
    })
}

const formSearchProduct = document.querySelector("#formSearchProduct");
if (formSearchProduct) {
    formSearchProduct.addEventListener("submit", function (e) {
        e.preventDefault();

        let valueSearch = document.querySelector("#search-product").value;
        let action = document.querySelector('input[name="action_search"]').value;
        let csrf_token = document.querySelector('input[name="csrf_token_search"]').value;
        let result_search_table = document.querySelector("#result-search");
        let table_responsive = document.querySelector(".table-responsive");

        if (valueSearch != "") {
            showLoading();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                async: true,
                //url: '../controllers/search_product_controller.php',
                url: '../controllers/register_product_controller.php',
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
                    } else {
                        showLoading();
                        table_responsive.classList.remove("d-none");
                        result_search_table.innerHTML = "";
                        let thead = document.createElement("thead");
                        thead.classList.add("text-center");
                        let tr = document.createElement("tr");
                        let th = document.createElement("th");

                        result_search_table.appendChild(thead);

                        th.setAttribute("scope", "col");
                        th.innerHTML = "Nome do Produto";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Código do Produto";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "QNT";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Preço Unitário";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Preço Venda";
                        tr.appendChild(th);

                        th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.innerHTML = "Ações";
                        tr.appendChild(th);

                        thead.appendChild(tr);

                        let tbody = document.createElement("tbody");
                        tbody.classList.add("text-center");

                        for (let i = 0; i < response.length; i++) {
                            //objeto produto

                            let productObj = {
                                id: response[i].id,
                                product_name: response[i].nome_produto,
                                product_code: response[i].codigo_produto,
                                product_supplier: response[i].fornecedor,
                                product_description: response[i].descricao_produto,
                                product_qnt: response[i].quantidade_produto,
                                product_unit_price: response[i].preco_unitario_produto,
                                product_sale_price: response[i].preco_venda_produto,
                                product_total_price: response[i].preco_total_em_produto,
                                img_product: response[i].imagem_produto
                            }

                            tr = document.createElement("tr");
                            let td = document.createElement("td");
                            td.innerHTML = productObj.product_name;
                            tr.appendChild(td);


                            td = document.createElement('td')
                            td.innerHTML = productObj.product_code;
                            tr.appendChild(td);

                            td = document.createElement('td')
                            td.innerHTML = productObj.product_qnt;
                            tr.appendChild(td);

                            td = document.createElement('td')
                            td.innerHTML = productObj.product_unit_price;
                            tr.appendChild(td);

                            td = document.createElement('td')
                            td.innerHTML = productObj.product_sale_price;
                            tr.appendChild(td);

                            let icon_edit = document.createElement("i");
                            icon_edit.setAttribute("class", "fas fa-edit");
                            icon_edit.style.cursor = "pointer";
                            icon_edit.addEventListener("click", function () {
                                //fechar o modal de pesquisa
                                $('#modal-search-product').modal('hide');
                                //abrir o modal de cadastro de produto
                                display('modal-cad-product');

                                const btnUpdate = document.querySelector('#btnSend');
                                btnUpdate.innerHTML = "Alterar";
                                btnUpdate.setAttribute("class", "btn btn-warning");

                                const formCadProduct = document.querySelector('#formCadProduct')
                                if (formCadProduct) {
                                    formCadProduct.setAttribute("id", "formUpdateProduct");
                                    document.querySelector('input[name="action"]').value = 'update';
                                    //criar um input hidden id
                                    let inputHidden = document.createElement("input");
                                    inputHidden.setAttribute("type", "hidden");
                                    inputHidden.setAttribute("name", "id");
                                    inputHidden.setAttribute("value", productObj.id);
                                    formCadProduct.appendChild(inputHidden);
                                }

                                //preencher os campos do modal de cadastro (que agora irá fazer o update)
                                document.querySelector('#product-name').value = productObj.product_name;
                                document.querySelector('#product-code').value = productObj.product_code;
                                document.querySelector('#product-supplier').value = productObj.product_supplier;
                                document.querySelector('#product-description').value = productObj.product_description;
                                document.querySelector('#product-qnt').value = productObj.product_qnt;
                                document.querySelector('#product-unit-price').value = productObj.product_unit_price;
                                document.querySelector('#product-sale-price').value = productObj.product_sale_price;
                                document.querySelector("#total-price-on-product").value = productObj.product_total_price;
                                document.querySelector("#preview-img").src = "../assets/img/products/" + productObj.img_product;

                                const btnSend = document.querySelector("#btnSend");
                                btnSend.addEventListener("click", function (e) {
                                    e.preventDefault();
                                    if (validateInputsProduct()) {
                                        showLoading();
                                        formCadProduct.action = "../controllers/register_product_controller.php";
                                        formCadProduct.submit();
                                    }

                                });

                            });
                            td = document.createElement("td");
                            td.appendChild(icon_edit);
                            tr.appendChild(td);

                            let icon_delete = document.createElement("i");
                            icon_delete.setAttribute("class", "fas fa-trash-alt");
                            icon_delete.style.cursor = "pointer";
                            icon_delete.setAttribute("data-id", productObj.id);
                            icon_delete.addEventListener("click", function () {
                                deleteProduct(id = this.getAttribute("data-id"));
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
                    clearInputs();
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao buscar produto',
                        allowOutsideClick: false
                    });
                }
            });
        }
    });
}

function deleteProduct(id) {

    Swal.fire({
        icon: 'warning',
        text: 'Deseja realmente excluir esse produto?',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '../controllers/register_product_controller.php',
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
                                document.querySelector("#formSearchProduct").submit();
                            }
                        });
                    }
                },
                error: function (response) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao excluir produto',
                        allowOutsideClick: false
                    });
                }
            });
        }
    });
}









// formCadProduct.addEventListener("submit", function (e) {
//     e.preventDefault();

//     if (validateInputsProduct()) {
//         showLoading();

//         let csrf_token = document.querySelector('input[name="csrf_token"]').value;
//         let action = document.querySelector('input[name="action"]').value;

//         // transformar o valor da imagem em Stringify
//         let img_product_base64 = document.querySelector("#img-product").files[0];
//         let reader = new FileReader();
//         reader.readAsDataURL(img_product_base64);
//         newProductValues = {};
//         reader.onload = function () {
//             img_product_base64 = reader.result;
//             console.log(img_product_base64);

//             newProductValues = {
//                 product_name: document.querySelector('#product-name').value,
//                 product_code: document.querySelector('#product-code').value,
//                 product_supplier: document.querySelector('#product-supplier').value,
//                 product_description: document.querySelector('#product-description').value,
//                 product_qnt: document.querySelector('#product-qnt').value,
//                 product_unit_price: document.querySelector('#product-unit-price').value,
//                 product_sale_price: document.querySelector('#product-sale-price').value,
//                 total_price_on_product: document.querySelector('#total-price-on-product').value,
//                 img_product: img_product_base64,
//                 csrfToken: csrf_token,
//                 action: action
//             };
//         }

//         $.ajax({
//             type: 'POST',
//             dataType: "json",
//             url: "../controllers/register_product_controller.php",
//             async: true,
//             data: newProductValues,

//             success: function (response) {
//                 if (response.error) {
//                     hideLoading();
//                     Swal.fire({
//                         icon: 'error',
//                         text: response.message
//                     });
//                 } else {
//                     hideLoading();
//                     console.log(response);
//                     Swal.fire({
//                         icon: 'success',
//                         text: response.message
//                     }).then((result) => {
//                         if (result.isConfirmed) {
//                             clearInputs();
//                         }
//                     });
//                 }
//             },
//             error: function (response) {
//                 hideLoading();
//                 console.log(response);
//                 Swal.fire({
//                     icon: 'error',
//                     text: 'Erro ao cadastrar produto'
//                 });
//             }
//         });
//     }
// });

