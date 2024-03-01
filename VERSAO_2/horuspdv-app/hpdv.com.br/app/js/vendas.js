$('#select_product').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

function exibir(modal) {
    let exibirModal = document.getElementById(modal);
    $(exibirModal).modal('show');
}