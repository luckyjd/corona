function showLoading() {
    $.LoadingOverlay("show", {zIndex: 999999999});
}

function hideLoading() {
    $.LoadingOverlay("hide");
}

function showSuccessFlash(messages) {
    var html = '<hr><div class="row"><div class="col-md-12"><ul class="col-md-12 alert alert-success">';
    if (typeof messages === 'string') {
        html += '<li><i class="fa fa-check"></i><strong>' + messages + '</strong></li>';
    } else {
        messages.forEach(function (e) {
            html += '<li><i class="fa fa-check"></i><strong>' + e + '</strong></li>';
        });
    }
    html += '</ul></div></div>';
    $('#success_msg').html(html);
}

function showErrorFlash(messages) {
    var html = '<div class="alert alert-danger"><ul>';
    if (typeof messages === 'string') {
        html += '<li>' + messages + '</li>';
    } else {
        messages.forEach(function (e) {
            html += '<li>' + e + '</li>';
        });
    }

    html + '</ul></div>';
    $('#error_msg').html(html);
    scrollToTop();
}

function showFlashMessages(messages, selector, alertType) {
    if (!messages || messages === undefined){
        return;
    }
    alertType = alertType ? alertType : 'danger';
    var html = '<div class="alert alert-' + alertType + '"><ul>';
    if (typeof messages === 'string') {
        html += '<li>' + messages + '</li>';
    } else {
        messages.forEach(function (e) {
            html += '<li>' + e + '</li>';
        });
    }

    html + '</ul></div>';
    $(selector).html(html);
}

function clearFlash() {
    clearSuccessFlash();
    clearErrorFlash();
}

function clearErrorFlash() {
    $('#error_msg').html('');
}

function clearSuccessFlash() {
    $('#success_msg').html('');
}

function redirect(url) {
    //todo validate limit redriect by url and tab session
    return url == '' ? window.location.reload() : window.location.href = url;
}

function isUrl(url) {
    url = url.replace('https://', '').replace('http://');
    var currentUrl = getCurrentUrl();
    return currentUrl.indexOf(url) !== -1;
}

function previewFile(input) {
    if (!input.files || !input.files[0]) {
        return false;
    }
    var previewId = '#preview-file-' + $(input).attr('name');

    if (!validateFile(input)) {
        input.value = '';
        $(previewId).find('img').remove();
        $(previewId).find('input[type="hidden"]').val('');
        return false;
    }
    clearFlash();

    var reader = new FileReader();
    reader.onload = function (e) {
        var imgWrapper = $(previewId);
        var imgName = input.files[0].name !== undefined ? input.files[0].name : '';
        // create temporary img tag
        var img = $(document.createElement('img'));
        img.attr('src', e.target.result);
        img.attr('height', '250');

        // remove img exist
        imgWrapper.find('img').remove();
        // change file name upload
        imgWrapper.append(img);
        imgWrapper.closest('form').find('#file-name').empty().html(imgName);
    };
    reader.readAsDataURL(input.files[0]);

}

function validateFile(input) {
    var sizeAllow = input.getAttribute('size');
    var extAllow = input.getAttribute('ext');
    var extsAllow = extAllow.split(',');
    sizeAllow = sizeAllow.split(',');
    var minSize = parseFloat(sizeAllow[0]);
    var maxSize = parseFloat(sizeAllow[1]);

    var file = input.files[0];
    var size = file.size / 1024 / 1024;
    var extension = input.value.substr(input.value.lastIndexOf('.') + 1).toLowerCase();
    var label = input.getAttribute('data-label');
    // file type
    if (extension.length <= 0 || extsAllow.indexOf(extension) === -1) {
        var msg = validateFileMsg._g('mimes').replace(':attribute', label).replace(':values', extAllow);
        showErrorFlash(msg);
        return false;
    }
    // size
    if (size < minSize) {
        var msg = validateFileMsg._g('min').replace(':attribute', label).replace(':min', minSize);
        showErrorFlash(msg);
        return false;
    }
    if (size > maxSize) {
        var msg = validateFileMsg._g('max').replace(':attribute', label).replace(':max', maxSize);
        showErrorFlash(msg);
        return false;
    }

    return true;
}

function fillForm(val) {
    if (val === undefined) {
        val = 1;
    }
    $('form').first().find('input[type!="hidden"],select,textarea').val(val).trigger('change');
}

