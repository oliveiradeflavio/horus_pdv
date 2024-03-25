const btn_show_hidden_password = document.querySelector('.fa-eye-slash');
btn_show_hidden_password.addEventListener('click', function () {
    let input_password = document.querySelector('#oldPassword');
    if (input_password.type == 'password') {
        input_password.type = 'text';
        btn_show_hidden_password.classList.remove('fa-eye-slash');
        btn_show_hidden_password.classList.add('fa-eye');
    } else {
        input_password.type = 'password';
        btn_show_hidden_password.classList.remove('fa-eye');
        btn_show_hidden_password.classList.add('fa-eye-slash');
    }
});

const btn_show_hidden_repeat_password = document.querySelector('.fa-eye-slash-repeat');
btn_show_hidden_repeat_password.addEventListener('click', function () {
    let input_password = document.querySelector('#newPassword');
    if (input_password.type == 'password') {
        input_password.type = 'text';
        btn_show_hidden_repeat_password.classList.remove('fa-eye-slash-repeat');
        btn_show_hidden_repeat_password.classList.add('fa-eye');
    } else {
        input_password.type = 'password';
        btn_show_hidden_repeat_password.classList.remove('fa-eye');
        btn_show_hidden_repeat_password.classList.add('fa-eye-slash-repeat');
    }
});


function cbChangePassword() {
    let chbox = document.getElementById('chboxChangePassword');
    let inputOldPassword = document.getElementById('oldPassword');
    let inputNewPassword = document.getElementById('newPassword');

    if (chbox.checked) {
        inputOldPassword.disabled = false;
        inputNewPassword.disabled = false;

        inputOldPassword.required = true;
        inputNewPassword.required = true;

        inputNewPassword.value = '';
        inputOldPassword.value = '';
    } else {
        inputOldPassword.disabled = true;
        inputNewPassword.disabled = true;

        inputOldPassword.required = false;
        inputNewPassword.required = false;

        inputNewPassword.value = '';
        inputOldPassword.value = '';

        inputOldPassword.type = 'password';
        inputNewPassword.type = 'password';

        btn_show_hidden_repeat_password.classList.remove('fa-eye');
        btn_show_hidden_repeat_password.classList.add('fa-eye-slash-repeat');

        btn_show_hidden_password.classList.remove('fa-eye');
        btn_show_hidden_password.classList.add('fa-eye-slash');

    }
}

const formEditProfile = document.getElementById('formEditProfile');
formEditProfile.addEventListener('submit', function (e) {
    e.preventDefault();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let oldPassword = document.getElementById('oldPassword').value;
    let newPassword = document.getElementById('newPassword').value;
    let statusChangePassword = document.getElementById('chboxChangePassword');



});


