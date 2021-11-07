<?php

    session_start();
    require_once("../models/usuario.php");   
    $services = new Usuario();     
                
    $result = $services->getInformationOfUserByCredentials($_POST['uname'],$_POST['password']);    
    
    if (mysqli_num_rows($result) === 1) {  
        $row = mysqli_fetch_assoc($result);       
        if ($row['user'] === $_POST['uname'] && $row['password'] === $_POST['password']) {
           
            $_SESSION['user'] = $row['user']; 
            $_SESSION['nombres'] = $row['nombres'];
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['id_perfil'] = $row['id_perfil'];
            $_SESSION['perfil'] = $row['perfil'];
            header("Location: ../views/home.php"); 
            exit(); 

        } else {

            header("Location: ../index.php?error=Incorect User name or password");
            exit();
        }
    } else {
        
        header("Location: ../index.php?error=Incorect User name or password");
        exit();
    }     
    
?>