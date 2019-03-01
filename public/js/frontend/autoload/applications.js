var gameDuration = 3500;
$(document).ready(function () {
    presentClick();
    playGameClick();

    $('.btn-register-address-ship').click(function (e) {
        e.preventDefault();
        var id          = $("input[name='id']").val();
        var first_name  = $("input[name='first_name']").val();
        var last_name   = $("input[name='last_name']").val();
        var email       = $("input[name='email']").val();
        var zip1        = $("input[name='zip1']").val();
        var zip2        = $("input[name='zip2']").val();
        var zip_code    = zip1 + zip2;
        var pref_id     = $("select[name='pref_id']").val();
        var address     = $("input[name='address']").val();
        var phone1      = $("input[name='phone1']").val();
        var phone2      = $("input[name='phone2']").val();
        var phone3      = $("input[name='phone3']").val();
        var tel         = phone1 + phone2 + phone3;
        var store_list  = $("input[name='store_list']").val();

        var data = {
            id: id, first_name: first_name, last_name: last_name, email: email, zip_code: zip_code, pref_id: pref_id, address: address, tel: tel, store_list: store_list
        };

        sendRequest({
            url: "/ship/address",
            method: 'POST',
            data: data,
        },function (response) {
            if (!response.status) { // update address ship invalid - show error
                return showFlashMessages(response.message, '#update_address_ship_user_error_msg');
            } else { // update address ship success  - then open login dialog
                $('#ship').modal('hide');
                return window.location.href = '/my-page';
            }

            if (res.message[0] == '401') {
                return $('#login_dialog').modal('show');
            }
        });
    });

    // $('.product-5-point').syncHeight();
    // $('.product-1-point').syncHeight();

    $("input[name='zip1']").on('change', function (e) {
        var postCodeZip1 = $(this).val();
        var postCodeZip2 = $("input[name='zip2']").val();
        var postCode = postCodeZip1+postCodeZip2;
        bindPrefByPostCode(postCode);
    });

    $("input[name='zip2']").on('change', function (e) {
        var postCodeZip2 = $(this).val();
        var postCodeZip1 = $("input[name='zip1']").val();
        var postCode = postCodeZip1+postCodeZip2;
        bindPrefByPostCode(postCode);
    });

    bindPrefByPostCode = function (postCode) {
        if ($('#tmp_zip_code').val() != postCode) {
            $('#tmp_zip_code').val(postCode);
            AjaxZip3.zip2addr('zip1', 'zip2', 'pref_id', 'address', '', '');
        }
    };

    checkAgreement();
    checkAgreementPlayGame();
});

function showShipForm() {
    resetGame(true);
    return $('#ship').modal('show');
}

function playGameClick() {
    $('#btn-play-game').click(function (e) {
        e.preventDefault();
        $('#note').modal('hide');
        var presentId = $("input[name='present_id']").val();
        sendRequest({
            url: "/play-game/" +  presentId,
            method: 'POST',
            beforeSend: function () {
                resetGame(false);
                return play(false, gameDuration, false);
            }
        },function (res) {
            if (res.status) {
                $('#modal-result-container').html(res.data.html);
                $('#presents_one_pt').html(res.data.presents_one_pt);
                $('#presents_five_pt').html(res.data.presents_five_pt);
                $('#user_point').html(res.data.user_point)
                $('#user_info').html(res.data.user_info);
                if (!isMobile()) {
                    syncHeight();
                }
                presentClick();
                if (res.data.is_win) {
                    return play(true, gameDuration, true);
                }
                return play(false, gameDuration, true);
            }

            if (res.message[0] == '401') {
                return $('#login_dialog').modal('show');
            }
        });
    });
}

function setConfWidth() {
    // var w = $('.card-popup__congrate').innerWidth() + 10 + 'px';
    // $('.img-comp-img img').css('width', w);
}

function presentClick() {
    $('.btn-present').click(function (e) {
        e.preventDefault();
        var point = parseInt($('#user_point').text());
        if (point <= 0 || (point < 5 && $(this).data('disable') == 5)) {
            return false;
        }

        $('#cb_agreement_play_game').prop('checked', false).change();
        sendRequest({
            url: "/confirm-play-game/" +  $(this).data("id"),
            method: 'POST',
        }, function (res) {
            if(res.status){
                $("input[name='present_id']").val(res.data.present.id);
                $('#present_confirm_popup').html(res.data.html);
                $('#note').modal('show');
                return true;
            }
            return alert(res.message);
        });
    });

}

function checkAgreement() {
    $("input:checkbox[name='cb_agreement_address_ship[]']").change(function () {
        if ($(this).is(":checked")) {
            $('.btn-register-address-ship').removeAttr("disabled").button('refresh');
        }
        else {
            $('.btn-register-address-ship').attr("disabled", "disabled").button('refresh');
        }
    });
}

function checkAgreementPlayGame() {
    $("input:checkbox[name='cb_agreement_play_game[]']").change(function () {
        if ($(this).is(":checked")) {
            $('.btn-play-game').removeAttr("disabled").button('refresh');
        }
        else {
            $('.btn-play-game').attr("disabled", "disabled").button('refresh');
        }
    });
}

var inter = null;
var countStar = 1;
function play(isWin, timeout, last){
    if (last) {
        clearInterval(inter);
    }
    $('#result').modal('show');
    var container = $('.result-modal').first();
    var limit = $('.star').length;
    inter = setInterval(function () {
        if(countStar >= limit){
            clearInterval(inter);
            if(last){
                showResult(isWin, $(container).innerHeight(), timeout);
            }else {
                resetGame(false);
                play(isWin, timeout, last);
            }
        }
        var e = $('#star'+countStar);
        $(e).css('right',random(-10,container.width() + 10)+'px');
        fallDown(e, container, timeout);
        countStar++;
    },200);
}

function showResult(isWin, height, timeout) {
    $('#modal-result-container').removeClass('over');
    $('#overlay-result').animate({'top': height + 500 + 'px'}, timeout, function () {
        $('.star-success').fadeOut();
        if (isWin) {
            showCon();
            $('.desc-modal').delay(2500).animate({"opacity": "1"}, 1000);
        }else {
            $('.desc-modal').animate({"opacity": "1"}, 500);
        }

    });
    if (isWin) {
        setTimeout(function () {
            setConfWidth();
        },1000);
        $('.card-popup__congrate').fadeIn(3000);
        $('.congrate-btn').delay(1000).fadeIn();
        $('.frozen').delay(2000).fadeIn();
    }
}

function showCon() {
    $('#con1').show();
    var w = $('.img-comp-img img').width();
    $('.img-comp-img img').css('width', w);
    $('.img-comp-img').css({'width': 0, 'opacity': 1});
    $('#con1').animate({"width": "100%"}, 2000, function () {
        $('#modal-result-container').addClass('over');
    });
    $('#con2').delay(2000).animate({"width": "100%"}, 2000, function () {
        $('#con1').fadeOut(1000);
    });
}

function resetGame(hide) {
    if(hide){
        $('#result').modal('hide');
    }
    $('#modal-result-container').html('');
    $('#overlay-result').css('top', '-220px');
    resetStar();
}

function resetStar() {
    $('.star-success').fadeIn();
    countStar = 1;
}

function fallDown(e, container, timeout) {
    var h = $(container).innerHeight();
    var origin = $(e).css('top');
    $(e).animate({"top": h + "px", "opacity": '1'}, timeout, function () {
        $(e).css('top',origin);
    });
}

