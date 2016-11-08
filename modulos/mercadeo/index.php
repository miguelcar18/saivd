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
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Coord. Mercadeo - SAIVD</title>
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
                                <b>COORDINACIÓN DE MERCADEO</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align:justify">
                                <label style="width:40px"></label>
                                Nuestro valor agregado como área de servicio involucra las siguientes actividades: 
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <center><img src="../../assets/img/mercadeo01.svg" height="200px" width="auto"></center>
                        </div>
                        <div class="col-md-4">
                            <center><img src="../../assets/img/mercadeo02.svg" height="200px" width="auto"></center>
                        </div>
                        <div class="col-md-4">
                            <center><img src="../../assets/img/mercadeo03.svg" height="200px" width="auto"></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <center><img src="../../assets/img/mercadeo04.svg" height="200px" width="auto"></center>
                        </div>
                        <div class="col-md-6">
                            <center><img src="../../assets/img/mercadeo05.svg" height="200px" width="auto"></center>
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