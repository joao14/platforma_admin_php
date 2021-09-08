<?php
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {

?>
     <!DOCTYPE html>
     <html>

     <head>
          <title>Dashboard Documentos</title>
          <link rel="stylesheet" type="text/css" href="css/style.css">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
          <script src="./js/jquery.js"></script>
          <script src="./js/bootstrap.min.js"></script>
          <script>  
               $(document).ready(function() { 
                    $('#btn').click(function(e) { 
                         alert('A).- enviando infor :)'); 
                         var file_data = $("#document").prop("files")[0];
                         var form_data = new FormData();
                         form_data.append("file", file_data);
                         alert(form_data);
                         $.ajax({
                              url: "model/upload.php",
                              dataType: 'text',
                              cache: false,
                              contentType: false,
                              processData: false,
                              data: form_data,
                              type: 'post',
                              success: function(php_script_response) {
                                   alert("works"); 
                                   alert(php_script_response);
                              }
                         });

                    });
               });
          </script>

     </head>

     <body>
          <h1>Bienevenido, <?php echo $_SESSION['nombres']; ?></h1>
          <form>
               <div class="form-group">
                    <label for="exampleFormControlFile1">Descripción</label>
                    <input type="text" class="form-control-file">
                    <label for="exampleFormControlFile1">Archivo</label>
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