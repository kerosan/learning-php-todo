$(document).ready(function () {
    var inputName;
    var inputEmail;
    var inputText;
    var inputFile;
    var imgUrl;

    $('#inputFile').fileupload({
        url: '/todo/upload',
        dataType: 'json',
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator && navigator.userAgent),
        imageMaxWidth: 320,
        imageMaxHeight: 240,
        imageCrop: true, // Force cropped images
        add: function (e, data) {
            var jqXHR = data.submit()
                .success(function (result, textStatus, jqXHR) {
                    // console.log('success', result);
                    inputFile = result.files;
                    imgUrl = result.files[0]['url'];
                })
                .error(function (jqXHR, textStatus, errorThrown) {
                    console.error('error', jqXHR, textStatus, errorThrown)
                })
                .complete(function (result, textStatus, jqXHR) {
                    // console.log('complete', result, textStatus, jqXHR)
                });
        }
    });
    $('.preview .panel').collapse({toggle: false});
    $('#clearForm').on('click', function () {
        $('#inputName').val('');
        $('#inputEmail').val('');
        $('#inputText').val('');
        $('#inputFile').val('');
        imgUrl = '';
        $('.preview .panel').collapse('hide');
    });

    $('#selectFile').on('click', function () {
        $('#inputFile').click();
    });

    $('#previewForm').on('click', function () {
        $('#previewName').text($('#inputName').val());
        $('#previewEmail').text($('#inputEmail').val());
        $('#previewText').text($('#inputText').val());
        if (!$('#inputFile').val() && !imgUrl) {
            $('#previewImage').addClass('hidden');
        } else {
            $('#previewImage').removeClass('hidden');
            $('#previewPicture').attr({
                src: imgUrl,
                title: "preview",
                alt: "pic",
                width: "320",
                height: "240"
            });
        }
        $('.preview .panel').collapse('show');

    });

    $('#saveForm').on('click', function () {
        $('.preview .panel').collapse('hide');

        inputName = $('#inputName').val();
        inputEmail = $('#inputEmail').val();
        inputText = $('#inputText').val();
        // if(!inputName) $('#inputName').removeClass('has-error');
        // if(!inputEmail) $('#inputEmail').removeClass('has-error');
        // if(!inputText) $('#inputText').removeClass('has-error');
        // inputFile = $('#inputFile').val();
        if (inputName && inputEmail && inputText) {
            var data = {name: inputName, email: inputEmail, text: inputText, file: inputFile};
            console.log(data);
            $.ajax({
                type: "POST",
                url: '/todo/create',
                data: {name: inputName, email: inputEmail, text: inputText, file: inputFile},
                success: function (data) {
                    if (JSON.parse(data).success) {
                        window.location.href = '/';
                        // location.reload();
                    }
                }
            });
        } else {
            // if(!inputName) $('#inputName').addClass('has-error');
            // if(!inputEmail) $('#inputEmail').addClass('has-error');
            // if(!inputText) $('#inputText').addClass('has-error');
            // @todo implement validation
        }
    });



});

function updateTask(id, ready, text) {
    $.ajax({
        type: "POST",
        url: '/todo/update',
        data: {id: id, text: text, ready: ready},
        success: function (data) {
            if (JSON.parse(data).success) {
                // window.location.href = '/';
                location.reload();
            }
        }
    });
}

function openModal(id, ready, text) {
    $('#editMessageModal').modal('show');
    $('.modal-title').text('Edit message (Task #' + id + ')');
    $('.modal-body > .form-control').text(text);
    $('#modalSave').on('click', function () {
        updateTask(id, ready, $('.modal-body > .form-control').val());
        $('#editMessageModal').modal('hide');
    })
}