var GoogleMap = {
    enabledDragMarker: true,
    enableClickMarker: true,
    marker: {},
    createMapWithMarker: function (elementId, latLngWrapper, latitude, longitude) {
        // create google map
        var map = new google.maps.Map(document.getElementById(elementId), {
            zoom: 12,
            center: new google.maps.LatLng(latitude, longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        // create marker
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            draggable: true
        });
        // change marker position when drag or click on map
        GoogleMap.dragMarker(latLngWrapper, marker);
        GoogleMap.clickToChangeMarker(latLngWrapper, map);
        map.setCenter(marker.position);
        marker.setMap(map);
        // save old marker
        GoogleMap.marker = marker;
    },
    dragMarker: function (element, marker) {
        if (!GoogleMap.enabledDragMarker || element.length <= 0) {
            marker.setDraggable(false);
            return;
        }
        google.maps.event.addListener(marker, 'dragend', function (event) {
            // change display latitude, longitude
            element.val(event.latLng.lat().toFixed(6) + ',' + event.latLng.lng().toFixed(6));
        });
    },
    clickToChangeMarker: function (element, map) {
        if (!GoogleMap.enableClickMarker || element.length <= 0) {
            return;
        }
        google.maps.event.addListener(map, 'click', function (event) {
            // remove old marker
            GoogleMap.removeMarker();
            // add new marker
            GoogleMap.addMarker(map, element, event.latLng);
            // change display latitude, longitude
            element.val(event.latLng.lat().toFixed(6) + ',' + event.latLng.lng().toFixed(6));
        });
    },
    addMarker: function (map, latLngWrapper, location) {
        var marker = new google.maps.Marker({
            position: location,
            draggable: true,
            map: map
        });
        GoogleMap.dragMarker(latLngWrapper, marker);
        marker.setMap(map);
        // save old marker
        GoogleMap.marker = marker;
    },
    removeMarker: function () {
        GoogleMap.marker.setMap(null);
    }
};

$.fn.syncHeight = function(){
    var that = this;
    setTimeout(function () {
        return that.height( Math.max.apply(that, $(that).map(function(i,e){ return $(e).height() }).get() ) + 5 )
    },1500);
}

var openingStart02 = function(b, c) {
    bubble();
    var d = $(document.getElementById("bg-wrap"));
    d.css({
        "z-index": "999999999",
        display: "block"
    }).stop().addClass("load-start02");
    setTimeout(function() {
        $("#contents,nav").css({
            opacity: 1
        });
        setTimeout(function() {
            scrollToX('#main');
            if (b) {
                $(".age_logo").css("opacity", 1);
                openingEnd02(c);
            }
        }, 2100)
    }, 400)
};

var openingEnd02 = function(b) {
    var c = $(document.getElementById("bg-wrap"));
    c.removeClass("load-start02");
    setTimeout(function() {
        $("#contents").css({
            transform: "translateY(0)"
        })
    }, 500);
    setTimeout(function() {
        $("#contents").css({
            transform: "initial"
        })
    }, 600);
    setTimeout(function() {
        c.css({
            "z-index": "-1",
            display: "none"
        });
        openAnmRemove();
    }, 1650)
};
var  openAnmRemove = function() {
    $(".bg-wrap").remove()
};
var BUBBLE_FLAG2 = 0;
var bugId = 0;
var BUBBLE_FLAG = false;
var bubble = function() {
    if (BUBBLE_FLAG2 == 0) {
        if (!BUBBLE_FLAG) {
            setTimeout(function() {
                var f = "";
                var f = [];
                var c = [4, 6, 8, 10, 12];
                for (var e = 0; e < $(".bubble-wrap").width(); e++) {
                    f.push(e)
                }

                function d(g) {
                    return g[Math.floor(Math.random() * g.length)]
                }
               bugId = setInterval(function() {
                    var g = d(c);
                    $(".bubble-wrap").append('<div class="individual-bubble" style="left: ' + d(f) + "px; width: " + g + "px; height:" + g + 'px;"></div>');
                    $(".individual-bubble").animate({
                        bottom: "100%",
                        opacity: "-=1"
                    }, 600, function() {
                        $(this).remove()
                    });
                    BUBBLE_FLAG = true
                }, 250)
            }, 100)
        }
    }
    BUBBLE_FLAG2++
};
setTimeout(function () {
    clearInterval(bugId);
    $('.load-logo').addClass('fadeOut');
    setTimeout(function () {
        $('.load-logo').hide();
        $('#bg-wrap').slideUp(1000);
    }, 250);
}, 2000);
openingStart02();

