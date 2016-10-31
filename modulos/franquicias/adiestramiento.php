<?php
    session_start();
    if (empty($_SESSION['usuario']) || $_SESSION['fkdepartamento'] != 3)
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $adiestramientos= $conexion->query("SELECT * FROM modulos WHERE fkdepartamento = 3 ORDER BY nivel_mod");
    if(!$adiestramientos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Adiestramiento Franquicias - SAIVD</title>
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
                                <b>ADIESTRAMIENTO - FRANQUICIAS</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <?php 
                        $contador = 0;
                        while($row = $adiestramientos->fetch_array())
                        { 
                            ?>
                            <div class="col-md-3">
                                <div class="panel panel-primary text-center no-boder bg-color-blue">
                                    <div class="panel-body">
                                        <i class="fa fa-book fa-5x"></i>
                                    </div>
                                    <div class="panel-footer back-footer-blue">
                                         <a href="#" style="color:white; font-weight: bold;"><?= $row['nombre'] ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $contador++;
                            if($contador == 4)
                            {
                                ?>
                                </div>
                                <div class="row">
                                <?php
                                $contador = 0;
                            } 
                        }
                        ?>
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