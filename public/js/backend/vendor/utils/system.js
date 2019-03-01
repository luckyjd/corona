$(document).ready(function () {
    $('form').on('submit', function (e) {
        $(this).attr('show-loading') == 1 ? showLoading() : null;
        e.preventDefault();
        var that = this;
        if(!isMobile()){
            return $(that).off('submit').submit();
        }
        setTimeout(function () {
            hideLoading();
            return $(that).off('submit').submit();
        },1000);
        $(this).attr('show-loading') == 1 ? showLoading() : null;
        return false;
    });
    // upload image
    $(".input-image").change(function () {
        previewFile(this);
    });
    $(".input-image2").change(function () {
        previewFile2(this);
    });
    //date picker
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
        language: 'ja'
    });
    // time picker
    $('.timepicker').timepicker({
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false,
        defaultTime: ''
    });
    // phone format
    $(".telephone").mask("999-999-9999");
    // search location by name on google map
    $('.google_map_search_by_name').on('keydown', function () {
        setTimeout(function(){
            GoogleMap.searchByName($('.google_map_search_by_name').val(), $('.station-lat-lng'));
        }, 1000);
    });
});

//modal delete confirm
$(document).ready(function () {
    //delete
    $('.delete-action').on('click', function () {
            var href = $(this).data('action');
            $('#del_form').attr('action', href);
        }
    );
    // mass destroy
    $('.mass-destroy-btn').on('click', function () {
        var href = $(this).data('action');
        $('#mass_del_form').attr('action', href);
        pushItemToDestroy();
    });
    $("#check_all_mass_destroy").click(function () {
        $(".mass-destroy").prop('checked', $(this).prop('checked')).trigger('change');
    });
    $(".mass-destroy").on('change', function () {
        if ($(".mass-destroy:checked").length > 0) {
            $('.mass-destroy-btn').removeClass('disabled');
        } else {
            $('.mass-destroy-btn').addClass('disabled');
        }
    });

    function pushItemToDestroy() {
        var ids = [];
        $(".mass-destroy:checked").each(function () {
            ids.push($(this).val());
        });
        $('#mass_destroy_id').val(ids.join(','));
    }

    // close
    $('.close-parent-modal').on('click', function () {
        var parent = $(this).data('parent-modal');
        $('#' + parent).find('.close').click();
    });
});
//  sorting
$('.sorting').on('click', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    if (!url) {
        return false;
    }
    return window.location.href = url;
});

// /reset btn

$('a.reset').on('click', function (e) {
    e.preventDefault();
    var form = $(this).closest('form');
    var href = $(form).attr('action');
    return window.location.href = href;
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$('#load').click(function () {
    var $this = $(this);
    $this.button('loading');
    setTimeout(function() {
        $this.button('reset');
    }, 2000);
});

var SystemController = {
    checkValidate : function (e) {
        var url = $(e).attr("data-url"),
            modal = $(e).attr("data-target"),
            form = $(e).closest('form'),
            formData = new FormData($(form)[0]);

        sendRequest({
            url: url,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,

            type: 'POST'
        }, function (response) {
            console.log(response);
            if (response.status) {
                $(modal).find('.modal-body').html(response.data.modalForm);
                $(modal).modal('show');
            } else {
                $(form).submit();
            }
        });
    }
};
