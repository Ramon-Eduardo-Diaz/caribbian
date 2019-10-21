<?php

include_once("../../models/users.php");
$email=strtolower($_POST['email']);
$password=$_POST['password'];
$passwordConfirm=$_POST['confirmation'];
$name=$_POST['name'];
$lastname=$_POST['lastname'];
$cellphone=$_POST['cellphone'];
$country=$_POST['country'];
$birthday=$_POST['birthday'];

if ($password == $passwordConfirm) {
	$user = new User;
	$resultado=$user->userRegister($email, $password, $name, $lastname, $cellphone, $country, $birthday);

	if ($resultado) {
		echo"<script type=\"text/javascript\">alert('User registrado correctamente!'); window.location='../../views/template.php';</script>";
	}else{
		echo"<script type=\"text/javascript\">alert('¡ERROR AL REGISTRAR!'); window.location='../../views/registroEmpleado.php';</script>";
	}
}else{
	echo"<script type=\"text/javascript\">alert('¡ERROR AL REGISTRAR! las contraseñas no coinciden'); window.location='../../views/registroEmpleado.php';</script>";
}
?>
