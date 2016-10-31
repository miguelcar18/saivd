<?php
	session_start();
	if (empty($_SESSION['usuario']) || $_SESSION['fkdepartamento'] != 4)
	{ 
	    ?>
	    <script type="text/javascript" language="javascript">
	    window.location.replace("/saivd/index.php");
	    </script>
	    <?php 
	}

	include("../../conexion/conexion-bd.php");
	include("../../conexion/funciones.php");
	
	$respuestasPregunta1 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta1']."' AND correcta = 1");
	$respuestasPregunta2 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta2']."' AND correcta = 1");
	while($row1 = $respuestasPregunta1->fetch_array())
	{
		$arrayRespuesta1[] = $row1['idrespuesta'];
	}
	while($row2 = $respuestasPregunta2->fetch_array())
	{
		$arrayRespuesta2[] = $row2['idrespuesta'];
	}

	if(($arrayRespuesta1 == $_POST["respuesta1"] && $arrayRespuesta2 == $_POST["respuesta2"]) || ($arrayRespuesta1 == $_POST["respuesta2"] && $arrayRespuesta2 == $_POST["respuesta1"]))
	{
		$registrarEstadistica = $conexion->query("INSERT INTO estadisticas (usuario, modulo, resultado, departamento, fecha) VALUES (".$_SESSION['id_usuario'].", ".$_POST['modulo'].", 1, ".$_SESSION['fkdepartamento'].", now())");
		?>
	    <script type="text/javascript" language="javascript">
	    window.location.replace("aprobado.php?idmodulo=<?= $_POST['modulo'] ?>");
	    </script>
	    <?php
	}
	else
	{
		$registrarEstadistica = $conexion->query("INSERT INTO estadisticas (usuario, modulo, resultado, departamento, fecha) VALUES (".$_SESSION['id_usuario'].", ".$_POST['modulo'].", 0, ".$_SESSION['fkdepartamento'].", now())");
		?>
	    <script type="text/javascript" language="javascript">
	    window.location.replace("reprobado.php?idmodulo=<?= $_POST['modulo'] ?>");
	    </script>
	    <?php
	}