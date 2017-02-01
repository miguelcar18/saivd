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
                            <p style="text-align:justify">
                                <label style="width:40px"></label>
                                A través del Sistema de Adiestramiento Interactivo de la Gerencia de Ventas y Distribución (SAIVD) de Cervecería Polar C.A., territorio Oriente Sur, usted podrá adquirir y refrescar los conocimientos concernientes a su área de trabajo con la finalidad de cumplir con los objetivos que le corresponden de acuerdo al cargo que desempeña, buscando siempre obtener un excelente desarrollo en nuestros empleados y ofrecer un servicio de calidad a  los clientes.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><img src="assets/img/saivd.png" height="250px" width="auto"></center>
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