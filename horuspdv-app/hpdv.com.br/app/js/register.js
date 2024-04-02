function display(modal) {
    let exibirModal = document.getElementById(modal);
    const formUpdateClient = document.querySelector("#formUpdateClient");
    const formUpdateProvider = document.querySelector("#formUpdateProvider");
    if (formUpdateClient) {
        clearInputs();
        form.setAttribute("id", "formAddNewClient");
        form.querySelector("#btnSend").innerHTML = "Salvar";
        form.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
    }

    if (formUpdateProvider) {
        clearInputs();
        form.setAttribute("id", "formAddNewProvider");
        form.querySelector("#btnSend").innerHTML = "Salvar";
        form.querySelector("#btnSend").setAttribute("class", "btn btn-primary");
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

// mascaras dos inputs da página de cadastro de cliente e fornecedor
cellPhoneMask(cellPhoneMask(document.querySelector("#cellphone")))
telephoneMask(telephoneMask(document.querySelector("#telephone")))
cepMask(cepMask(document.querySelector("#cep")))
cpfMask(cpfMask(document.querySelector("#cpf")))
rgMask(rgMask(document.querySelector("#rg")))
dateMask(dateMask(document.querySelector("#birth-date")))
cnpjMask(cnpjMask(document.querySelector("#cnpj")))


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
    document.getElementById("preview-img").src = "../assets/img/avatar/produto-sem-imagem.webp";
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