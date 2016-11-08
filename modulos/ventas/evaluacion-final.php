<?php
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] == 2 && $_SESSION['fkdepartamento'] != 1) || ($_SESSION['rol'] == 0 && $_SESSION['fkdepartamento'] != 1))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php"); 

    $limitesModulos = $conexion->query("SELECT min(idmodulo) AS minimoModulo, max(idmodulo) AS maximoModulo FROM modulos WHERE fkdepartamento = ".$_GET['departamento']."");
    $camposLimitesModulos = $limitesModulos->fetch_array();

    $limites = $conexion->query("SELECT min(idpregunta) AS minimo, max(idpregunta) AS maximo FROM preguntas WHERE fkmodulo BETWEEN ".$camposLimitesModulos ['minimoModulo']." AND ".$camposLimitesModulos ['maximoModulo']."");
    
    $camposLimites = $limites->fetch_array();
    $pregunta1 = rand($camposLimites['minimo'], $camposLimites['maximo']);
    $pregunta2 = rand($camposLimites['minimo'], $camposLimites['maximo']);
    $pregunta3 = rand($camposLimites['minimo'], $camposLimites['maximo']);
    $pregunta4 = rand($camposLimites['minimo'], $camposLimites['maximo']);
    $pregunta5 = rand($camposLimites['minimo'], $camposLimites['maximo']);
    $consultaPreguntas= $conexion->query("SELECT * FROM preguntas WHERE idpregunta = '".$pregunta1."' OR idpregunta = '".$pregunta2."' OR idpregunta = '".$pregunta3."' OR idpregunta = '".$pregunta4."' OR idpregunta = '".$pregunta5."'");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Evaluación Final Ventas - SAIVD</title>
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
                                <b>EVALUACIÓN FINAL - VENTAS</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="rootwizard" class="form-horizontal" action="resultados-final.php" method="POST">
                                <input type="hidden" name="modulo" value="<?= $_GET['idmodulo'] ?>">
                                <input type="hidden" name="pregunta1" value="<?= $pregunta1 ?>">
                                <input type="hidden" name="pregunta2" value="<?= $pregunta2 ?>">
                                <input type="hidden" name="pregunta3" value="<?= $pregunta3 ?>">
                                <input type="hidden" name="pregunta4" value="<?= $pregunta4 ?>">
                                <input type="hidden" name="pregunta5" value="<?= $pregunta5 ?>">
                                <div class="navbar-wizard">
                                    <div class="navbar-inner">
                                        <div class="container">
                                            <ul>
                                                <li><a href="#tab1" data-toggle="tab">Pregunta 1</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Pregunta 2</a></li>
                                                <li><a href="#tab3" data-toggle="tab">Pregunta 3</a></li>
                                                <li><a href="#tab4" data-toggle="tab">Pregunta 4</a></li>
                                                <li><a href="#tab5" data-toggle="tab">Pregunta 5</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <?php 
                                        $contador = 1;
                                        while($row = $consultaPreguntas->fetch_array())
                                        {
                                        ?>
                                        <div class="tab-pane" id="tab<?= $contador ?>">
                                            <div class="form-group col-md-12">
                                                <label class="col-xs-12"><b><?= $row['contenidop'] ?></b></label>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <?php
                                                $consultaRespuestas= $conexion->query("SELECT * FROM respuestas WHERE fkpregunta = ".$row['idpregunta']."");
                                                while($rowRespuestas = $consultaRespuestas->fetch_array())
                                                {
                                                    if($row['tipo_respuesta'] == 1)
                                                    {

                                                    ?>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="respuesta<?= $contador ?>[]" id="respuesta<?= $contador ?>" value="<?= $rowRespuestas['idrespuesta'] ?>" type="radio">&nbsp;
                                                            <?= $rowRespuestas['contenido'] ?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }

                                                    if($row['tipo_respuesta'] == 2)
                                                    {

                                                    ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="respuesta<?= $contador ?>[]" id="respuesta<?= $contador ?>" value="<?= $rowRespuestas['idrespuesta'] ?>" type="checkbox">&nbsp;
                                                            <?= $rowRespuestas['contenido'] ?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                        $contador++;
                                        }
                                    ?>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="javascript:;">Anterior</a></li>
                                        <li class="next"><a href="javascript:;">Siguiente</a></li>
                                        <li class="finish"><a href="javascript:;">Finalizar</a></li>
                                    </ul>
                                </div>
                            </form>
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