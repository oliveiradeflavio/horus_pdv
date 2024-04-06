$('#select_product').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

$('#select_client').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

function display(modal) {
    let exibirModal = document.getElementById(modal);
    $(exibirModal).modal('show');
}

$(document).ready(function () {
    // Função para verificar se ambos cliente, produto e quantidade foram selecionados
    function checkSelection() {
        let selectedClient = $("#select_client").val();
        let selectedProduct = $("#select_product").val();
        let quantity = parseInt($(this).val());

        // Se ambos cliente e produto foram selecionados, habilitar o botão
        if (selectedClient && selectedProduct && quantity != 0) {
            $('#add_product').prop('disabled', false);
        } else {
            $('#add_product').prop('disabled', true);
        }
    }

    // Adicionar eventos de escuta aos campos de seleção
    $("#select_client, #select_product").on('change', checkSelection);
});


//seleção do produot, pegando o valor unitário do produto e setando no campo unit_price. configura também a imagem do produto
$('#select_product').on('change', function () {
    $('#product_quantity').val('1');
    let unit_price = $('#select_product option:selected').data('price');
    $('#unit_price').val(unit_price);
    $('#total_price').val(unit_price);
    let preview_img = $('#select_product option:selected').data('img');
    if (preview_img == null || preview_img == '' || preview_img == undefined) {
        $('#preview_img').attr('src', "../assets/img/avatar/shopping-cart.webp");
    } else {
        $('#preview_img').attr('src', "../assets/img/products/" + preview_img);
    }
});


// $("#product_quantity").on('change', function () {
//     if ($('#product_quantity').val() > 0) {
//         let unit_price = $('#unit_price').val();
//         let qnt = $('#product_quantity').val();
//         unit_price = unit_price.replace(/[^0-9]/g, "");

//         let total_price = unit_price * qnt;
//         total_price = parseInt(total_price.toString().replace(/[\D]+/g, ""));
//         total_price = total_price.toString().replace(/([0-9]{2})$/g, "$1");
//         if (total_price.length > 6) {
//             total_price = total_price.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
//         }
//         $('#total_price').val(total_price);
//     } else {
//         $('#product_quantity').val('1');
//     }
// });

$("#product_quantity").on('input', function () {
    let quantity = parseInt($(this).val());
    if (quantity > 0) {
        let unit_price = $('#unit_price').val().replace(/[^0-9]/g, "");
        let total_price = unit_price * quantity;

        // Formatando para reais
        total_price = (total_price / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        $('#total_price').val(total_price);
    } else {
        $('#product_quantity').val('1');
    }
});

function checkProductRepeated() {
    //se o id do produto já estiver na tabela, não permitir adicionar novamente
    let selectedProductID = $('#select_product').val();
    let tableProduct = document.querySelectorAll("#table_product")
    let rows = tableProduct[0].rows;
    for (let i = 0; i < rows.length; i++) {
        if (rows[i].cells[0].innerHTML == selectedProductID) {
            return false;
        }
    }
    return true;
}

//adicionando produto na tabela
function addProductTable() {
    // let selectedClient = $('#select_client').val();
    let selectedProductID = $('#select_product').val();
    let selectedProduct = document.querySelector('#select_product option:checked').text;
    let selectedUnitPrice = $('#unit_price').val();
    let selectedQuantity = $('#product_quantity').val();
    let selectedTotalPrice = $('#total_price').val();
    let tableProduct = document.querySelectorAll("#table_product")
    let quantityProductDatabase = $('#select_product option:selected').data('qnt');
    let subtotal = document.querySelectorAll("#subtotal");

    if (selectedQuantity > quantityProductDatabase) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Quantidade do produto indisponível em estoque!. Em estoque: ' + quantityProductDatabase + ' unidades.',
        });
    } else if (checkProductRepeated() == false) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Produto já adicionado!',
        });
    } else {

        let line = tableProduct[0].insertRow();
        let cellProductId = line.insertCell(0);
        let cellProduct = line.insertCell(1);
        let cellPrice = line.insertCell(2);
        let cellQuantity = line.insertCell(3);
        let cellTotal = line.insertCell(4);
        let cellDelete = line.insertCell(5);

        cellProductId.innerHTML = selectedProductID;
        cellProduct.innerHTML = selectedProduct;
        cellPrice.innerHTML = selectedUnitPrice;
        cellQuantity.innerHTML = selectedQuantity;
        cellTotal.innerHTML = selectedTotalPrice;
        cellDelete.innerHTML = '<i class="fas fa-trash-alt" style="cursor:pointer" onclick="deleteProduct(this)"></i>';

        //preenchendo o input de subtotal. Somando todos os valores da coluna valor total
        let total = 0;
        for (let i = 1; i < tableProduct[0].rows.length; i++) {
            total += parseInt(tableProduct[0].rows[i].cells[4].innerHTML.replace(/[^0-9]/g, ""));
        }
        total = total.toString().replace(/([0-9]{2})$/g, ",$1");
        if (total.length > 6) {
            total = total.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }
        //adicionado R$ ao valor total
        total = "R$ " + total;
        subtotal[0].value = total;

        //bloquear o seletor de cliente já que a venda foi iniciada
        $('#select_client').prop('disabled', true);

        //habilitar o botão de fechar o pedido
        $('#close_sale').prop('disabled', false);
    }
}

