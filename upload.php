<?php
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Gestion de documentos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/upload.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/upload.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center;">Datos de documentación</h1>
            </div>
        </div> 
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="message"></div>
                <form id="documentacion">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" rows="6" cols="49"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Archivo</label>
                        <input id="document" type="file" class="form-control">
                    </div>

                    <button type="button" id="back" onclick="history.go(-1);" class="btn btn-warning mb-3">Regresar</button>
                    <button type="button" id="btn" class="btn btn-primary mb-3">Enviar</button>                   
                </form>
            </div>
            <div class="col-3"></div>
        </div>

    </body>

    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>