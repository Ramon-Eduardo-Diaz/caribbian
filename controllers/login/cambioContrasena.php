<?php 
	/*	CONTROLADOR
		AGREGA CLIENTES
	*/
	require_once('../../models/alumnos.php');
	require_once('../../models/empleados.php');

	//Obtengo el valor enviado por el AJAX
	session_start();
	$identidad=$_SESSION['identidad'];
 

	$contraActual=$_POST['txtContrasenaActual'];;
	$nuevaContra=$_POST['txtNuevaContrasena'];
	$verificacionContra=$_POST['txtConfirmar'];

	if ($_SESSION['tipo']=="Alumno(a)") {
		$Alumno = new Alumnos;
		if ($Alumno->verificacionContrasenaAlumno($identidad, $contraActual)) {
			if ($nuevaContra==$verificacionContra) {
				$cambioContra=$Alumno->cambioContrasena($identidad, $nuevaContra);
				if($cambioContra)
					{
						session_destroy();
						echo"<script type=\"text/javascript\">alert('¡Cambio de contraseña exitoso! | ¡Vuelva a ingresar!'); window.location='../../index.php';</script>";
					}
					else{
						echo"<script type=\"text/javascript\">alert('¡ERROR AL ACTUALIZAR CONTRSEÑA!'); window.location='../../views/cambioContrasena.php';</script>";
					}
				}
			else{
				echo"<script type=\"text/javascript\">alert('Las Contraseñas no coinciden!'); window.location='../../views/cambioContrasena.php';</script>";
			}
		}
		else{
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta!'); window.location='../../views/cambioContrasena.php';</script>";
		}
	}else{

		$Empleado = new Empleados;
		if ($Empleado->verificacionContrasenaEmpleado($identidad, $contraActual)) {
			if ($nuevaContra==$verificacionContra) {
				$cambioContra=$Empleado->cambioContrasena($identidad, $nuevaContra);
				if($cambioContra){
						session_destroy();
						echo"<script type=\"text/javascript\">alert('¡Cambio de contraseña exitoso! | ¡Vuelva a ingresar!'); window.location='../../index.php';</script>";
					}
					else{
						echo"<script type=\"text/javascript\">alert('¡ERROR AL ACTUALIZAR CONTRSEÑA!'); window.location='../../views/cambioContrasena.php';</script>";
					}
				}
			else{
				echo"<script type=\"text/javascript\">alert('Las Contraseñas no coinciden!'); window.location='../../views/cambioContrasena.php';</script>";
			}
		}
		else{
			echo"<script type=\"text/javascript\">alert('Contraseña incorrecta!'); window.location='../../views/cambioContrasena.php';</script>";
		}

}

 ?>