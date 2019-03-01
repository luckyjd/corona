$(document).ready(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();
        if ($(this).hasClass('custom-submit')){
            return false;
        }
        $(this).attr('show-loading') == 1 ? showLoading() : null;
        $(this).off('submit').submit();
    });
    // upload image
    $(".input-image").change(function () {
        previewFile(this);
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
    if (!isMobile()) {
        syncHeight();
    }
});

function syncHeight() {

// auto flex height for 1pt present
    autoFlexHeight($('.present-name'));
    autoFlexHeight($('.present-introduction'));

// auto flex height for 5pt present
    autoFlexHeight($('.present5pt-name'));
    autoFlexHeight($('.present5pt-introduction'));
}
function autoFlexHeight(element) {
    var maxHeight = 0;
    element.each(function () {
        var tempHeight = $(this).height();
        if (tempHeight > maxHeight) {
            maxHeight = tempHeight;
        }
    });
    element.each(function () {
        $(this).css({'height': maxHeight});
    });
}

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
})

// import auth.js: - login - register - reset password
$.getScript("public/js/frontend/auth.js", function() {});