<?php include('rutas.php') ?>
<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= $ruta ?>index.php"><img src="<?= $ruta ?>assets/img/saivdlogo.png" height="140px" width="auto"></a>
    </div>
    <!--
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i>Mi Perfil</a>
                </li>
                </li>
                <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                </li>
            </ul>
        </li>
    </ul>
    -->
    <div class="nav navbar-top-links navbar-right">
        <a class="pull-right" href="<?= $ruta ?>index.php"><img src="<?= $ruta ?>assets/img/logo-cpolar.png" width="140px" height="auto"></a>
        <br>
        <h3><b style="color:#FFFFFF; margin-right: 4px" class="pull-right">Cervecería Polar – Territorio Oriente Sur</b></h3>
        <?php if(isset($_SESSION['nombre'])) { ?>
        <br>
        <h3><b style="color:#FFFFFF; margin-right: 4px" class="pull-right">Bienvenido <?= $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></b></h3>
        <?php } ?>
    </div>
</nav>
<!--/. NAV TOP  -->