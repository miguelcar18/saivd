<?php
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 1) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 1))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $estadistica = $conexion->query("SELECT modulos.nombre AS modulo, estadisticas.resultado AS resultado, estadisticas.fecha AS fecha FROM estadisticas INNER JOIN modulos ON modulos.idmodulo = estadisticas.modulo WHERE departamento = 1 ORDER BY fecha ASC");
    $consultaAprobados = $conexion->query("SELECT count(resultado) AS cantidadAprobados FROM estadisticas WHERE usuario = ".$_SESSION['id_usuario']." AND resultado = 1 AND departamento = 1");
    $consultaReprobados = $conexion->query("SELECT count(resultado) AS cantidadReprobados FROM estadisticas WHERE usuario = ".$_SESSION['id_usuario']." AND resultado = 0 AND departamento = 1");
    $campoAprobados = $consultaAprobados->fetch_array();
    $campoReprobados = $consultaReprobados->fetch_array();
    if(!$estadistica)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Estadistica Ventas - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('../../template/navbar.php') ?>
            <?php include('../../template/sidebar.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-header">
                                <b>ESTADISTICA INDIVIDUAL - VENTAS</b>
                            </h3>
                        </div>
                    </div>
                    <?php 
                    $contador = 0;
                    if($estadistica->num_rows == 0)
                    {
                        ?>
                        <!-- /. ROW  -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">No ha realizado ninguna evaluación aún</h4>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <!-- /. ROW  -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Evaluaciones realizadas
                                    </div>
                                    <div class="panel-body">
                                        <div id="donut-test"></div>
                                    </div>
                                </div>            
                            </div>
                        </div>
                        <!-- /. ROW  -->
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
                                                        <th>Departamento</th>
                                                        <th>Módulo</th>
                                                        <th>Resultado</th>
                                                        <th>Fecha</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while($row = $estadistica->fetch_array())
                                                    {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td>Ventas</td>
                                                            <td><?= $row['modulo'] ?></td>
                                                            <td>
                                                                <?php 
                                                                if($row['resultado'] == 1)
                                                                    echo "Aprobado";
                                                                else if($row['resultado'] == 0)
                                                                    echo "Reprobado";
                                                                ?>
                                                            </td>
                                                            <td><?= date_format(date_create($row['fecha']), 'd/m/Y H:i:s') ?></td>
                                                        </tr>
                                                        <?php
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
                        <?php
                    }
                    ?>
                    <?php include('../../template/footer.php') ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <?php include('../../template/scripts.php') ?>
        <?php 
        if($estadistica->num_rows > 0)
        {
            ?>
            <script type="text/javascript">
                $(function() {
                    var mainAppTest = {
                        initFunction: function () {
                            Morris.Donut({
                                element: 'donut-test',
                                colors: ['#0B62A4', 'red'],
                                data: [{
                                    label: "Test Aprobados",
                                    value: <?= $campoAprobados['cantidadAprobados'] ?>
                                }, {
                                    label: "Test Reprobados",
                                    value: <?= $campoReprobados['cantidadReprobados'] ?>
                                }],
                                resize: true
                            });
                        },
                        initialization: function () {
                            mainAppTest.initFunction();
                        }
                    }
                    mainAppTest.initFunction();
                });
            </script>
            <?php
        }
        ?>
    </body>
</html>