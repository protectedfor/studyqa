$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('.removeNews').on('click', function (e) {
        e.preventDefault();
        var self = $(this);
        if (confirm('Вы уверены что хотите удалить?')) {
            self.next().submit();
        }
    });

    $('.addPicture').on('click', function (e) {
        e.preventDefault();
        $(this).next().click();
    });

    $('.pictureField').on('change', function (e) {
        var formData = new FormData;
        formData.append('image', e.target.files[0]);
        $.ajax({
            url: '/pictures',
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                window.location.reload();
            }
        });
    });

    $('.removeImage').on('click', function (e) {
        e.preventDefault();
        var self = $(this);
        if (confirm('Вы уверены что хотите удалить изобарение?')) {
            self.next().submit();
        }
    });

    $('#animated-thumbnails').lightGallery({
        thumbnail: true,
        selector: '.light-picture'
    });
});