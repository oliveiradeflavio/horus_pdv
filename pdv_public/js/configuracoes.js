//Controller das nav-tabs
$('#tab_configuracoes a').on("click", function(event){
    event.preventDefault();
    $(this).tab('show');
})