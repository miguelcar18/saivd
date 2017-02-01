<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Inicio - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('../../template/navbar.php') ?>
            <?php include('../../template/sidebar-inicio.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header-inicio text-center">
                                <b>DESCARGAR ARCHIVOS</b>
                            </h2> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align:justify">
                                <label style="width:100px"></label>
                                <b>Seleccione la "Coordinación" o "Gerencia"  que le corresponda de acuerdo a su área de trabajo.</b>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                        <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">
                                <b>COORDINACIONES DISPONIBLES</b><br><br>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <a href="listado.php?dpto=2" class="btn btn-success btn-block"><b>Coord. Distribución</b></a>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <a href="listado.php?dpto=3" class="btn btn-primary btn-block"><b>Coord. Franquicias</b></a>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <a href="listado.php?dpto=4" class="btn btn-danger btn-block"><b>Coord. Mercadeo</b></a>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <a href="listado.php?dpto=1" class="btn btn-warning btn-block"><b>Gerencia Ventas</b></a>
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