//removendo produto da tabela e recalculando o subtotal
function deleteProduct(id) {
    let row = id.parentNode.parentNode;
    let tableProduct = document.querySelectorAll("#table_product")
    let subtotal = document.querySelectorAll("#subtotal");

    //remover o produto da tabela
    tableProduct[0].deleteRow(row.rowIndex);

    //preenchendo o input de subtotal. Somando todos os valores da coluna valor total
    let total = 0;
    for (let i = 1; i < tableProduct[0].rows.length; i++) {
        total += parseInt(tableProduct[0].rows[i].cells[4].innerHTML.replace(/[^0-9]/g, ""));
    }
    total = total.toString().replace(/([0-9]{2})$/g, ",$1");

    if (total.length > 6) {
        total = total.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }
    //adicionado R$ ao valor total
    total = "R$ " + total;
    subtotal[0].value = total;
}

//cancelando a venda e limpando todos os campos da tela
function cancelSale() {

    Swal.fire({
        icon: 'warning',
        title: 'Atenção!',
        text: 'Deseja realmente cancelar a venda?',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {

            //removendo todas as seleçoes do Selec2
            $("#select_client").val(null).trigger("change");
            $("#select_product").val(null).trigger("change");

            //limpando os campos da tela
            let subtotal = document.querySelectorAll("#subtotal");
            let productQuantity = document.querySelectorAll("#product_quantity");
            let unitPrice = document.querySelectorAll("#unit_price");
            let totalPrice = document.querySelectorAll("#total_price");
            let previewImg = document.querySelectorAll("#preview_img");
            let add_product = document.querySelectorAll("#add_product");

            //limpando a tabela
            let tableProduct = document.querySelectorAll("#table_product")
            let rows = tableProduct[0].rows;
            for (let i = rows.length - 1; i > 0; i--) {
                tableProduct[0].deleteRow(i);
            }

            //limpando os campos
            subtotal[0].value = "R$ 00,00"
            productQuantity[0].value = 1;
            unitPrice[0].value = "R$ 00,00"
            totalPrice[0].value = "R$ 00,00"
            previewImg[0].src = '../assets/img/avatar/shopping-cart.webp';
            add_product[0].disabled = true;

            //desbloquear o seletor de cliente
            $('#select_client').prop('disabled', false);

            //bloquear o botão de fechar o pedido
            $('#close_sale').prop('disabled', true);
        }
    });
}

