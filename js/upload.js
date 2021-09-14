$(document).ready(function () {

    $('#btn').click(function (e) {
        var file_data = $("#document").prop("files")[0];
        var descripcion = $("#descripcion").val();
        var area = $("#areas").children("option:selected").val();
        var form_data = new FormData();
        form_data.append("file", file_data);
        form_data.append("descripcion", descripcion);
        form_data.append("area", area);
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

function areas() {
    $.ajax({
        url: "./model/area.php",
        dataType: 'text',
        type: 'post',
        success: function (response) {
            $('#areas').append(response);
        }
    });
}

function estados() {
    $.ajax({
        url: "./model/estado.php",
        dataType: 'text',
        type: 'post',
        success: function (response) {
            $('#estados').append(response);
        }
    });
}

function select() {
    var documento = $("#documento").val();
    var form_data = new FormData();
    form_data.append("documento", documento);
    $.ajax({
        url: "./model/documento.php",
        dataType: 'text',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'post',
        success: function (response) {
            var resp = JSON.parse(response); 
            $('#descripcion').text(resp.descripcion);
            $("#areas > option").each(function() {
                if(resp.id_area==this.value){
                    $('#areas').val(resp.id_area);
                }                
            });
            $("#estados > option").each(function() {
                if(resp.id_estado==this.value){
                    $('#estados').val(resp.id_estado);
                }                
            });
        }
    });
}