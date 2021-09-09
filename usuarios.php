<?php
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {

?>
     <!DOCTYPE html> 
     <html>
 
     <head> 
          <title>Crear usuarios</title> 
          <link rel="stylesheet" type="text/css" href="css/style.css">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
          <script src="./js/jquery.js"></script>
          <script src="./js/bootstrap.min.js"></script>
          <script src="./js/upload.js"></script>
          <link rel="stylesheet" type="text/css" href="css/upload.css">
     </head>

     <body>
          <h1>Bienevenido, <?php echo $_SESSION['nombres']; ?></h1>
          <div class="message"></div>
          <form id="documentacion">
               <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea type="text" class="form-control-file" id="descripcion" rows="6" cols="49"></textarea>
                    <br>
                    <label for="document">Archivo</label>
                    <input id="document" type="file" class="form-control-file">
                    <button type="button" id="btn">Enviar</button>
                    <a href="model/logout.php">Salir</a>
               </div>
          </form>
     </body>

     </html>

<?php
} else {
     header("Location: index.php");
     exit();
}
?>