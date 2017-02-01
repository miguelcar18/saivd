<?php 
    session_start();
        if (empty($_SESSION['usuario']) || $_SESSION['rol'] == 0 || ($_SESSION['rol'] == 2 && !isset($_GET["id"])))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $preguntas= $conexion->query("SELECT * FROM preguntas WHERE idpregunta = ".$_GET['idp']." ORDER BY idpregunta ASC");
    if(!$preguntas)
        echo $conexion->error;
    $camposPregunta = $preguntas->fetch_array();
    $respuestas= $conexion->query("SELECT * FROM respuestas WHERE fkpregunta = ".$_GET['idp']." ORDER BY idrespuesta ASC");
    if(!$respuestas)
        echo $conexion->error;

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Editar pregunta - SAIVD</title>
</head>
<body>
    <div id="wrapper">
        <?php include('../../template/navbar.php') ?>
        <?php include('../../template/sidebar.php') ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Editar pregunta
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form role="form" method="POST" action="guardar.php" name="preguntaFranquiciasEditForm" id="preguntaFranquiciasEditForm" enctype="multipart/form-data">
                                <input type="hidden" name="fkmodulo" id="fkmodulo" value="<?= $_GET["id"] ?>">
                                <input type="hidden" name="id" id="id" value="<?= $_GET["idp"] ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-9">
                                                <label>Pregunta</label>
                                                <input class="form-control" type="text" name="pregunta" id="pregunta" value="<?= $camposPregunta['contenidop'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Tipo de respuesta</label>
                                                <select class="form-control" name="tipo_respuesta" id="tipo_respuesta" required>
                                                    <option value="" <?php if($camposPregunta['tipo_respuesta'] == "") { ?> selected <?php } ?>>Seleccione</option>
                                                    <option value="1" <?php if($camposPregunta['tipo_respuesta'] == 1) { ?> selected <?php } ?>>Única</option>
                                                    <option value="2" <?php if($camposPregunta['tipo_respuesta'] == 2) { ?> selected <?php } ?>>Múltiple</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-7">
                                                <label>Respuesta</label>
                                                <input class="form-control" type="text" name="respuesta" id="respuesta">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Opción</label>
                                                <select class="form-control" name="opcion" id="opcion">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Correcta</option>
                                                    <option value="0">Incorrecta</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Agregar a la lista</label>
                                                <button type="button" id="agregarFila" class="btn btn-success" onClick="agregarValor()">Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-hover table-full-width table-condensed" id="respuestasTabla">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-*" style="width:80%">Respuesta</th>
                                                        <th class="col-sm-*" style="width:20%">Opción</th>
                                                        <th class="col-sm-*" style="width:10%">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        while($row = $respuestas->fetch_array())
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="respuestaA[]" id="respuestaA[]" value="<?= $row['contenido'] ?>" />
                                                                <?= $row['contenido'] ?>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="opcionA[]" id="opcionA[]" value="<?= $row['correcta'] ?>" />
                                                                <?php 
                                                                    if($row['correcta'] == 1)
                                                                    {
                                                                        echo "Correcta";
                                                                    }
                                                                    else if($row['correcta'] == 0)
                                                                    {
                                                                        echo "Incorrecta";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" onclick="eliminarFila(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <a href="javascript:history.back()" class="btn btn-primary">Regresar</a>
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="result"></div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php include('../../template/footer.php') ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <?php include('../../template/scripts.php') ?>
</body>
</html>