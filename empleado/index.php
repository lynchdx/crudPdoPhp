<?php 

// Notificar solamente errores de ejecución
//error_reporting(E_ERROR | E_WARNING | E_PARSE);


//Imprimir todo el contenido de una variable, en este caso, del método post del form.
//print_r($_POST);

/*
echo $_POST["txtId"];
echo "<br/>";
echo $_POST["txtNombre"];
echo "<br/>";
echo $_POST["txtApellidoMaterno"];
echo "<br/>";
echo $_POST["txtApellidoPaterno"];
echo "<br/>";
echo $_POST["txtCorreo"];
echo "<br/>";
echo $_POST["txtFoto"];
echo "<br/>";
*/

//hace los get del html
$txtId=(isset($_POST["txtId"]))?$_POST["txtId"]:"";
$txtNombre=(isset($_POST["txtNombre"]))?$_POST["txtNombre"]:"";
$txtApellidoMaterno=(isset($_POST["txtApellidoMaterno"]))?$_POST["txtApellidoMaterno"]:"";
$txtApellidoPaterno=(isset($_POST["txtApellidoPaterno"]))?$_POST["txtApellidoPaterno"]:"";
$txtCorreo=(isset($_POST["txtCorreo"]))?$_POST["txtCorreo"]:"";
$txtFoto=(isset($_POST["txtFoto"]))?$_POST["txtFoto"]:"";

/*
echo $txtId;
echo $txtNombre;
echo $txtApellidoMaterno;
echo $txtApellidoPaterno;
echo $txtCorreo;
echo $txtFoto;
*/

$accion=(isset($_POST['btnAccion']))?$_POST['btnAccion']:"";
//echo $accion;

//.. retrocede una carpeta atrás, incluye la conexion.php
include("../conexion/conexion.php");

//switch de los botones	
switch ($_POST['btnAccion']) {
              case 'btnAgregar':

              //$pdo= new PDO($servidor, $usuario, $password), viene de conexion.php;
              //prepare	
              $query = $pdo->prepare("INSERT INTO empleado(nombre,apellidop,apellidom,correo,foto) VALUES (:nombre,:apellidop,:apellidom,:correo,:foto) ");	

              //pasa los txt a las variables para la query
              $query->bindParam(':nombre',$txtNombre);
              $query->bindParam(':apellidop',$txtApellidoPaterno);
              $query->bindParam(':apellidom',$txtApellidoMaterno);
              $query->bindParam(':correo',$txtCorreo);
              $query->bindParam(':foto',$txtFoto);

              //ejecuta la query;
              $query->execute();



              echo $txtId;
              echo "Boton Agregar";
              break;

              case 'btnModificar':
              echo $txtId;
              echo "Boton Modificar";
              break;

              case 'btnEliminar':
              echo $txtId;
              echo "Boton Eliminar";
              break;

              case 'btnCancelar':
              echo $txtId;
              echo "Boton Cancelar";
              break;
}
		//where 1 es sinónimode true, es lo mismo que un select * from empleado
		$query = $pdo->prepare("select * from empleado where 1;");	
		$query->execute();
		//fetch_assoc asocia información de la query al array $listaEmpleados .
		$listaEmpleados=$query->fetchAll(PDO::FETCH_ASSOC);

		print_r($listaEmpleados);



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Empelados</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="form-group">
		<!--enctype="multipart/form-data" Sirve para rececionar imágenes dentro del formulario-->
		<form action="" method="post" enctype="multipart/form-data">
		<!--(label{lbl$:}+input[name = "txt$" placeholder="" id="txt$" require]+br)*6-->	
			
			<!--
			<label for="">ID:</label>
			<input type="text" name="txtId" value="<?php echo $txtId ?>" placeholder="" id="txtId" require="">
			<br>
			
			-->
			<div >
				<label for="">Nombres:</label>
				<input type="text" class="form-control" name="txtNombre"  value="<?php echo $txtNombre ?>" placeholder="" id="txtNombre" require="">
				<br>
			</div>
			
			<div >
				<label for="">Apellido Paterno:</label>
				<input type="text"  class="form-control" name="txtApellidoPaterno" value="<?php echo $txtApellidoPaterno ?>" placeholder="" id="txtApellidoPaterno" require="">
				<br>
			</div>
			
			<div >
				<label for="">Apellido Materno:</label>
				<input type="text" class="form-control" name="txtApellidoMaterno" value="<?php echo $txtApellidoMaterno ?>" placeholder="" id="txtApellidoMaterno" require="">
				<br>
			</div>

			<div >
				<label for="">Correo:</label>
				<input type="text" class="form-control" name="txtCorreo" value="<?php echo $txtCorreo ?>" placeholder="" id="txtCorreo" require="">
				<br>
			</div>
			
			<div class="form-group">
				<label for="">Foto:</label>
				<input type="text" class="form-control" name="txtFoto"  value="<?php echo $txtFoto ?>" placeholder="" id="txtFoto" require="">
				<br>
			</div>
			
		<!--(button[value="btn$" type="submit" name="accion"])*4-->
			<button value="btnAgregar" class="btn btn-primary" type="submit" name="btnAccion">Agregar</button>
			<button value="btnModificar" class="btn btn-warning" type="submit" name="btnAccion">Modificar</button>
			<button value="btnEliminar" class="btn btn-danger" type="submit" name="btnAccion">Eliminar</button>
			<button value="btnCancelar" class="btn btn-secondary" type="submit" name="btnAccion">Cancerlar</button>
			<div/>
		</form>			

		<!--table>thread>tr>(th)*4-->
		<table>
			<thread>
				<tr>
					<th>Foto</th>
					<th>Nombre Completo</th>
					<th>Correo</th>
					<th>Acciones</th>
				</tr>
			</thread>
			<?php foreach($listaEmpleados as $empleado){ ?>		
				<!--tr>(td)*4-->
				<tr>
					<td><?php echo $empleado['foto']; ?></td>
					<td><?php echo $empleado['nombre']; ?> <?php echo $empleado['apellidop']; ?> <?php echo $empleado['apellidom']; ?></td>
					<td><?php echo $empleado['correo']; ?></td>
					<td><input type="button" value="Seleccionar" name="accion"></td>
				</tr>
			<?php } ?>

		</table>



	</div>
	
</body>
</html>