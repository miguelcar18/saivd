<?php
    session_start();

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $nombreModulo = $conexion->query("SELECT nombre FROM modulos WHERE idmodulo = ".$_GET['id']."");
    $camposModulo = $nombreModulo->fetch_array();

    $archivos= $conexion->query("SELECT * FROM archivos WHERE fkmodulo = ".$_GET['id']."");
    if(!$archivos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Archivos  <?= $camposModulo['nombre'] ?> - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('../../template/navbar.php') ?>
            <?php include('../../template/sidebar-inicio.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-header-inicio">
                                <b>ARCHIVOS  <?= strtoupper($camposModulo['nombre']) ?></b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <?php 
                        $contador = 0;
                        if($archivos->num_rows == 0)
                        {
                            ?>
                            <div class="col-md-12">
                                <h4 class="text-center">Este módulo no contiene ningún archivo registrado</h4>
                            </div>
                            <?php
                        }
                        else
                        {
                            while($row = $archivos->fetch_array())
                            { 
                                $separar = explode(".", $row['nombrel']);
                                ?>
                                <div class="col-md-3">
                                    <div class="panel panel-primary text-center no-boder bg-color-green">
                                        <div class="panel-body">
                                            <?php
                                                if(end($separar) == 'txt')
                                                {
                                                ?>
                                                <i class="fa fa-file-text-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'doc' || end($separar) == 'docx')
                                                {
                                                ?>
                                                <i class="fa fa-file-word-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'xls' || end($separar) == 'xlsx')
                                                {
                                                ?>
                                                <i class="fa fa-file-excel-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'ppt' || end($separar) == 'pptx')
                                                {
                                                ?>
                                                <i class="fa fa-file-powerpoint-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'pdf')
                                                {
                                                ?>
                                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'mp4' || end($separar) == 'mov')
                                                {
                                                ?>
                                                <i class="fa fa-file-movie-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'zip' || end($separar) == 'rar')
                                                {
                                                ?>
                                                <i class="fa fa-file-zip-o fa-5x"></i>
                                                <?php
                                                }
                                                else if(end($separar) == 'jpg' || end($separar) == 'jpeg' || end($separar) == 'gif' || end($separar) == 'png' || end($separar) == 'svg')
                                                {
                                                ?>
                                                <i class="fa fa-file-picture-o fa-5x"></i>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <i class="fa fa-file-archive-o fa-5x"></i>
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="panel-footer back-footer-green">
                                             <a href="../../archivos/distribucion/<?= $camposModulo['nombre'].'/'.$row['nombrel']?>" style="color:white; font-weight: bold;"><?= $row['nombrel'] ?></a>
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