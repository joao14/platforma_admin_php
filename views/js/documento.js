$(document).ready(function() {

    $('#btn').click(function(e) {
        var file_data = $("#document").prop("files")[0];
        var descripcion = $("#descripcion").val();
        var area = $("#areas").children("option:selected").val();
        var form_data = new FormData();
        form_data.append("file", file_data);
        form_data.append("descripcion", descripcion);
        form_data.append("area", area);
        form_data.append("action", "S");
        $.ajax({
            url: "../controllers/documento.php",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
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

    $('#btnEdit').click(function(e) {
        var documento = $("#documento").val();
        var estado = $("#estados").children("option:selected").val();
        var observacion = $("#observacion").val();
        var form_data = new FormData();
        form_data.append("documento", documento);
        form_data.append("estado", estado);
        form_data.append("observacion", observacion);
        form_data.append("action", "E");
        $.ajax({
            url: "../controllers/documento.php",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                var resp = JSON.parse(response);
                if (resp.code == '200') {
                    $('.message').html('<p class="success">' + resp.message + '</p>');
                } else {
                    $('.success').hide();
                    $('.error').show();
                    $('.message').html('<p class="error">' + resp.message + '</p>');
                }
            }
        });

    });

});

function data() {
    var form_data = new FormData();
    form_data.append("action", "RDS");
    $.ajax({
        url: "../controllers/documento.php",
        dataType: 'text',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(response) {
            $('#documents > tbody:last-child').append(response);
        }
    });
}

function areas() {
    var form_data = new FormData();
    form_data.append("type", "A");
    $.ajax({
        url: "../controllers/configuration.php",
        dataType: 'text',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(response) {
            $('#areas').append(response);
        }
    });
}

function estados() {
    var form_data = new FormData();
    form_data.append("type", "E");
    $.ajax({
        url: "../controllers/configuration.php",
        dataType: 'text',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(response) {
            $('#estados').append(response);
        }
    });
}

function select() {
    var documento = $("#documento").val();
    var form_data = new FormData();
    form_data.append("documento", documento);
    form_data.append("action", "R");
    $.ajax({
        url: "../controllers/documento.php",
        dataType: 'text',
        data: form_data,
        processData: false,
        contentType: false,
        type: 'post',
        success: function(response) {
            var resp = JSON.parse(response);
            $('#descripcion').text(resp.descripcion);
            $('#observacion').text(resp.observacion);
            $("#areas > option").each(function() {
                if (resp.id_area == this.value) {
                    $('#areas').val(resp.id_area);
                }
            });
            $("#estados > option").each(function() {
                if (resp.id_estado == this.value) {
                    $('#estados').val(resp.id_estado);
                }
            });
        }
    });
}

function validate() {
    var documento = $("#documento").val();
    $('#btnEdit').hide();
    if (documento != undefined) {
        $("#descripcion").prop('disabled', true);
        $("#areas").prop('disabled', true);
        $('#btn').hide();
        $('#btnEdit').show();
    }
}