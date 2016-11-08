<?php include('rutas.php') ?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <?php
            /*Si no existe ningún usuario logueado*/ 
            if(!isset($_SESSION['usuario']))
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>index.php" <?php if($url_actual=='index.php')echo 'class="active-menu"'; ?>><i class="fa fa-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>index.php"><i class="fa fa-file-o"></i> Guía de adiestramiento</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>assets/img/organigrama.png"><i class="fa fa-sitemap"></i> Organigrama</a>
                </li>
                <br>
                    <center>
                        <img src="<?= $ruta ?>assets/img/botellas-polar.png" height="140px" width="auto">
                    </center>
                
                <br>
                    <center>
                        <img src="<?= $ruta ?>assets/img/malta-polar.png" height="100px" width="auto">
                    </center>
                <br>
                
                    <center>
                        <img src="<?= $ruta ?>assets/img/carorena.png" height="140px" width="auto">
                    </center>
                
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de ventas*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 1 && strpos($_SERVER["REQUEST_URI"], 'distribucion/') === false && strpos($_SERVER["REQUEST_URI"], 'franquicias/') === false && strpos($_SERVER["REQUEST_URI"], 'mercadeo/') === false) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 1 && strpos($_SERVER["REQUEST_URI"], 'ventas/') !== false))
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/index.php" <?php if($url_actual=='ventas/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Ventas</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/adiestramiento.php" <?php if($url_actual=='ventas/adiestramiento.php')echo 'class="active-menu"'; ?>><i class="fa fa-book"></i> Módulos de adiestramiento</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/listado-evaluaciones.php" <?php if($url_actual=='ventas/listado-evaluaciones.php' || $url_actual=='ventas/instrucciones-evaluacion.php' || $url_actual=='ventas/evaluacion.php')echo 'class="active-menu"'; ?>><i class="fa fa-check-square"></i> Evaluaciones</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/instrucciones-evaluacion-final.php" <?php if($url_actual=='ventas/instrucciones-evaluacion-final.php' || $url_actual=='ventas/evaluacion-final.php')echo 'class="active-menu"'; ?>><i class="fa fa-graduation-cap"></i> Evaluación final</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/estadisticas.php" <?php if($url_actual=='ventas/estadisticas.php')echo 'class="active-menu"'; ?>><i class="fa fa-pie-chart"></i> Estadísticas</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/modulos-ventas/listado.php" <?php if($url_actual=='modulos-ventas/listado.php' || $url_actual=='modulos-ventas/agregar.php' || strpos($url_actual, 'modulos-ventas/editar.php') !== false || strpos($url_actual, 'test-ventas/listado.php') !== false || strpos($url_actual, 'test-ventas/agregar.php') !== false || strpos($url_actual, 'test-ventas/editar.php') !== false)echo 'class="active-menu"'; ?>><i class="fa fa-cog"></i> Configuración</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de distribución*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 2 && strpos($_SERVER["REQUEST_URI"], 'ventas/') === false && strpos($_SERVER["REQUEST_URI"], 'franquicias/') === false && strpos($_SERVER["REQUEST_URI"], 'mercadeo/') === false) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 1 && strpos($_SERVER["REQUEST_URI"], 'distribucion/') !== false))
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/index.php" <?php if($url_actual=='distribucion/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Distribución</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/adiestramiento.php" <?php if($url_actual=='distribucion/adiestramiento.php')echo 'class="active-menu"'; ?>><i class="fa fa-book"></i> Módulos de adiestramiento</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/listado-evaluaciones.php" <?php if($url_actual=='distribucion/listado-evaluaciones.php' || $url_actual=='distribucion/instrucciones-evaluacion.php' || $url_actual=='distribucion/evaluacion.php')echo 'class="active-menu"'; ?>><i class="fa fa-check-square"></i> Evaluaciones</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/instrucciones-evaluacion-final.php" <?php if($url_actual=='distribucion/instrucciones-evaluacion-final.php' || $url_actual=='distribucion/evaluacion-final.php')echo 'class="active-menu"'; ?>><i class="fa fa-graduation-cap"></i> Evaluación final</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/estadisticas.php" <?php if($url_actual=='distribucion/estadisticas.php')echo 'class="active-menu"'; ?>><i class="fa fa-pie-chart"></i> Estadísticas</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/modulos-distribucion/listado.php" <?php if($url_actual=='modulos-distribucion/listado.php' || $url_actual=='modulos-distribucion/agregar.php' || strpos($url_actual, 'modulos-distribucion/editar.php') !== false || strpos($url_actual, 'test-distribucion/listado.php') !== false || strpos($url_actual, 'test-distribucion/agregar.php') !== false || strpos($url_actual, 'test-distribucion/editar.php') !== false)echo 'class="active-menu"'; ?>><i class="fa fa-cog"></i> Configuración</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de franquicias*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 3 && strpos($_SERVER["REQUEST_URI"], 'ventas/') === false && strpos($_SERVER["REQUEST_URI"], 'distribucion/') === false && strpos($_SERVER["REQUEST_URI"], 'mercadeo/') === false) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 1 && strpos($_SERVER["REQUEST_URI"], 'franquicias/') !== false))
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/index.php" <?php if($url_actual=='franquicias/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Franquicias</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/adiestramiento.php" <?php if($url_actual=='franquicias/adiestramiento.php')echo 'class="active-menu"'; ?>><i class="fa fa-book"></i> Módulos de adiestramiento</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/listado-evaluaciones.php" <?php if($url_actual=='franquicias/listado-evaluaciones.php' || $url_actual=='franquicias/instrucciones-evaluacion.php' || $url_actual=='franquicias/evaluacion.php')echo 'class="active-menu"'; ?>><i class="fa fa-check-square"></i> Evaluaciones</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/instrucciones-evaluacion-final.php" <?php if($url_actual=='franquicias/instrucciones-evaluacion-final.php' || $url_actual=='franquicias/evaluacion-final.php')echo 'class="active-menu"'; ?>><i class="fa fa-graduation-cap"></i> Evaluación final</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/estadisticas.php" <?php if($url_actual=='franquicias/estadisticas.php')echo 'class="active-menu"'; ?>><i class="fa fa-pie-chart"></i> Estadísticas</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/modulos-franquicias/listado.php" <?php if($url_actual=='modulos-franquicias/listado.php' || $url_actual=='modulos-franquicias/agregar.php' || strpos($url_actual, 'modulos-franquicias/editar.php') !== false || strpos($url_actual, 'test-franquicias/listado.php') !== false || strpos($url_actual, 'test-franquicias/agregar.php') !== false || strpos($url_actual, 'test-franquicias/editar.php') !== false)echo 'class="active-menu"'; ?>><i class="fa fa-cog"></i> Configuración</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de mercadeo*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 4 && strpos($_SERVER["REQUEST_URI"], 'ventas/') === false && strpos($_SERVER["REQUEST_URI"], 'distribucion/') === false && strpos($_SERVER["REQUEST_URI"], 'franquicias/') === false) || (isset($_SESSION['rol']) && $_SESSION['rol'] == 1 && strpos($_SERVER["REQUEST_URI"], 'mercadeo/') !== false))
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/index.php" <?php if($url_actual=='mercadeo/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Mercadeo</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/adiestramiento.php" <?php if($url_actual=='mercadeo/adiestramiento.php')echo 'class="active-menu"'; ?>><i class="fa fa-book"></i> Módulos de adiestramiento</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/listado-evaluaciones.php" <?php if($url_actual=='mercadeo/listado-evaluaciones.php' || $url_actual=='mercadeo/instrucciones-evaluacion.php' || $url_actual=='mercadeo/evaluacion.php')echo 'class="active-menu"'; ?>><i class="fa fa-check-square"></i> Evaluaciones</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/instrucciones-evaluacion-final.php" <?php if($url_actual=='mercadeo/instrucciones-evaluacion-final.php' || $url_actual=='mercadeo/evaluacion-final.php')echo 'class="active-menu"'; ?>><i class="fa fa-graduation-cap"></i> Evaluación final</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/estadisticas.php" <?php if($url_actual=='mercadeo/estadisticas.php')echo 'class="active-menu"'; ?>><i class="fa fa-pie-chart"></i> Estadísticas</a>
                </li>
                <li>
                    <a href="<?= $ruta ?>modulos/modulos-mercadeo/listado.php" <?php if($url_actual=='modulos-mercadeo/listado.php' || $url_actual=='modulos-mercadeo/agregar.php' || strpos($url_actual, 'modulos-mercadeo/editar.php') !== false || strpos($url_actual, 'test-mercadeo/listado.php') !== false || strpos($url_actual, 'test-mercadeo/agregar.php') !== false || strpos($url_actual, 'test-mercadeo/editar.php') !== false)echo 'class="active-menu"'; ?>><i class="fa fa-cog"></i> Configuración</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y es un administrador*/
            if(isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2))
            { 
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/usuarios/listado.php" <?php if($url_actual=='usuarios/listado.php' || $url_actual=='usuarios/agregar.php' || strpos($url_actual, 'usuarios/editar.php') !== false)echo 'class="active-menu"'; ?>><i class="fa fa-users"></i> Administración</a>
                </li>
                <?php 
            }

            /*Si existe algún usuario logueado*/
            if(isset($_SESSION['usuario']))
            { 
                ?>
                <li>
                    <a href="<?= $ruta ?>sesion/cerrar-sesion.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                </li>
                <?php 
            }
            ?>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->