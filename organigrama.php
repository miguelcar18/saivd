<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('template/head.php') ?>
        <title>Inicio - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('template/navbar.php') ?>
            <?php include('template/sidebar-inicio.php') ?>
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
                        <div class="col-md-12">
                            <center><img src="assets/img/organigrama.png" height="auto" width="100%"></center>
                        </div>
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