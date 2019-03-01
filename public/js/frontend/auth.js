$(function () {// ready
    if (getUrlParameter('from_social')){
        var urlLogin = location.protocol + '//' + location.host + location.pathname;
        history.pushState(null, null, urlLogin);
        $('#login_dialog input[name="email"]').val('');
    }

    $('#login_dialog').on('hidden.bs.modal', function () { // auto reset form when hidden
        clearForm($('#form_login'));
        $('#login_dialog .ajax_msg.auto-reset').text('');
    });

    $('#register_user_dialog [data-dismiss="modal"]').on('click', function () { // auto reset form when close modal
        clearForm($('#form_register_user'));
        $('#form_register_user').find('button.btn-register-user').attr('disabled', true);
    });

    $('#request_reset_password_dialog [data-dismiss="modal"]').on('click', function (e) {
        $('#request_reset_password_dialog .auto-reset').text('');
    });

    checkAgreementBeforeSubmit();

    $('#form_login').on('submit', function () {
        LoginController.ajaxLogin();
    });
    $('#form_request_reset_password').on('submit', function () {
        ForgotPasswordController.ajaxSendResetLinkEmail();
    });
    $('#form_reset_password').on('submit', function () {
        ResetPasswordController.ajaxResetPassword();
    });
    $('#form_register_user').on('submit', function () {
        RegisterController.ajaxRegisterUser();
    });


});
function checkAgreementBeforeSubmit() {
    $('#cb_agreement').on('change', function () {
        if ($(this).is(':checked')){
            $('.btn-register-user').attr('disabled', false);
        }else {
            $('.btn-register-user').attr('disabled', true);
        }
    })
}

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
function clearForm($form) {
    $form.find(':input[type="text"], :input[type="email"], :input[type="password"], :input[name="from_social"]').val('');
    $form.find(':checkbox, :radio').prop('checked', false);
    $form.find('select[name="address1"]').val('');
    $form.find('.auto-reset').text('');
}

// LoginController
var LoginController = {
    ajaxLogin : function () {
        $('#register_user_success_msg').text('');
        var form = $('#form_login'),
            url = form.attr('action'),
            currentModal = '#login_dialog',
            formData = new FormData($(form)[0]);

        sendRequest({
            url: url,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            type: 'POST'
        }, function (response) {
            hideLoading();
            if (!response.status) { // login invalid - show error
                form.find('input[name="password"]').val('');
                return showFlashMessages(response.message, currentModal +' .ajax_msg');
            }else {
                window.location.href = '/my-page';
            }
        });
    },

};

var RegisterController = {
    ajaxRegisterUser : function () {
        var form = $('#form_register_user'),
            url = form.attr('action'),
            currentModal = '#register_user_dialog',
            targetModal = '#login_dialog', // if success  - open login dialog
            formData = new FormData($(form)[0]);

        sendRequest({
            url: url,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            type: 'POST'
        }, function (response) {
            hideLoading();
            if (!response.status) { // register invalid - show error
                form.find('input[name="password"]').val('');
                return showFlashMessages(response.message, currentModal +' .ajax_msg');
            } else { // register success  - then open login dialog
                var email = $(currentModal).find('input[name="email"]').val();
                $(targetModal).find('input[name="email"]').val(email);
                $(currentModal).modal('hide');
                clearForm($(currentModal));
                $(targetModal).modal('show');
                // showFlashMessages(response.message, targetModal +' .ajax_msg', 'success');
            }
        });
    }


};
var ForgotPasswordController = {
    ajaxSendResetLinkEmail : function () {
        event.preventDefault();
        var form = $('#form_request_reset_password'),
            url = form.attr('action'),
            currentModal = '#request_reset_password_dialog',
            // targetModal = '#',
            formData = new FormData($(form)[0]);

        sendRequest({
            url: url,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            type: 'POST'
        }, function (response) {
            hideLoading();
            if (!response.status) { // show error
                return showFlashMessages(response.message, currentModal + ' .ajax_msg');
            } else { // success
                $(currentModal).find('input[name="email"]').val('');
                showFlashMessages(response.message, currentModal +' .ajax_msg', 'success');
            }
        });
    }
};

var ResetPasswordController = {
    ajaxResetPassword : function () {
        event.preventDefault();
        var form = $('#form_reset_password'),
            url = form.attr('action'),
            currentModal = '#reset_password_dialog',
            targetModal = '#login_dialog', // if success  - open login dialog
            formData = new FormData($(form)[0]);

        sendRequest({
            url: url,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            type: 'POST'
        }, function (response) {
            hideLoading();
            if (!response.status) { // show error
                return showFlashMessages(response.message, currentModal + ' .ajax_msg');
            } else { // success
                $(currentModal).remove();
                $(targetModal).modal('show');
                showFlashMessages(response.message, targetModal +' .ajax_msg', 'success');
            }
        });
    }
};

$(document).ready(function () {
    if ($('modal').modal({ show: true})){
        $('modal').fadeIn();
        $('body').addClass('modal-open');
    }if ($('modal').modal({ show: false})) {
        $('modal').fadeOut();
        $('body').removeClass('modal-open');
    }
});

$(document).ready(function () {
    // off swipe when show modal
    $('.modal').on('shown.bs.modal', function (e) {
        $('html').addClass('freezePage');
        $('body').addClass('freezePage');
        $('body').removeClass('modal-open');
        $('body').addClass('modal-open');
    });

    // on swipe when hidden modal
    $('.modal').on('hidden.bs.modal', function (e) {
        $('html').removeClass('freezePage');
        $('body').removeClass('freezePage');
    });
});