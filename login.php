<?php

// Iniciar la sesion y la conexion db
require_once 'includes/conexion.php';

// Recoger datos del formulario
if(isset($_POST)){

	// Borrar error antiguo
	if(isset($_SESSION['error_login'])){
		session_unset($_SESSION['error_login']);
	}

	// Recogo datos del formulario
	$email = trim($_POST['email']);
	$password = $_POST['password'];

	// consulta las credenciales 
	$sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
	$login = mysqli_query($db, $sql);

	if($login && mysqli_num_rows($login) == 1){
		$usuario = mysqli_fetch_assoc($login);

		// comprobar la contraseña
		$verify = password_verify($password, $usuario['password']);

		if($verify){
			// crear la sesion de usuario
			$_SESSION['usuario'] = $usuario;



		}else{
			// si falla algo enviar una sesion con el fallo 
			$_SESSION['error_login'] = "Login incorrecto";
		}

	}else{
		// Mensaje de error
		$_SESSION['error_login'] = "Login incorrecto";
		}
	}


// Redirigir al index.php
header('Location: index.php');


 




// redirigir al index.php

