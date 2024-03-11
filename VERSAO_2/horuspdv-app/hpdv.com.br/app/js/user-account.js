$('#select_excluir_usuario').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});
$('#select_permissao_usuario').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});
