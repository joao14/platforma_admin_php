<!DOCTYPE html>
<html>

<head>
	<title>Plataforma Admin</title>
	<link rel="stylesheet" type="text/css" href="views/css/style.css">
	<link rel="icon" href="https://img.icons8.com/fluency/48/000000/link.png" type="image/x-icon">
</head> 
  
<body>
	<form action="controllers/usuario.php" method="post">
		<h2>Plataforma Admin</h2>   
		<?php if (isset($_GET['error'])) { ?>  
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>  
		<label>Usuario</label>  
		<input type="text" name="uname" placeholder="User Name"><br>
 
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>

		<button type="submit">Ingresar</button>
	</form>
</body>

</html>