<?php 
    session_start();
    if (empty($_SESSION['usuario']) || $_SESSION['rol'] != 1)
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php");

    $stringModulo = "SELECT * FROM modulos WHERE idmodulo = '" . $_GET["id"] . "'";
    $datosUsuarios = $conexion->query($stringModulo);
    $campoModulo = $datosUsuarios->fetch_array(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Editar módulo - SAIVD</title>
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
                            Editar módulo
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form role="form" method="POST" action="guardar.php" name="moduloVentasEditForm" id="moduloDistribucionEditForm">
                                    <input type="hidden" name="id" id="id" value="<?= $campoModulo['idmodulo']?>"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-9">
                                                <label>Nombre</label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" value="<?= $campoModulo['nombre']?>" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Nivel módulo</label>
                                                <input class="form-control" type="number" name="nivel_mod" id="nivel_mod" min="1" value="<?= $campoModulo['nivel_mod']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <label>Archivos</label>
                                                <input class="form-control" type="file" name="archivos[]" id="archivos" multiple disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-success">Actualizar</button>
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