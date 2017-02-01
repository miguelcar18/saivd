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

    $nombreArchivo = $conexion->query("SELECT * FROM archivos WHERE idarchivo = ".$_GET['id']."");
    $camposArchivo = $nombreArchivo->fetch_array();

    $archivos= $conexion->query("SELECT * FROM archivos WHERE idarchivo = ".$_GET['id']."");
    if(!$archivos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Archivos  <?= $camposArchivo['nombrel'] ?> - SAIVD</title>
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
                                <b>ARCHIVO  <?= strtoupper($camposArchivo['nombrel']) ?></b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <a href="javascript:history.back()" class="btn btn-primary">Regresar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            while($row = $archivos->fetch_array())
                            {
                                $separar = explode(".", $row['nombrel']);
                                $nombreModulo = $conexion->query("SELECT nombre FROM modulos WHERE idmodulo = ".$row['fkmodulo']."");
                                $camposModulo = $nombreModulo->fetch_array();
                                ?>
                                <div class="col-md-12">
                                    <?php
                                    if(end($separar) == 'pdf')
                                    {
                                    ?>
                                        <object width="100%" height="500px" type="application/pdf" data="../../archivos/mercadeo/<?= $camposModulo['nombre'].'/'.$row['nombrel']?>"></object>
                                    <?php
                                    }
                                    else if(end($separar) == 'mp4' || end($separar) == 'mov')
                                    {
                                    ?>
                                        <video  width="100%" height="auto" src="../../archivos/mercadeo/<?= $camposModulo['nombre'].'/'.$row['nombrel']?>" controls></video>
                                    <?php
                                    }
                                    else if(end($separar) == 'wmv')
                                    {
                                    ?>
                                            <object data="../../archivos/mercadeo/<?= $camposModulo['nombre'].'/'.$row['nombrel']?>" type="video/x-ms-wmv" width="100%" height="auto"></object>
                                    <?php
                                    }
                                    else if(end($separar) == 'jpg' || end($separar) == 'jpeg' || end($separar) == 'gif' || end($separar) == 'png' || end($separar) == 'svg')
                                    {
                                    ?>
                                        <img src="../../archivos/mercadeo/<?= $camposModulo['nombre'].'/'.$row['nombrel']?>" width="100%" height="auto">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php 
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