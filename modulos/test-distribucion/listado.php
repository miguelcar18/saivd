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

    $idModulo = $_GET["id"];

    $stringNombreModulo = "SELECT nombre FROM modulos WHERE idmodulo = '".$idModulo."'";
    $consultaNombreModulo = $conexion->query($stringNombreModulo);
    $camposModulo = $consultaNombreModulo->fetch_array();
    $nombreModulo = $camposModulo["nombre"];

    $preguntas= $conexion->query("SELECT * FROM preguntas WHERE fkmodulo = ".$idModulo." ORDER BY idpregunta ASC");
    if(!$preguntas)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Preguntas del Módulo <?= $nombreModulo ?> - SAIVD</title>
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
                            Preguntas del Módulo <?= $nombreModulo ?>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:history.back()" class="btn btn-success">Regresar</a>
                        <a href="agregar.php?id=<?= $_GET['id'] ?>" class="btn btn-primary">Agregar pregunta</a>
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div id="result"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Pregunta</th>
                                                <th>Tipo de Respuesta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while($row = $preguntas->fetch_array())
                                            {
                                                ?>
                                                <tr class="odd gradeX" id="fila<?=$i?>">
                                                    <td><?= $row['contenidop'] ?></td>
                                                    <td>
                                                        <?php 
                                                        if($row['tipo_respuesta'] == 1)
                                                        {
                                                            echo "ÚNICA";
                                                        }
                                                        else if($row['tipo_respuesta'] == 2)
                                                        {
                                                            echo "MÚLTIPLE";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="editar.php?id=<?= $_GET['id'] ?>&idp=<?= $row['idpregunta'] ?>" class="tooltip-success editar" data-rel="tooltip" title="Editar <?= $row['contenidop'] ?>" style="text-decoration:none;"> 
                                                            <span class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </span> 
                                                        </a>
                                                        &nbsp;
                                                        <a href="" data-id="<?= $row['idpregunta'] ?>"  class="preguntaDistribucionEliminar" data-fila="<?=$i?>" data-rel="tooltip" title="Eliminar <?= $row['contenidop'] ?>" objeto="<?= $row['idpregunta'] ?>"> 
                                                            <span class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </span> 
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
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