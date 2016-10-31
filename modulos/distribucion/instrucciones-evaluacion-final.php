<?php
    session_start();
    if (empty($_SESSION['usuario']) || $_SESSION['fkdepartamento'] != 2)
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
        <title>Instrucciones Evaluación Distribución - SAIVD</title>
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
                                <b>INSTRUCCIONES EVALUACIÓN FINAL - DISTRIBUCIÓN</b>
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
                                        Responda las siguientes preguntas seleccionando la opción que usted considere correcta de acuerdo a lo estudiado. Debe contestar todas las preguntas que se presentan en el test. Tiene un máximo de 3  intentos para aprobar el test, sino debe realizar el  adiestramiento del módulo nuevamente. Debe acertar todas las respuestas para aprobar el test. Presione el botón "Realizar test" para comenzar.
                                    </p>
                                    <a href="evaluacion-final.php?departamento=2" class="btn btn-primary" style="font-weight: bold">Realizar test</a><br><br>
                                </fieldset>
                            </center>
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