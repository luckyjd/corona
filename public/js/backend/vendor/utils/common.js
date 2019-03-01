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

    // remove img and video exist
    $(previewId).find('img').remove();
    $(previewId).find('video').remove();
    createPreview(input, input.files[0], $(previewId), function (fileName) {
        $(previewId).closest('form').find('#file-name').empty().html(fileName);
    });

}

function previewFile2(input) {
    if (!input.files || !input.files[0]) {
        return false;
    }
    var htmlName = $(input).attr('id').replace(/^uploadFile-/, '').replace(/\./g, '\\.');
    var previewId = '#preview-file-' + htmlName;

    if (!validateFile(input)) {
        input.value = '';
        $(previewId).find('img').remove();
        $(previewId).find('input[type="hidden"]').val('');
        return false;
    }
    clearFlash();

    // remove img and video exist
    $(previewId).find('img').remove();
    $(previewId).find('video').remove();
    createPreview(input, input.files[0], $(previewId), function (fileName) {
        $(previewId).closest('form').find('#file-name').empty().html(fileName);
    });
}

function isVideo(file) {
    var type = file.type.replace(/\/.*$/, '');
    return type === 'video';
}

function showVideoAfterUpload(input, file, fileName, loaded, container) {
    var $wrapper = $(container);
    var $video = $(document.createElement('video'));
    $video.attr('controls', '');
    var $source = $(document.createElement('source'));
    $source.attr('src', typeof file == 'string' ? file : URL.createObjectURL(file));

    $video.append($source);
    $wrapper.append($video);
    $video.load();
    loaded(fileName);
}

function convertMedia(ext, input, fileName, loaded, container) {
    try {
        var formData = new FormData(document.getElementById('convert_form'));
        formData.append('filename', input.files[0]);
        sendRequest({
                url: window.convertMediaUrl + '?from_type=' + ext,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                beforeSend: function () {

                }
            },
            function (response) {
                input.value = '';
                container.find('input[type="hidden"]').val('');
                if (!response.status) {
                    return showErrorFlash(response.message);
                }
                var name = input.id.replace('uploadFile-', '');
                var tmp = container.find('input[name="tmp_file*"]');
                var crop = container.find('.crop-value');
                // init tmp
                if (tmp.length > 0) {
                    tmp.val(response.data.file_path);
                } else {
                    var tmpName = 'tmp_file[' + name + ']';
                    container.append('<input type="hidden" name="' + tmpName + '" value="' + response.data.file_path + '">');
                }
                // init crop
                if (crop.length > 0) {
                    crop.val(response.data.file_path);
                } else {
                    container.append('<input class="crop-value" type="hidden" name="' + input.name + '" value="' + response.data.file_path + '">');
                }
            });
    }catch (e) {
        input.value = '';
        container.find('input[type="hidden"]').val('');
    }
    return true;
}


function createPreview(input, file, container, loaded) {
    var $wrapper = $(container);

    var fileName = file.name !== undefined ? file.name : '';
    if (!isVideo(file)) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // create temporary img tag
            var $img = $(document.createElement('img'));
            $img.attr('src', e.target.result);
            $img.attr('height', '250');

            // change file name upload
            $wrapper.append($img);

            loaded(fileName);
        };
        reader.readAsDataURL(file);
    } else {
        // convert to mp4
        var ext = input.value.substr(input.value.lastIndexOf('.') + 1).toLowerCase();
        showVideoAfterUpload(input, file, fileName, loaded, container);
        if (ext != 'mp4') {
            return convertMedia(ext, input, fileName, loaded, container);
        }
    }
}

function validateFile(input) {
    var sizeAllow = input.getAttribute('size') + '';
    var extAllow = input.getAttribute('ext') + '';
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
    map: null,
    pref: {},
    address: {},
    addressType: ["administrative_area_level_1", "political"],
    postCode: ['postal_code'],
    createMapWithMarker: function (elementId, latLngWrapper, latitude, longitude) {
        // create google map
        var map = new google.maps.Map(document.getElementById(elementId), {
            zoom: 17,
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
        GoogleMap.map = map;
    },
    dragMarker: function (element, marker) {
        if (!GoogleMap.enabledDragMarker || element.length <= 0) {
            marker.setDraggable(false);
            return;
        }
        google.maps.event.addListener(marker, 'dragend', function (event) {
            // change display latitude, longitude
            element.val(event.latLng.lat().toFixed(6) + ',' + event.latLng.lng().toFixed(6));
            GoogleMap.getReverseGeocodingData(marker.getPosition());
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
    },
    getReverseGeocodingData: function (latLng) {
        var geoCoder = new google.maps.Geocoder();
        geoCoder.geocode({'latLng': latLng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var place = results[0].address_components,
                    postCode = place[place.length - 1];
                if (postCode.long_name) {
                    GoogleMap.bindPrefByPostCode(postCode.long_name);
                }
            }
        });
    },
    bindPrefByPostCode: function (postCode) {
        var zipCode = postCode.split('-'),
            tmpCode = postCode.replace('-', '');
        if ($('#tmp_zip_code').val() != tmpCode) {
            zipCode ? $('#zipFirst').val(zipCode[0]) : null;
            zipCode ? $('#zipSecond').val(zipCode[1]) : null;
            $('#tmp_zip_code').val(tmpCode);
            AjaxZip3.zip2addr('tmp_zip_code', null, 'm_area_id', 'address_jp', '', '');
        }
    },
    searchByName: function (name, latLngWrapper) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': name}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                GoogleMap.removeMarker();
                GoogleMap.addMarker(GoogleMap.map, latLngWrapper, results[0].geometry.location);
                GoogleMap.map.setCenter(results[0].geometry.location);
                latLngWrapper.val(results[0].geometry.location.lat().toFixed(6) + ',' + results[0].geometry.location.lng().toFixed(6));
            }
        });
    }
};