$(document).ready(function () {

    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 400,
            height: 400,
            type: 'square' //circle
        },
        boundary: {
            width: 500,
            height: 500
        }
    });

    $('#fileToUpload').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        };
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    let nome = $('#userIDhidden').val();

    $('.crop_image').click(function (event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "scripts/upload_img.php",
                type: "POST",
                data: {
                    "image": response,
                    "name": nome
                },
                success: function (data) {
                    $('#uploadimageModal').modal('hide');
                    $('#img_perf').html(data);
                }
            });
            $(document).ajaxStop(function(){
                window.location.reload();
            });
        })
    });

});