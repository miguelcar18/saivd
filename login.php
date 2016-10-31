<?php
    session_start();
    if (!isset($_GET['dpto']) || $_GET['dpto'] < 1 || $_GET['dpto'] > 4)
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("conexion/conexion-bd.php");
    include("conexion/funciones.php"); 

    $departamento= $conexion->query("SELECT * FROM departamentos WHERE iddepartamento = ".$_GET['dpto']."");
    if(!$departamento)
        echo $conexion->error;
    $campoDepartamento = $departamento->fetch_array();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('template/head.php') ?>
        <title>Login - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('template/navbar.php') ?>
            <?php include('template/sidebar.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-header-inicio text-center">
                                <b>SISTEMA DE ADIESTRAMIENTO INTERACTIVO DE LA GERENCIA DE VENTAS Y DISTRIBUCIÓN</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    INICIO DE SESIÓN - <?= strtoupper($campoDepartamento['nombre']) ?>
                                </div>
                                <div class="panel-body">
                                    <form role="form" method="POST" action="sesion/validar-usuario.php" name="loginForm" id="loginForm">
                                        <input type="hidden" name="dpto" id="dpto" value="<?= $_GET['dpto'] ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label>USUARIO</label>
                                                    <input class="form-control" type="text" name="usuario" id="usuario" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label>CONTRASEÑA</label>
                                                    <input class="form-control" type="password" name="password" id="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-12">
                                                    <center>
                                                        <button type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
                                                    </center>
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
    				<?php include('template/footer.php') ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <?php include('template/scripts.php') ?>
    </body>
</html>