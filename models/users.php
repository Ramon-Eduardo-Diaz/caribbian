<?php
	/* Clase de empelados del sistema de UNACIFOR */

	# agregamos al archivo de empleados, la clase de conexion.
	require_once('conexion.php');

	# creamos la clase de Alumnos
	class User
	{
		# atributo que contendra la conexion.
		public $AbrirConexion;
		
		# constructor de la clase de empleados
		function __construct()
		{
			# instanciamos el atrubuto con la clase de conexion.
			$this->AbrirConexion = new Conexion();
			# nos conectamos con la base de datos.
			$this->AbrirConexion = $this->AbrirConexion->conectar();
		}

		function Validar($email){

			# variabele en donde estara sentencia SQL
			$sql = "SELECT `iduser`, `password`, `usertype`, `status` FROM `users` WHERE `email` = '$email';";
			# se prepara el stament para la ejecucion de la consulta
			$stmt = $this->AbrirConexion->prepare($sql);

			try {
				# ejecutamos el stament
				$stmt->execute();
				# solicitamos la consulta en un arreglo asociativo
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				# capturamos el error
				$result = $e->getMesage();
			}
			# libera la conexion con la base de datos
			$stmt->closeCursor();

			# retornamos el resultado de la consulta.
			return $result;
		}

		function userRegister($email, $password, $name, $lastname, $cellphone, $country, $birthday){

			$userId = $this->getNewUserId();
			$userId = $userId + 1;
			# variabele en donde estara sentencia SQL
			$sql = "INSERT INTO `users`(`iduser`,`email`, `password`, `usertype`, `status`) VALUES ('$userId', '$email', '$password', 'admin', '1');";
			# se prepara el stament para la ejecucion de la consulta
			$stmt = $this->AbrirConexion->prepare($sql);

			try {
				# ejecutamos el stament
				$stmt->execute();
				# solicitamos la consulta en un arreglo asociativo
				if ($stmt) {
				   $this->personRegister($userId, $name, $lastname, $cellphone, $country, $birthday);
				}
				$result=$stmt;
			} catch (PDOException $e) {
				# capturamos el error
				$result = $e->getMesage();
			}
			# libera la conexion con la base de datos
			$stmt->closeCursor();

			# retornamos el resultado de la consulta.
			return $result;
		}

		function personRegister($userId, $name, $lastname, $cellphone, $country, $birthday){

			# variabele en donde estara sentencia SQL
			$sql = "INSERT INTO `person`(`users_iduser`, `name`, `lastname`, `cellphone`, `country`, `birthday`) VALUES ('$userId', '$name', '$lastname', '$cellphone', '$country', '$birthday');";
			# se prepara el stament para la ejecucion de la consulta
			$stmt = $this->AbrirConexion->prepare($sql);

			try {
				# ejecutamos el stament
				$stmt->execute();

				# solicitamos la consulta en un arreglo asociativo
				$result = $stmt;
			} catch (PDOException $e) {
				# capturamos el error
				$result = $e->getMesage();
			}
			# libera la conexion con la base de datos
			$stmt->closeCursor();

			# retornamos el resultado de la consulta.
			return $result;
		}

		function getNewUserId(){

			# variabele en donde estara sentencia SQL
			$sql = "SELECT MAX(iduser) FROM users;";
			# se prepara el stament para la ejecucion de la consulta
			$stmt = $this->AbrirConexion->prepare($sql);

			try {
				# ejecutamos el stament
				$stmt->execute();
				# solicitamos la consulta en un arreglo asociativo
				$result = $stmt->fetchColumn();
			} catch (PDOException $e) {
				# capturamos el error
				$result = $e->getMesage();
			}
			# libera la conexion con la base de datos
			$stmt->closeCursor();

			# retornamos el resultado de la consulta.
			return $result;
		}

		
	}
 ?>