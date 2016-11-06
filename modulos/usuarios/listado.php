<?php 
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $usuarios= $conexion->query("SELECT * FROM usuarios ORDER BY usuario");
    if(!$usuarios)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Listado de usuarios - SAIVD</title>
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
                            Listado de Usuarios
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="agregar.php" class="btn btn-primary">Agregar usuario</a>
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
                                                <th>Cédula</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Usuario</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while($row = $usuarios->fetch_array())
                                            {
                                                ?>
                                                <tr class="odd gradeX" id="fila<?=$i?>">
                                                    <td><?= number_format($row['cedula'], 0, '', '.') ?></td>
                                                    <td><?= $row['nombre'] ?></td>
                                                    <td><?= $row['apellido'] ?></td>
                                                    <td><?= $row['usuario'] ?></td>
                                                    <td>
                                                        <a href="editar.php?id=<?= $row['idusuario'] ?>" class="tooltip-success editar" data-rel="tooltip" title="Editar <?= $row['usuario'] ?>" style="text-decoration:none;"> 
                                                            <span class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </span> 
                                                        </a>
                                                        &nbsp;
                                                        <a href="" data-id="<?= $row['idusuario'] ?>"  class="usuarioEliminar" data-fila="<?=$i?>" data-rel="tooltip" title="Eliminar <?= $row['usuario'] ?>" objeto="<?= $row['idusuario'] ?>"> 
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