//fechando a venda e abrindo o modal de pagamento 
function closeSale() {
    let tableProduct = document.querySelectorAll("#table_product")
    let subtotal = document.querySelectorAll("#subtotal");

    if (tableProduct[0].rows.length == 1) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Adicione um produto para fechar a venda!',
        });
    } else {
        //chamando o modal de pagamento
        display('modal-close-order');

        //mostrar o valor total da venda no input de Total Venda que esta no modal
        let total_sale = document.getElementById('total_sale');
        total_sale.value = subtotal[0].value;

        //se pamento for em cartão liberar o campo de codigo de transação
        $('#payment_type').on('change', function () {
            if ($('#payment_type').val() != 'dinheiro') {
                //habilita o campo de transação
                $('#cd_transaction_pix').prop('disabled', false);
                $('#cd_transaction_pix').prop('required', true);
            } else {
                //desabilita o campo de transação
                $('#cd_transaction_pix').prop('disabled', true);
            }
        });

        let inputDiscount = document.getElementById('discount');
        let inputDisconuntedPrice = document.getElementById('disconunted_price');
        let inputAmountPaid = document.getElementById('amount_paid');

        //calcular o valor total da venda com desconto (desconto em %)
        inputDiscount.addEventListener('input', function () {
            let discount = inputDiscount.value;
            let total = subtotal[0].value.replace(/[^0-9]/g, "");
            let totalDiscount = total - (total * discount / 100);
            totalDiscount = totalDiscount.toString().replace(/([0-9]{2})$/g, ",$1");

            if (totalDiscount.length > 6) {
                totalDiscount = totalDiscount.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }
            //adicionado R$ ao valor total
            totalDiscount = "R$ " + totalDiscount;
            inputDisconuntedPrice.value = totalDiscount;
        });

        //verificar se o desconto digitado é maior do que 100%
        inputDiscount.addEventListener('blur', function () {
            if (inputDiscount.value > 100 || inputDiscount.value < 0) {
                const blockModalCloseOrder = document.querySelector("#modal-close-order");
                if (blockModalCloseOrder) {
                    blockModalCloseOrder.addEventListener("keypress", function (e) {
                        if (e.key === "Enter") {
                            e.preventDefault();
                        }
                    })
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Desconto não pode ser maior que 100%!',
                    allowOutsideClick: false,
                });
                inputDiscount.value = '';
                inputDisconuntedPrice.value = '';
                inputAmountPaid.value = subtotal[0].value;
            }
        });

        inputDiscount.addEventListener('change', function () {
            //calculando o valor a ser pago, de acordo com o valor com desconto ou sem desconto
            if (inputDiscount.value == '') {
                inputAmountPaid.value = subtotal[0].value;
            } else {
                //calculando o valor a ser pago com desconto
                inputAmountPaid.value = inputDisconuntedPrice.value;
            }
        })
        inputAmountPaid.value = subtotal[0].value;
    }
}

//salvando a venda
const formCloseOrder = document.querySelector('#formCloseOrder');
if (formCloseOrder) {
    formCloseOrder.addEventListener('submit', function (e) {
        e.preventDefault()

        //pegar os dados para enviar para o backend
        //cliente, produtos, quantidade, valor unitário, valor total do produto, subtotal, tipo de pagamento, valor com/sem desconto, codigo de transação, valor pago
        let client = document.getElementById('select_client').value;
        let products = [];
        let tableProduct = document.querySelectorAll("#table_product")
        for (let i = 1; i < tableProduct[0].rows.length; i++) {
            let product = {
                product_id: tableProduct[0].rows[i].cells[0].innerHTML,
                quantity: tableProduct[0].rows[i].cells[3].innerHTML,
                price: tableProduct[0].rows[i].cells[2].innerHTML,
            }

            products.push(product);
        }
        let subtotal = document.getElementById('subtotal').value;
        let payment_type = document.getElementById('payment_type').value;
        let discount = document.getElementById('discount').value;
        let disconunted_price = document.getElementById('disconunted_price').value;
        let amount_paid = document.getElementById('amount_paid').value;
        let cd_transaction_pix = document.getElementById('cd_transaction_pix').value;

        console.log(client, products, subtotal, payment_type, discount, disconunted_price, amount_paid, cd_transaction_pix);

    });
}

function backToSale() {
    //limpar os campos do modal de pagamento
    let inputPaymentType = document.getElementById('payment_type');
    let inputDiscount = document.getElementById('discount');
    let inputDisconuntedPrice = document.getElementById('disconunted_price');
    let inputAmountPaid = document.getElementById('amount_paid');

    inputPaymentType.value = 'dinheiro';
    inputDiscount.value = '';
    inputDisconuntedPrice.value = '';
    inputAmountPaid.value = '';
    $('#cd_transaction_pix').val('');
    $('#cd_transaction_pix').prop('disabled', true);
    //fechar o modal de pagamento
    $('#modal-close-order').modal('hide');
}

