<?php

/* 
 * author: Nacho Rodríguez
 * 
 */


if(isset($_POST)){
    require_once 'includes/conexion.php';
    
    if(!isset($_SESSION)) {
       session_start(); 
    }
    

    $nombre = isset($_POST['nombre']) ? mysql_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysql_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysql_real_escape_string($db, $_POST['email']) : false;
    $password = isset($_POST['password']) ? mysql_real_escape_string($db, $_POST['password']) : false;
    
    // Array de errores
    $errores = array();

    // Validar datos 
//    Validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validate = true;
    } else {
        $nombre_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    }

//    Validar campo apellidos    
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validate = true;
    } else {
        $apellidos_validate_validate = false;
        $errores['apellidos'] = "El apellido no es válido";
    }

//    Validar campo email    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $email_validate = false;
        $errores['email'] = "El email no es válido";
    }

//    Validar campo contraseña
    if(!empty($password)) {
        $password_validate = true;
    } else {
        $password_validate = false;
        $errores['password'] = "El password está vacío";
    }
    
    $guardar_usuario = false;
    if(count($errores) == 0) {
        $guardar_usuario = true;  
        
        // Cifrado contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost=>4']);
//        Insertar Usuario en la tabla Usuarios de la BBDD
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos',"
                . "'$email', '$password_segura', CURDATE());";
        
        $guardar = mysqli_query($db, $sql);
        
        if($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el registro";
        }
        
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');


