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

    <body onload="areas(), estados(), select(), validate()">
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
                    <?php
                    if (isset($_GET['documento']) && $_SESSION['id_perfil'] == 2) {
                    ?>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Documento</label>
                            <input type="text" class="form-control" id="documento" value="<?php echo $_GET['documento'] ?>" readonly>
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" rows="6" cols="49"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Área</label>
                        <select id="areas" class="form-select" aria-label="Default select example">
                            <option selected>Seleccione</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Archivo</label>
                        <input id="document" type="file" class="form-control">
                    </div>

                    <?php
                    if (isset($_GET['documento']) && $_SESSION['id_perfil'] == 2) {
                    ?>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Estado</label>
                            <select id="estados" class="form-select" aria-label="Default select example">
                                <option selected>Seleccione</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Observación</label>
                            <textarea type="text" class="form-control" id="observacion" rows="6" cols="49"></textarea>
                        </div>
                    <?php } ?>
                    <button type="button" id="back" onclick="history.go(-1);" class="btn btn-warning mb-3">Regresar</button>
                    <button type="button" id="btn" class="btn btn-primary mb-3">Guardar</button>
                    <button type="button" id="btnEdit" class="btn btn-primary mb-3">Editar</button>
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