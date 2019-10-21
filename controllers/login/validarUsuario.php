<?php
$usuario=strtolower($_POST['email']);
$contra=$_POST['password'];

include_once("../../models/users.php");

$user = new User;
$user = $user->Validar($usuario);

if($user)
{
	foreach ($user as $value) {
		if ($value["password"]==$contra){
			session_start();
			$_SESSION['idUser']=$value["iduser"];
			$_SESSION['email']=$usuario;
			$_SESSION['usertype']=$value["usertype"];
				if ($value['estado']=!0) {
					echo"<script type=\"text/javascript\">alert('El usuario entro correctamente'); window.location='../../index.html';</script>";
				}else{
					echo"<script type=\"text/javascript\">alert('El usuario aun no esta activado'); window.location='../../index.html';</script>";
				}
		}
		else{
				echo"<script type=\"text/javascript\">alert('Error! Usuario o contraseña inválido'); window.location='../../index.html';</script>";
		}
	}

}

?>
