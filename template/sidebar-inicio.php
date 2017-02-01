<?php include('rutas.php') ?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="<?= $ruta ?>index.php" <?php if($url_actual=='index.php')echo 'class="active-menu"'; ?>><i class="fa fa-home"></i> Inicio</a>
            </li>
            <?php
            if((isset($_SESSION['rol']) && $_SESSION['rol'] == 1))
            {
            ?>
            <li>
                <a href="#"><i class="fa fa-sitemap"></i> Departamentos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                    <a href="<?= $ruta ?>modulos/distribucion/index.php">Distribución</a>
                    </li>
                    <li>
                        <a href="<?= $ruta ?>modulos/franquicias/index.php">Franquicias</a>
                    </li>
                    <li>
                        <a href="<?= $ruta ?>modulos/mercadeo/index.php">Mercadeo</a>
                    </li>
                    <li>
                        <a href="<?= $ruta ?>modulos/ventas/index.php">Ventas</a>
                    </li>
                </ul>
            </li>
            <?php
            }
            /*Si existe algún usuario logueado y pertenece al departamento de ventas*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 1 ) && $_SESSION['rol'] != 1)
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/ventas/index.php" <?php if($url_actual=='ventas/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Ventas</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de distribución*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 2 ) && $_SESSION['rol'] != 1)
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/distribucion/index.php" <?php if($url_actual=='distribucion/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Distribución</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de franquicias*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 3) && $_SESSION['rol'] != 1)
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/franquicias/index.php" <?php if($url_actual=='franquicias/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Franquicias</a>
                </li>
                <?php
            }

            /*Si existe algún usuario logueado y pertenece al departamento de mercadeo*/ 
            if((isset($_SESSION['fkdepartamento']) && $_SESSION['fkdepartamento'] == 4) && $_SESSION['rol'] != 1)
            {
                ?>
                <li>
                    <a href="<?= $ruta ?>modulos/mercadeo/index.php" <?php if($url_actual=='mercadeo/index.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i> Mercadeo</a>
                </li>
                <?php
            }
            ?>
            <li>
                <a href="<?= $ruta ?>coordinaciones.php" <?php if($url_actual=='coordinaciones.php')echo 'class="active-menu"'; ?>><i class="fa fa-university"></i>Adiestramientos disponibles</a>
                </li>
                <li>
                <a href="<?= $ruta ?>modulos/descargas/index.php"><i class="fa fa-download"></i> Descargas de Información</a>
            </li>
            <li>
                <a href="<?= $ruta ?>organigrama.php"><i class="fa fa-sitemap"></i> Organigrama VyD</a>
            </li>
             <li>
                <a href="<?= $ruta ?>assets/img/guia.pdf" target="_blank"><i class="fa fa-exclamation-triangle"></i> Ayuda </a>
            </li>
            <li>
                <center>
                    <img src="<?= $ruta ?>assets/img/botellas-polar.png" height="140px" width="auto">
                </center>
            
                <center>
                    <img src="<?= $ruta ?>assets/img/malta-polar.png" height="100px" width="auto">
                </center>
                <center>
                    <img src="<?= $ruta ?>assets/img/carorena.png" height="140px" width="auto">
                </center>
            </li>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->