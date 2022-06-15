$('#selecao_produto').on('change', function () {
    $('#quantidade_produto').val(1);
    let preco_unitario = $('#selecao_produto option:selected').data('valor');
    $('#preco_unitario_produto').val(preco_unitario);
    $('#preco_total_produto').val(preco_unitario);
    let preview_imagem_produto = $('#selecao_produto option:selected').data('imagem');
    $('#preview_imagem_produto').attr('src', '../pdv/img/produtos/' + preview_imagem_produto);
});

$('#quantidade_produto').on('change', function () {
    if ($('#quantidade_produto').val() > 0) {
        let preco_unitario = $('#preco_unitario_produto').val();
        let quantidade = $('#quantidade_produto').val();
        preco_unitario = preco_unitario.replace(/[^0-9]/g, '');

        let preco_total = preco_unitario * quantidade;
        preco_total = parseInt(preco_total.toString().replace(/[\D]+/g, ''));
        preco_total = preco_total.toString().replace(/([0-9]{2})$/g, ",$1");
        if (preco_total.length > 6) {
            preco_total = preco_total.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }
        $('#preco_total_produto').val(preco_total);
    }
    else {
        $('#quantidade_produto').val(1);
    }
});

function adicionarItens() {

    let selecao_produto = document.getElementById('selecao_produto');
    let quantidade_produto = document.getElementById('quantidade_produto');
    let preco_unitario_produto = document.getElementById('preco_unitario_produto');
    let preco_total_produto = document.getElementById('preco_total_produto');
    let tabela_itens = document.getElementById('lista_itens');
    let quantidade_produto_bd = $('#selecao_produto option:selected').data('quantidade');
    let total_venda = document.getElementById('total_venda').value;
    let div_fechamento_conta = document.getElementById('div_fechamento_conta');

    if (selecao_produto.selectedIndex == 0 || quantidade_produto.value == 0 || preco_unitario_produto.value == 0 || preco_total_produto.value == 0) {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos para adicionar o item ao pedido',
            type: 'error',
            confirmButtonText: 'Ok'
        });

    } else if (quantidade_produto_bd < quantidade_produto.value) {
        Swal.fire({
            icon: 'warning',
            text: 'Quantidade de produto indisponível no estoque de produtos. Quantidade disponível: ' + quantidade_produto_bd,
            type: 'error',
            confirmButtonText: 'Ok'
        });
    } else {
        tabela_itens.style.display = 'block';
        div_fechamento_conta.style.display = '';

        let linha = tabela_itens.insertRow(1);
        let celula_produto = linha.insertCell(0);
        let celula_quantidade = linha.insertCell(1);
        let celula_preco_unitario = linha.insertCell(2);
        let celula_preco_total = linha.insertCell(3);
        let celula_excluir = linha.insertCell(4);

        celula_produto.innerHTML = selecao_produto.options[selecao_produto.selectedIndex].text;
        celula_quantidade.innerHTML = quantidade_produto.value;
        celula_preco_unitario.innerHTML = preco_unitario_produto.value;
        celula_preco_total.innerHTML = preco_total_produto.value;
        celula_excluir.innerHTML = '<i class="fas fa-trash-alt icone_fontawesome" style="cursor:pointer" onclick="excluirLinha(this)"></i>';


        total_venda = total_venda.toString().replace(/[^0-9]/g, '');
        preco_total_produto = preco_total_produto.value.toString().replace(/[^0-9]/g, '');

        total_venda_atual_convertido = parseInt(total_venda) + parseInt(preco_total_produto);
        total_venda_atual = total_venda_atual_convertido.toString().replace(/[\D]+/g, '');
        total_venda_atual = total_venda_atual.toString().replace(/([0-9]{2})$/g, ",$1");
        if (total_venda_atual.length > 6) {
            total_venda_atual = total_venda_atual.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }
        $('#total_venda').val(total_venda_atual);

    }

}

// $('#desconto_venda').on('change', function(){
//     let total_venda_sem_desconto = document.getElementById('total_venda').value;

//     if($('#desconto_venda').val() > 0){
//         let desconto_venda = $('#desconto_venda').val();

//         //console.log(total_venda_sem_desconto + ' total_venda_sem_desconto')

//         total_venda_atual_sem_desconto = total_venda_sem_desconto.toString().replace(/[^0-9]/g, '');
//         let desconto_venda_atual = parseInt(desconto_venda) * parseInt(total_venda_atual_sem_desconto) / 100;

//         let total_venda_atual_com_desconto = parseInt(total_venda_atual_sem_desconto) - parseInt(desconto_venda_atual);

//         //console.log(total_venda_atual_com_desconto)

//         total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/[\D]+/g, '');


//         total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/([0-9]{2})$/g, ",$1");

//         console.log(total_venda_atual_com_desconto)
//         //alert(total_venda_atual_com_desconto)

//         // if(total_venda_atual_com_desconto.length > 6) {
//         //     total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
//         // }
//          document.getElementById('total_venda').value = total_venda_atual_com_desconto;

//     }else{
//         $('#total_venda').val(total_venda_sem_desconto);
//         //console.log(total_venda_atual);
//     }
// });

