<?php
    session_start();
    if (empty($_SESSION['usuario']) || $_SESSION['fkdepartamento'] != 1)
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
        <title>Coord. Ventas - SAIVD</title>
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
                                <b>COORDINACIÓN DE VENTAS</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align:justify">
                                <label style="width:40px"></label>
                                Analizamos y proyectamos los resultados de ventas para la elaboración del Plan Nacional de Ventas de la Compañía.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3><b>Trabajamos por:<b></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <img src="../../assets/img/vacio.png" class="img img-reponsive img-rounded" width="auto" height="180px"> 
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <img src="../../assets/img/capilaridad1.png" class="img img-reponsive img-rounded" width="auto" height="180px"> 
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <img src="../../assets/img/saperp.png" class="img img-reponsive img-rounded" width="auto" height="180px"> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3><b> Garantizamos </b></h3>
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
                                <img src="../../assets/img/ventasprincipal.png" width="100%" height="auto">
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