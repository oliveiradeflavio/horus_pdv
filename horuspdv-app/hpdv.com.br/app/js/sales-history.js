document.addEventListener('DOMContentLoaded', function () {
    let cardContent = document.querySelector('#card');
    cardContent.classList.add('card-sales-history');
});

const formSalesHistory = document.querySelector('#formSalesHistory');
formSalesHistory.addEventListener('submit', function (event) {
    event.preventDefault();
    loadSales();
});

function loadSales() {
    showLoading();
    let csrfToken = document.querySelector('input[name="csrf_token"]').value;
    let action = document.querySelector('input[name="action"]').value;
    let searchValue = document.querySelector('input[name="search-sales"]').value;
    let table_responsive = document.querySelector('.table-responsive');
    let result_search_table = document.querySelector('#result_table');

    if (searchValue != '') {

        values = {
            action: action,
            csrf_token: csrfToken,
            search: searchValue
        }
        $.ajax({
            type: 'POST',
            url: "../controllers/sales_history_controller.php",
            dataType: 'json',
            async: true,
            data: values,

            success: function (response) {
                hideLoading();
                if (response.error) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: response.message
                    });
                } else {
                    hideLoading();

                    let cardContent = document.querySelector('#card');
                    cardContent.classList.remove('card-sales-history');

                    table_responsive.classList.remove("d-none");
                    result_search_table.innerHTML = "";
                    let thead = document.createElement("thead");
                    thead.classList.add("text-center");
                    let tr = document.createElement("tr");
                    let th = document.createElement("th");

                    result_search_table.appendChild(thead);

                    th.setAttribute("scope", "col");
                    th.innerHTML = "Número da Venda";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Cliente";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "CPF";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Código do Produto";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Nome do Produto";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "QNT";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Data da Venda";
                    tr.appendChild(th);

                    th = document.createElement("th");
                    th.setAttribute("scope", "col");
                    th.innerHTML = "Ações";
                    tr.appendChild(th);

                    thead.appendChild(tr);

                    let tbody = document.createElement("tbody");
                    tbody.classList.add("text-center");

                    for (let i = 0; i < response.length; i++) {
                        //objeto venda
                        let salesObj = {
                            sale_number: response[i].numero_da_venda,
                            client_name: response[i].nome,
                            client_cpf: response[i].cpf,
                            product_code: response[i].id,
                            product_name: response[i].nome_produto,
                            quantity: response[i].quantidade,
                            sale_date: response[i].data_criacao
                        }

                        tr = document.createElement("tr");
                        let td = document.createElement("td");
                        td.innerHTML = salesObj.sale_number;
                        tr.appendChild(td);


                        td = document.createElement('td')
                        td.innerHTML = salesObj.client_name;
                        tr.appendChild(td);

                        td = document.createElement('td')
                        td.innerHTML = salesObj.client_cpf;
                        tr.appendChild(td);

                        td = document.createElement('td')
                        td.innerHTML = salesObj.product_code;
                        tr.appendChild(td);

                        td = document.createElement('td')
                        td.innerHTML = salesObj.product_name;
                        tr.appendChild(td);

                        td = document.createElement('td')
                        td.innerHTML = salesObj.quantity;
                        tr.appendChild(td);

                        td = document.createElement('td')
                        //colocando a data no formato dd/mm/yyyy hh:mm:ss
                        salesObj.sale_date = new Date(salesObj.sale_date);
                        salesObj.sale_date = salesObj.sale_date.toLocaleString();
                        td.innerHTML = salesObj.sale_date;
                        tr.appendChild(td);

                        let icon_download = document.createElement("i");
                        icon_download.classList.add("fa-solid", "fa-file-pdf");
                        icon_download.style.cursor = "pointer";
                        icon_download.addEventListener("click", function () {
                            let numberSale = salesObj.sale_number;
                            window.open('../report/sales_report.php?action=print_sale&id=' + numberSale, '_blank');
                        });
                        td = document.createElement("td");
                        td.appendChild(icon_download);
                        tr.appendChild(td);

                        tbody.appendChild(tr);
                    }
                    result_search_table.appendChild(tbody);
                    hideLoading();
                }
            },
            error: function (response) {
                console.log(response);
            }

        });
    } else {
        hideLoading();
        Swal.fire({
            icon: 'error',
            text: 'Preencha o campo de busca'
        });
    }
}