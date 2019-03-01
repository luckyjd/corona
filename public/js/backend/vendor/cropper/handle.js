var previewFileCrop2 = null;
window.addEventListener('DOMContentLoaded', function () {
    var image = document.getElementById('image');
    var $modal = $('#modal_crop');
    var cropper;
    var input = null;
    var file = null;
    $(".img-crop").change(function () {
        previewFileCrop2(this);
    });

    previewFileCrop2 = function(e) {
        input = e;
        if (!input.files || !input.files[0]) {
            return false;
        }
        var htmlName = $(input).attr('id').replace(/^uploadFile-/, '').replace(/\./g, '\\.');
        var previewId = '#preview-file-' + htmlName;

        if (!validateFile(input)) {
            input.value = '';
            $(previewId).find('input[type="hidden"]').val('');
            return false;
        }
        clearFlash();
        var files = e.files;
        var done = function (url) {
            e.value = '';
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        if (!files || files.length <= 0) {
            return false;
        }
        file = files[0];
        if (!isVideo(file)) {
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
            return true;
        }

        var ext = input.value.substr(input.value.lastIndexOf('.') + 1).toLowerCase();
        var htmlName = $(input).attr('id').replace(/^uploadFile-/, '').replace(/\./g, '\\.');
        var previewId = '#preview-file-' + htmlName;
        var fileName = file.name !== undefined ? file.name : '';

        var loaded =  function (fileName) {
            $(previewId).closest('form').find('#file-name').empty().html(fileName);
        };
        // remove img and video exist
        $(previewId).find('img').remove();
        $(previewId).find('video').remove();

        showVideoAfterUpload(input, file, fileName, loaded, $(previewId));
        if (ext != 'mp4') {
            return convertMedia(ext, input, fileName, loaded, $(previewId));
        }
    }

    $modal.on('shown.bs.modal', function () {
        var type = $('select[name="type"]').val(),
            ratio, widthCropBox, heightCropBox,
            cropBoxDimension = [
                {
                    width: 212,
                    height: 248,
                    ratio: 0.85483870967
                },
                {
                    width: 279,
                    height: 150,
                    ratio: 1.86
                }
            ];
        ratio = cropBoxDimension[0].type;
        widthCropBox = cropBoxDimension[0].width;
        heightCropBox = cropBoxDimension[0].height;
        if (type == 1) {
            ratio = cropBoxDimension[1].type;
            widthCropBox = cropBoxDimension[1].width;
            heightCropBox = cropBoxDimension[1].height;
        }
        cropper = new Cropper(image, {
            viewMode: 3,
            aspectRatio: ratio,
            autoCropArea: 1,
            restore: true,
            rotatable: true,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
            dragMode: 'move',
            data: {
                width: widthCropBox,
                height: heightCropBox,
            },
            minCropBoxWidth: widthCropBox,
            minCropBoxHeight: heightCropBox,
        });
    });

    $modal.on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        input.value = '';
    });

    document.getElementById('crop').addEventListener('click', function () {
        $modal.modal('hide');
        var htmlName = $(input).attr('id').replace(/^uploadFile-/, '').replace(/\./g, '\\.');
        var previewId = '#preview-file-' + htmlName;
        // remove img and video exist
        $(previewId).find('img').remove();
        $(previewId).find('video').remove();
        createCropPreview(input, file, $(previewId), function (fileName) {
            $(previewId).closest('form').find('#file-name').empty().html(fileName);
        });
    });

    function createCropPreview(input, file, container, loaded) {
        var canvas;
        var $wrapper = $(container);
        var fileName = file.name !== undefined ? file.name : '';
        if (cropper) {
            canvas = cropper.getCroppedCanvas();
            var $img = $(document.createElement('img'));
            var src = canvas.toDataURL();
            $img.attr('src', src);
            // change file name upload
            $wrapper.append($img);
            loaded(fileName);
            save(input, container, src);
        }
    }

    function save(input, container, src) {
        try {
            _save(input, container, src, function () {
                sendRequest({
                        url: window.saveCropImgTmpFile,
                        type: 'POST',
                        data: {'filename': src},
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
                        _save(input, container, response.data.file_path, function () {
                            
                        });
                        // init tmp
                        if (tmp.length > 0) {
                            tmp.val(response.data.file_path);
                        } else {
                            var tmpName = 'tmp_file[' + name + ']';
                            container.append('<input type="hidden" name="' + tmpName + '" value="' + response.data.file_path + '">');
                        }
                    });
            });
        }catch (e) {
            input.value = '';
            container.find('input[type="hidden"]').val('');
        }
        return true;
    }

    function _save(input, container, src, callback) {
        input.value = '';
        container.find('input[type="hidden"]').val('');
        // init crop
        var crop = container.find('.crop-value');
        if (crop.length > 0) {
            crop.val(src);
        } else {
            container.append('<input class="crop-value" type="hidden" name="' + input.name + '" value="' + src + '">');
        }
        callback();
    }
});