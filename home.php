<?php
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombres'])) {
  
?>
     <!DOCTYPE html> 
     <html>

     <head> 
          <title>Dashboard Documentos</title>
          <link rel="stylesheet" type="text/css" href="css/style.css">
          <link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
     </head>  

     <body>  
          <h1>Hello, <?php echo $_SESSION['nombres']; ?></h1>
          <a href="model/logout.php">Logout</a>
     </body>

     </html>

<?php
} else {
     header("Location: index.php");
     exit();
}
?>