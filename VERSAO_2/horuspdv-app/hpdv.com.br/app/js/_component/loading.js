window.onload = function () {
    showLoading();
    if (document.readyState === 'complete') {
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
