<?php
    session_start();

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $usuarios= $conexion->query("SELECT * FROM usuarios WHERE idusuario = ".$_POST['id']."");
    $campoUsuario = $usuarios->fetch_array();
    $estadistica = $conexion->query("SELECT modulos.nombre AS modulo, estadisticas.resultado AS resultado, estadisticas.fecha AS fecha FROM estadisticas INNER JOIN modulos ON modulos.idmodulo = estadisticas.modulo WHERE usuario = ".$_POST['id']." AND departamento = 2 ORDER BY fecha ASC");
    $consultaAprobados = $conexion->query("SELECT count(resultado) AS cantidadAprobados FROM estadisticas WHERE usuario = ".$_POST['id']." AND resultado = 1 AND  departamento = 2");
    $consultaReprobados = $conexion->query("SELECT count(resultado) AS cantidadReprobados FROM estadisticas WHERE usuario = ".$_POST['id']." AND resultado = 0 AND  departamento = 2");
    $campoAprobados = $consultaAprobados->fetch_array();
    $campoReprobados = $consultaReprobados->fetch_array();
    if(!$estadistica)
        echo $conexion->error;
?>

<div id="page-inner">
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
                        Resultados de <?= $campoUsuario['nombre']." ".$campoUsuario['apellido'] ?>
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
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example-result">
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
                                            <td>Distribución</td>
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
</div>
<!-- /. PAGE INNER  -->
<?php 
if($estadistica->num_rows > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $('#dataTables-example-result').dataTable({
                language: {
                    lengthMenu:         "Mostrar _MENU_ resultados por página",
                    zeroRecords:        "Sin resultados",
                    info:               "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty:          "Sin ninguna información",
                    infoFiltered:       "(Filtrado de _MAX_ resultados totales)",
                    search:             "Buscar:",
                    paginate: {
                        "first":        "Primero",
                        "last":         "Último",
                        "next":         "Siguiente",
                        "previous":     "Anterior"
                    }
                }
            });
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