//controlando as tabs do relatório
// $(function () {
//     let hash = window.location.hash;
//     hash && $('ul.nav a[href="' + hash + '"]').tab('show');

//     $('#tab_relatorio a').click(function (e) {
//         $(this).tab('show');
//         let scrollmem = $('body').scrollTop() || $('html').scrollTop();
//         window.location.hash = this.hash;
//         $('html,body').scrollTop(scrollmem);
//     });

// });

const triggerTabList = document.querySelectorAll('#tab_relatorio a')
triggerTabList.forEach(triggerEl => {
    triggerEl.addEventListener('click', event => {
        event.preventDefault();

        // Remove a classe 'show active' de todas as abas
        triggerTabList.forEach(el => el.classList.remove('show', 'active'));

        // Adiciona a classe 'show active' à aba clicada
        triggerEl.classList.add('show', 'active');

        // Mostra a aba correspondente ao clique
        const tabTrigger = new bootstrap.Tab(triggerEl);
        tabTrigger.show();
    });
})

