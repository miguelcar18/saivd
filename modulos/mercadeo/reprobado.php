<?php
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 4) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 4))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php");

    if(isset($_GET['idmodulo']))
    {
        $nombreModulo = $conexion->query("SELECT nombre FROM modulos WHERE idmodulo = ".$_GET['idmodulo']."");
        $camposModulo = $nombreModulo->fetch_array();
    }
    else
    {
        $camposModulo = array();
        $camposModulo['nombre'] = "EXAMEN FINAL";
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Resultados - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('../../template/navbar.php') ?>
            <?php include('../../template/sidebar.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-header-inicio">
                                <b>RESULTADOS <?= strtoupper($camposModulo['nombre']) ?> - MERCADEO</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <center>
                                        <img src="../../assets/img/xs.png" width="auto" height="120px">
                                        <br><br>
                                        <h1> NO ALCANZÓ LA PUNTUACIÓN DESEADA</h1>
                                        <br><br>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-primary">CONTINUAR</a> 
                                        </div>
                                    </center>
                                </div>
                            </div>
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