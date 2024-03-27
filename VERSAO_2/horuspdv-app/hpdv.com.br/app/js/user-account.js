$('#select_delete_user').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});
$('#select_user_permission').select2({
    theme: "bootstrap-5",
    language: "pt-BR",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

cpfMask(cpfMask(document.querySelector('#cpf')));


const formNewUser = document.getElementById('formNewUser');
formNewUser.addEventListener('submit', function (e) {
    e.preventDefault();

    let cpf = document.getElementById('cpf').value;
    let cpf_replace = cpf.replace(/\D/g, '');
    let name = document.getElementById('customer-client').value;
    let email = document.getElementById('email');
    let user_access = document.getElementById('user-access').value;
    let csrf_token = document.querySelector('input[name="csrf_token"]').value;
    let action = document.querySelector('input[name="create_user"]').value;

    if (cpf === '' || name === '' || email.value === '' || user_access === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Preencha todos os campos'
        });
        return;
    }

    if (cpf.length < 11 || cpf.length > 14 || !cpfValidation(cpf_replace)) {
        Swal.fire({
            icon: 'warning',
            text: 'CPF inválido'
        })
    }

    if (!emailValidation(email)) {
        Swal.fire({
            icon: 'warning',
            text: 'Email inválido'
        })
    }

    if (user_access.length < 3) {
        Swal.fire({
            icon: 'warning',
            text: 'Mínimo de 3 caracteres para o campo de acesso'
        })
    }

    else {
        showLoading();

        newUserValues = {
            cpf: cpf,
            name: name,
            email: email.value,
            user_access: user_access,
            csrfToken: csrf_token,
            action: action
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/user_account_controller.php',
            async: true,
            data: newUserValues,

            success: function (response) {
                if (response.error) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: response.message
                    });
                }
                if (response.success) {
                    hideLoading();
                    Swal.fire({
                        icon: 'success',
                        text: response.message,
                        confirmButtontext: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao cadastrar usuário'
                });
            }
        });

    }
});


const formDeleteUser = document.getElementById('formDeleteUser');
formDeleteUser.addEventListener('submit', function (e) {
    e.preventDefault();

    let user_id = document.getElementById('select_delete_user').value;
    let csrf_token = document.querySelector('input[name="csrf_token"]').value;
    let action = document.querySelector('input[name="delete_user"]').value;

    if (user_id === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Selecione um usuário'
        });
        return;
    }

    else {

        Swal.fire({
            icon: 'warning',
            title: "Deseja realmente deletar este usuário?",
            showCancelButton: true,
            confirmButtonText: "Sim",
            cancelButtonText: "Não",
        }).then((result) => {

            if (result.isConfirmed) {
                showLoading();

                deleteUserValues = {
                    user_id: user_id,
                    csrfToken: csrf_token,
                    action: action
                }

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controllers/user_account_controller.php',
                    async: true,
                    data: deleteUserValues,

                    success: function (response) {
                        if (response.error) {
                            hideLoading();
                            Swal.fire({
                                icon: 'error',
                                text: response.message
                            });
                        }
                        if (response.success) {
                            hideLoading();
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                confirmButtontext: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function (response) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            text: 'Erro ao deletar usuário'
                        });
                    }
                });

            } else if (result.isDenied) {
                return;
            }
        });
    }
});


const formUserPermission = document.getElementById('formUserPermission');
formUserPermission.addEventListener('submit', function (e) {
    e.preventDefault();

    let user_id = document.getElementById('select_user_permission').value;
    let permission = document.getElementById('select_permission_type').value;
    let csrf_token = document.querySelector('input[name="csrf_token"]').value;
    let action = document.querySelector('input[name="user_permission"]').value;

    if (user_id === '' || permission === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Selecione um usuário e um tipo de permissão'
        });
        return;
    } else {
        showLoading();

        userPermissionValues = {
            user_id: user_id,
            permission: permission,
            csrfToken: csrf_token,
            action: action
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../controllers/user_account_controller.php',
            async: true,
            data: userPermissionValues,

            success: function (response) {
                if (response.error) {
                    hideLoading();
                    Swal.fire({
                        icon: 'error',
                        text: response.message
                    });
                }
                if (response.success) {
                    hideLoading();
                    Swal.fire({
                        icon: 'success',
                        text: response.message,
                        confirmButtontext: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            },
            error: function (response) {
                hideLoading();
                Swal.fire({
                    icon: 'error',
                    text: 'Erro ao alterar permissão do usuário'
                });
            }
        });
    }
});

