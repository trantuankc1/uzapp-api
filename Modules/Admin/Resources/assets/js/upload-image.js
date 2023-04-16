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
            $('.box-show-upload').removeClass('d-none').css('height', '148px');
            setTimeout(function () {
                $('.box-upload').css('visibility', 'hidden');
            }, 1000);
        },
        error: function (error) {
            $('.error-block.image').html(error.responseJSON.meta.message);
        }
    });
});


