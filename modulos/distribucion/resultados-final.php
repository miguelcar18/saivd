<?php
	session_start();
	if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 2) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 2))
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
	$respuestasPregunta3 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta3']."' AND correcta = 1");
	$respuestasPregunta4 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta4']."' AND correcta = 1");
	$respuestasPregunta5 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta5']."' AND correcta = 1");
	$respuestasPregunta6 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta6']."' AND correcta = 1");
	$respuestasPregunta7 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta7']."' AND correcta = 1");
	$respuestasPregunta8 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta8']."' AND correcta = 1");
	$respuestasPregunta9 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta9']."' AND correcta = 1");
	$respuestasPregunta10 = $conexion->query("SELECT idrespuesta FROM respuestas WHERE fkpregunta = '".$_POST['pregunta10']."' AND correcta = 1");


	while($row1 = $respuestasPregunta1->fetch_array())
	{
		$arrayRespuesta1[] = $row1['idrespuesta'];
	}
	while($row2 = $respuestasPregunta2->fetch_array())
	{
		$arrayRespuesta2[] = $row2['idrespuesta'];
	}
	while($row3 = $respuestasPregunta3->fetch_array())
	{
		$arrayRespuesta3[] = $row3['idrespuesta'];
	}
	while($row4 = $respuestasPregunta4->fetch_array())
	{
		$arrayRespuesta4[] = $row4['idrespuesta'];
	}
	while($row5 = $respuestasPregunta5->fetch_array())
	{
		$arrayRespuesta5[] = $row5['idrespuesta'];
	}
	while($row6 = $respuestasPregunta6->fetch_array())
	{
		$arrayRespuesta6[] = $row6['idrespuesta'];
	}
	while($row7 = $respuestasPregunta7->fetch_array())
	{
		$arrayRespuesta7[] = $row7['idrespuesta'];
	}
	while($row8 = $respuestasPregunta8->fetch_array())
	{
		$arrayRespuesta8[] = $row8['idrespuesta'];
	}
	while($row9 = $respuestasPregunta9->fetch_array())
	{
		$arrayRespuesta9[] = $row9['idrespuesta'];
	}
	while($row10 = $respuestasPregunta10->fetch_array())
	{
		$arrayRespuesta10[] = $row10['idrespuesta'];
	}

	$arrayRespuestas = array($arrayRespuesta1, $arrayRespuesta2, $arrayRespuesta3, $arrayRespuesta4, $arrayRespuesta5, $arrayRespuesta6, $arrayRespuesta7, $arrayRespuesta8, $arrayRespuesta9, $arrayRespuesta10 );

	if((in_array($_POST["respuesta1"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta2"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta3"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta4"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta5"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta6"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta7"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta8"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta9"], $arrayRespuestas) == 1) && (in_array($_POST["respuesta10"], $arrayRespuestas) == 1))
	{
		$registrarEstadistica = $conexion->query("INSERT INTO estadisticas (usuario, modulo, resultado, departamento, fecha) VALUES (".$_SESSION['id_usuario'].", 0, 1, ".$_SESSION['fkdepartamento'].", now())");
		?>
	    <script type="text/javascript" language="javascript">
	    window.location.replace("aprobado.php");
	    </script>
	    <?php
	}
	else
	{
		$registrarEstadistica = $conexion->query("INSERT INTO estadisticas (usuario, modulo, resultado, departamento, fecha) VALUES (".$_SESSION['id_usuario'].", 0, 0, ".$_SESSION['fkdepartamento'].", now())");
		?>
	    <script type="text/javascript" language="javascript">
	    window.location.replace("reprobado.php");
	    </script>
	    <?php
	}