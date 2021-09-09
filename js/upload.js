$(document).ready(function () {

    $('#btn').click(function (e) {
        var file_data = $("#document").prop("files")[0];
        var descripcion = $("#descripcion").val();
        var form_data = new FormData();
        form_data.append("file", file_data);
        form_data.append("descripcion", descripcion);
        $.ajax({
            url: "./model/upload.php",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                var resp = JSON.parse(response);
                if (resp.code == '200') {
                    $('.message').html('<p class="success">' + resp.message + '</p>');
                    $('#documentacion').trigger("reset");
                } else {
                    $('.success').hide();
                    $('.error').show();
                    $('.message').html('<p class="error">' + resp.message + '</p>');
                }
            }
        });

    });

});