<?php

if(isset($_POST)){

	require_once 'includes/conexion.php';

	// Iniciar sesion 
	if(!isset($_SESSION)){
		session_start();
	}

	// Recoger los valores del formulario 
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false ;

	// Arreglo de errores 
	$errores = array();

	if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
		$nombre_validado = true;
	}else{
		$nombre_validado = false;
		$errores['nombre'] = "El nombre no es valido";
	}

	if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
		$apellidos_validado = true;
	}else{
		$apellidos_validado = false;
		$errores['apellidos'] = "el apellido no es valido";
	}

	if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email_validado = true;
	}else{
		$email_validado = false;
		$errores['email'] = "Email no es valido";
	}

	if(!empty($password)){
		$password_validado = true;
	}else{
		$password_validado = false;
		$errores['password'] = "Password no puede estar vacio";
	}

	$guardar = false;
	if(count($errores) == 0 ){
		$guardar = true;

		// Cifrar la contraseña 
		$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

		// Insertar el usuario a la BD 

		$sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$password_segura', CURDATE());";

		$salvar = mysqli_query($db, $sql);

		if($salvar){
			$_SESSION['completado'] = "El registro se realizado con exito";
		}else{
			$_SESSION['errores']['general'] = "Fallo al guardar el usuario";
		}

	}else{
		$_SESSION['errores'] = $errores;
	}

}

header('Location: index.php');
