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

    $limitesModulos = $conexion->query("SELECT min(idmodulo) AS minimoModulo, max(idmodulo) AS maximoModulo FROM modulos WHERE fkdepartamento = 4");
    if($limitesModulos->num_rows > 0)
    {
        $camposLimitesModulos = $limitesModulos->fetch_array();

        $limites = $conexion->query("SELECT * FROM preguntas WHERE fkmodulo BETWEEN ".$camposLimitesModulos ['minimoModulo']." AND ".$camposLimitesModulos ['maximoModulo']."");
        if(!$limites)
            $cantidad = 0;
        else
            $cantidad = $limites->num_rows;
    }
    else 
        $cantidad = 0;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('../../template/head.php') ?>
        <title>Instrucciones Evaluación Mercadeo - SAIVD</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include('../../template/navbar.php') ?>
            <?php include('../../template/sidebar.php') ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <?php 
                        $contador = 0;
                        if($cantidad == 0)
                        {
                            ?>
                            <div class="col-md-12">
                                <h4 class="text-center">Este departamento no contiene ninguna pregunta registrado</h4>
                            </div>
                            <?php
                        }
                        else if($cantidad < 30)
                        {
                            ?>
                            <div class="col-md-12">
                                <h4 class="text-center">Este departamento no contiene la cantidad mínima de preguntas registradas (30 preguntas)</h4>
                            </div>
                            <?php
                        }
                        else
                        {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-header-inicio">
                                <b>INSTRUCCIONES EVALUACIÓN FINAL - MERCADEO</b>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <fieldset id="cuerpoinicio">
                                    <p class="text-center">
                                        Responda las siguientes preguntas seleccionando la opción que usted considere correcta de acuerdo a lo estudiado. Debe contestar todas las preguntas que se presentan en la evaluación. Tiene un máximo de 3  intentos para aprobar la evaluación, sino debe realizar el  adiestramiento del módulo nuevamente. Debe acertar todas las respuestas para aprobar el la evaluación. Presione el botón "Realizar Evaluación" para comenzar.
                                    </p>
                                    <a href="evaluacion-final.php?departamento=4" class="btn btn-primary" style="font-weight: bold">Realizar Evaluación</a><br><br>
                                </fieldset>
                            </center>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
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