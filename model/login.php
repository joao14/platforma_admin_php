<?php
session_start();
include "../db/db_conn.php";
$conn = OpenCon();
echo 'Barcelona S.C';
if ($conn->connect_errno) {
	header("Location: ../index.php?error=El sistema esta temporalmente con errores");
	exit;
}

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: ../index.php?error=User is required");
		exit();
	} else if (empty($pass)) {
		header("Location: ../index.php?error=Password is required");
		exit();
	} else {

		$sql = "SELECT * FROM usuarios WHERE user='$uname' AND password='$pass'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user'] === $uname && $row['password'] === $pass) {
				$_SESSION['user'] = $row['user'];
				$_SESSION['nombres'] = $row['nombres'];
				$_SESSION['id_usuario'] = $row['id_usuario'];
				$_SESSION['id_perfil'] = $row['id_perfil'];
				header("Location: ../home.php"); 
				exit();
			} else {
				header("Location: ../index.php?error=Incorect User name or password");
				exit();
			}
		} else {
			header("Location: ../index.php?error=Incorect User name or password");
			exit();
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
