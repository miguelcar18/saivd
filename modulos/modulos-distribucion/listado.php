<?php 
    session_start();
    if (empty($_SESSION['usuario']) || $_SESSION['rol'] == 0)
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $modulos= $conexion->query("SELECT * FROM modulos WHERE fkdepartamento = 2 ORDER BY nivel_mod ASC");
    if(!$modulos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Listado de módulos - SAIVD</title>
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
                            Listado de Módulos
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                        <a href="agregar.php" class="btn btn-primary">Agregar módulo</a>
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
                                                <th>Nombre</th>
                                                <th>Orden</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while($row = $modulos->fetch_array())
                                            {
                                                ?>
                                                <tr class="odd gradeX" id="fila<?=$i?>">
                                                    <td><?= $row['nombre'] ?></td>
                                                    <td><?= $row['nivel_mod'] ?></td>
                                                    <td>
                                                        <a href="../test-distribucion/listado.php?id=<?= $row['idmodulo'] ?>" class="tooltip-success preguntas" data-rel="tooltip" title="Preguntas <?= $row['nombre'] ?>" style="text-decoration:none;"> 
                                                            <span class="btn btn-sm btn-info"> <i class="fa fa-question"></i> </span> 
                                                        </a>
                                                        &nbsp;
                                                        <a href="editar.php?id=<?= $row['idmodulo'] ?>" class="tooltip-success editar" data-rel="tooltip" title="Editar <?= $row['nombre'] ?>" style="text-decoration:none;"> 
                                                            <span class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </span> 
                                                        </a>
                                                        &nbsp;
                                                        <a href="" data-id="<?= $row['idmodulo'] ?>"  class="moduloDistribucionEliminar" data-fila="<?=$i?>" data-rel="tooltip" title="Eliminar <?= $row['nombre'] ?>" objeto="<?= $row['idmodulo'] ?>"> 
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