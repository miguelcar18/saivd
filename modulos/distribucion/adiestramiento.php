<?php
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 2) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 2))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $adiestramientos= $conexion->query("SELECT * FROM modulos WHERE fkdepartamento = 2 ORDER BY nivel_mod");
    $adiestramiendos= $conexion->query("SELECT * FROM modulos WHERE fkdepartamento = 2 ORDER BY nivel_mod");
    if(!$adiestramientos)
        echo $conexion->error;
    if(!$adiestramiendos)
        echo $conexion->error;

    $arrayIdModulos = array();
    $switch = false;
    $cantidadModulosMostrar = 0;
    while($row = $adiestramiendos->fetch_array())
    {
        $arrayIdModulos[] = $row['idmodulo'];
    }
    while ($switch == false && $cantidadModulosMostrar < count($arrayIdModulos)) {
        $cantidadModulosMostrar++;
        $estadistica = $conexion->query("SELECT * FROM estadisticas WHERE resultado = 1 AND modulo = ".$arrayIdModulos[$cantidadModulosMostrar-1]." AND usuario = ".$_SESSION['id_usuario']."");
        if($estadistica->num_rows == 0)
        {
            $switch = true;
        }
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Adiestramiento Distribución - SAIVD</title>
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
                                <b>ADIESTRAMIENTO - DISTRIBUCIÓN</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <?php 
                        $contador = 0;
                        $contadorModulos = 0;
                        if($adiestramientos->num_rows == 0)
                        {
                            ?>
                            <div class="col-md-12">
                                <h4 class="text-center">Este departamento no contiene ningún módulo registrado</h4>
                            </div>
                            <?php
                        }
                        else
                        {
                            while($row = $adiestramientos->fetch_array())
                            {
                                if($contadorModulos < $cantidadModulosMostrar)
                                {
                                    ?>
                                    <div class="col-md-3">
                                        <div class="panel panel-primary text-center no-boder bg-color-green">
                                            <div class="panel-body">
                                                <i class="fa fa-book fa-5x"></i>
                                            </div>
                                            <div class="panel-footer back-footer-green">
                                                 <a href="archivos_lista.php?id=<?= $row['idmodulo']?>" style="color:white; font-weight: bold;"><?= str_replace('_', ' ', $row['nombre']) ?></a>
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
                                $contadorModulos++;
                            }
                        }
                        ?>
                    </div>
                    <?php include('../../template/footer.php') ?>
                </div>
            </div>
        </div>
        <?php include('../../template/scripts.php') ?>
    </body>
</html>