function excluirLinha(elemento) {
    let linha = elemento.parentNode.parentNode;
    let tabela_itens = document.getElementById('lista_itens');
    let total_venda = document.getElementById('total_venda').value;
    //let desconto_venda = document.getElementById('desconto_venda').value;
    let preco_total_produto = linha.cells[3].innerHTML;

    // console.log(total_venda)
    preco_total_produto = preco_total_produto.toString().replace(/[^0-9]/g, '');
    total_venda = total_venda.toString().replace(/[^0-9]/g, '');

    total_venda = parseInt(total_venda) - parseInt(preco_total_produto);
    total_venda = total_venda.toString().replace(/[\D]+/g, '');
    total_venda = total_venda.toString().replace(/([0-9]{2})$/g, ",$1");

    //console.log(total_venda)
    if (total_venda.length > 6) {
        total_venda = total_venda.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }

    $('#total_venda').val(total_venda);
    //console.log(preco_total_produto + ' funcao excluir');

    tabela_itens.deleteRow(linha.rowIndex);
    if (tabela_itens.rows.length == 1) {
        tabela_itens.style.display = 'none';
        let div_fechamento_conta = document.getElementById('div_fechamento_conta');
        div_fechamento_conta.style.display = 'none';

        let selecao_pagamento =  document.getElementById('selecao_pagamento');
        let desconto_venda = document.getElementById('desconto_venda');
        let total_com_desconto = document.getElementById('total_com_desconto')

        let div_desconto_venda = document.getElementById('div_desconto_venda');
        let div_total_com_desconto = document.getElementById('div_total_com_desconto');
        
        div_desconto_venda.style.display = 'none';
        div_total_com_desconto.style.display = 'none';
             
        selecao_pagamento.selectedIndex = 0;
        selecao_pagamento.style.display = 'none';
        desconto_venda.value = 0;
        total_com_desconto.value = 0
        total_venda = 0
        limpaCampos();
    }
}

function fecharPedido() {
    
    let selecao_pagamento = document.getElementById('selecao_pagamento');
    let div_desconto_venda = document.getElementById('div_desconto_venda');
    let div_total_com_desconto = document.getElementById('div_total_com_desconto');

    selecao_pagamento.style.display = 'block';
    selecao_pagamento.innerHTML = ' <option value="">Selecione um pagamento</option><option value="dinheiro">Dinheiro</option><option value="cartão de crédito">Cartão de Crédito</option><option value="cartão de débito">Cartão de Débito</option></select></div>';
    $('#selecao_pagamento').on('change', function () {

        if($('#selecao_pagamento').val() == ''){
            console.log('entrei aqui')
            div_desconto_venda.style.display = 'none';
            div_total_com_desconto.style.display = 'none';  
            total_venda_atual_com_desconto = 0;         
        }

        if ($('#selecao_pagamento').val() == 'dinheiro') {
            div_desconto_venda.style.display = '';
            //div_total_com_desconto.style.display = '';

            div_desconto_venda.innerHTML = '<div class="form-group"><label for="desconto_venda">Desconto (%)</label><input type="number" class="form-control" id="desconto_venda" placeholder="0"></div>';

            //Máscara no campo desconto (sómente números)
            $('#desconto_venda').on('keypress', function (e) {
                let str = (e.keyCode ? e.keyCode : e.which);
                if (str > 47 && str < 58) {
                    return true;
                } else {
                    return (str == 8 || str == 0) ? true : false;
                }
            });        
        
            
            $('#desconto_venda').on('change', function () {
                                
                let total_venda_sem_desconto = document.getElementById('total_venda').value;
                let desconto_venda = document.getElementById('desconto_venda').value;
                console.log(total_venda_sem_desconto)
                console.log(desconto_venda)

                if (desconto_venda > 0 && desconto_venda < 100) {
                    total_venda_atual_sem_desconto = total_venda_sem_desconto.toString().replace(/[^0-9]/g, '');

                    let desconto_venda_atual = parseInt(desconto_venda) * parseInt(total_venda_atual_sem_desconto) / 100;
                    let total_venda_atual_com_desconto = parseInt(total_venda_atual_sem_desconto) - parseInt(desconto_venda_atual);

                    total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/[\D]+/g, '');

                    total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/([0-9]{2})$/g, ",$1");

                    if(total_venda_atual_com_desconto.length > 6) {
                        total_venda_atual_com_desconto = total_venda_atual_com_desconto.toString().replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                    }
                    if(div_total_com_desconto.style.display == 'none') {
                        div_total_com_desconto.style.display = '';
                    }
                    
                    div_total_com_desconto.innerHTML = '<div class="form-group"><label for="total_com_desconto">Total com desconto</label><input type="text" class="form-control" id="total_com_desconto" value="' + total_venda_atual_com_desconto + '" readonly></div>';
                }else{
                    total_venda_atual_com_desconto = 0;
                    div_total_com_desconto.style.display = 'none';
                    //console.log(total_venda_atual_com_desconto)

                }
            });          
           
        }
    });

   // console.log(total_venda.value)
}

function cancelarPedido() {
    alert('em construção')
}

function limpaCampos() {
    let selecao_cliente = document.getElementById('selecao_cliente');
    let selecao_produto = document.getElementById('selecao_produto');
    let quantidade_produto = document.getElementById('quantidade_produto');
    let preco_unitario_produto = document.getElementById('preco_unitario_produto');
    let preco_total_produto = document.getElementById('preco_total_produto');
    let preview_imagem_produto = document.getElementById('preview_imagem_produto');
    
    selecao_cliente.selectedIndex = 0;
    selecao_produto.selectedIndex = 0;;
    quantidade_produto.value = 1;
    preco_unitario_produto.value = 'R$ 0,00';
    preco_total_produto.value = 'R$ 0,00';
    preview_imagem_produto.src = '../pdv/img/produtos/produto_sem_imagem.png';
}