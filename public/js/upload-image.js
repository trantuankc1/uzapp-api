$('.box-upload').on('click', function () {
    $(this).find('input:file')[0].click();
});

$('#choseImg').on('change', function () {
    let formData = new FormData();
    formData.append('image', $(this)[0].files[0]);

    $.ajax({
        url: '/api/admin/products/upload-img',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (response) {
            $('#image').val(response.data.path);
            $('.box-show-upload img').attr('src', response.data.path);
            $('.box-show-upload').removeClass('d-none');
            setTimeout(function () {
                $('.box-upload').removeClass('visible').addClass('invisible');
            }, 300);
        },
        error: function (error) {
            $('.error-block.image').html(error.responseJSON.meta.message);
        }
    });
});

$('.item-delete').on('click', function () {
    $('.box-show-upload').addClass('d-none');
    $('.box-upload').removeClass('invisible').addClass('visible');
});
