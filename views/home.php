<?php
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {

?>
     <!DOCTYPE html>
     <html>      
     
     <head>
          <title>Dashboard Documentos</title>
          <link rel="stylesheet" type="text/css" href="css/home.css">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
          <script src="js/jquery.js"></script>  
          <script src="js/bootstrap.min.js"></script>  
          <script src="js/home.js"></script>  
          <link rel="stylesheet" type="text/css" href="css/upload.css">  
          <link href="css/bootstrap.min.css" rel="stylesheet">  
     </head>

     <body onload="data()">

          <div class="row">    
               <div class="col-10">
                    <h1>Bienvenido, <?php echo $_SESSION['nombres']; ?></h1>
               </div>
               <div class="col-2">
                    <a href="../models/logout.php" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Salir</a>
               </div>

          </div>

          <div class="row">
               <div class="col-1"></div>
               <div class="col-10">
                    <table id="documents" class="table">
                         <thead class="table-success">
                              <tr>
                                   <?php if ($_SESSION['perfil'] == "ADMIN") { ?><th scope="col"></th> <?php } ?>
                                   <th scope="col">#</th>
                                   <th scope="col">Nombre Documento</th>
                                   <th scope="col">Estado</th>
                                   <th scope="col">Fecha Envío</th>
                                   <th scope="col">Descripción</th>
                                   <th scope="col">Observación</th>
                                   <th scope="col">Archivo</th>
                              </tr>
                         </thead>
                         <tbody>

                         </tbody>
                    </table>
               </div>
               <div class="col-1"></div>
          </div>

          <a href="upload.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Agregar Documentos</a>
     </body>

     </html>

<?php 
} else { 
     header("Location: ../index.php");
     exit();
} 
?>