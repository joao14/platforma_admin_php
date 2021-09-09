$(document).ready(function () {

});

function data() {
    $.ajax({
        url: "./model/home.php",
        dataType: 'text',
        type: 'post',
        success: function (response) {
            $('#documents > tbody:last-child').append(response);
        }
    });
}
