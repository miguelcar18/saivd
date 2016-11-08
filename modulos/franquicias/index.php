<?php
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 3) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 3))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Coord. Franquicias - SAIVD</title>
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
                                <b>COORDINACIÓN DE FRANQUICIAS</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3><b>Garantizamos:<b></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <img src="../../assets/img/rentabilidad.png" class="img img-reponsive img-rounded" width="100%" height="auto">
                                </div>
                                <div class="text-center" style="color:#000000; font-weight: bold"> Rentabilidad </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <img src="../../assets/img/licenciamiento.png" class="img img-reponsive img-rounded" width="100%" height="auto">
                                </div>
                                <div class="text-center" style="color:#000000; font-weight: bold"> Licenciamiento </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <img src="../../assets/img/asesoria.png" class="img img-reponsive img-rounded" width="100%" height="auto">
                                </div>
                                <div class="text-center" style="color:#000000; font-weight: bold"> Asesorías </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <img src="../../assets/img/fomento.png" class="img img-reponsive img-rounded" width="100%" height="auto">
                                </div>
                                <div class="text-center" style="color:#000000; font-weight: bold"> Fomento de las actividades de la Rentabilidad Social </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <center>
                                <img src="../../assets/img/franquicia.png" width="100%" height="auto">
                            </center>
                        </div>
                        <div class="col-md-2"></div>
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