window.onload = function () {
    showLoading();
    if (document.readyState === 'complete') {
        //reset url
        resetURL();
        // quando o voltar da página é acionado, o evento pageshow é acionado e remove a classe show do menu superior e recarrega a página, 
        // para que o menu superior não fique fixo na tela
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                const menuSuperior = document.querySelector('#menuSuperior');
                menuSuperior.classList.remove('show')
                this.location.reload();
            }
        });
        hideLoading();
    }
}

function showLoading() {
    const loading = document.querySelector('.loader-container');
    if (loading != null) {
        loading.innerHTML = `
        <div class="loader"></div>
    `;
        loading.style.display = 'flex';
    }
}

function hideLoading() {
    const loading = document.querySelector('.loader-container');
    if (loading != null) {
        loading.style.display = 'none';
    }
}

function resetURL() {
    setTimeout(function () {
        const url = window.location.href;
        const result = url.split('?')[0];
        history.pushState(null, null, result);
    }, 1000);
}
