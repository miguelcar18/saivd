<?php 
    session_start();
    if (empty($_SESSION['usuario']) || ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2))
    { 
        ?>
        <script type="text/javascript" language="javascript">
        window.location.replace("/saivd/index.php");
        </script>
        <?php 
    }

    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php");

    $stringUsuario = "SELECT * FROM usuarios WHERE idusuario = '" . $_GET["id"] . "'";
    $datosUsuarios = $conexion->query($stringUsuario);
    $campoUsuario = $datosUsuarios->fetch_array(); 

    $departamentos= $conexion->query("SELECT * FROM departamentos ORDER BY nombre");
    if(!$departamentos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Editar usuario - SAIVD</title>
</head>
<body>
    <div id="wrapper">
        <?php include('../../template/navbar.php') ?>
        <?php include('../../template/sidebar.php') ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Editar Usuario
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Formulario de usuarios
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="guardar.php" name="usuarioForm" id="usuarioEditForm">
                                    <input type="hidden" name="id" id="id" value="<?= $campoUsuario['idusuario']?>"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Nombre</label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" value="<?= $campoUsuario['nombre']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Apellido</label>
                                                <input class="form-control" type="text" name="apellido" id="apellido" value="<?= $campoUsuario['apellido']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Cédula</label>
                                                <input class="form-control" type="text" name="cedula" id="cedula" value="<?= $campoUsuario['cedula']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Cargo</label>
                                                <input class="form-control" type="text" name="cargo" id="cargo" value="<?= $campoUsuario['cargo']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Departamento</label>
                                                <select class="form-control" name="fkdepartamento" id="fkdepartamento" required>
                                                    <option value="">Seleccione</option>
                                                    <?php 
                                                    while($row = $departamentos->fetch_array())
                                                        { 
                                                    ?>
                                                        <option value="<?= $row['iddepartamento'] ?>" <?php if($campoUsuario['fkdepartamento'] == $row['iddepartamento']) { ?> selected <?php } ?>><?= $row['nombre'] ?></option>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Correo</label>
                                                <input class="form-control" type="email" name="correo" id="correo" value="<?= $campoUsuario['correo']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Nombre de usuario</label>
                                                <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $campoUsuario['usuario']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Rol de usuario</label>
                                                <?php if($_SESSION['rol'] == 1) { ?>
                                                <select class="form-control" name="rol" id="rol" required>
                                                    <option value="" <?php if($campoUsuario['rol'] == "") { ?> selected <?php } ?>>Seleccione</option>
                                                    <option value="1" <?php if($campoUsuario['rol'] == "1") { ?> selected <?php } ?>>Administrador</option>
                                                    <option value="2" <?php if($campoUsuario['rol'] == "2") { ?> selected <?php } ?>>Coordinador / Gerente</option>
                                                    <option value="0" <?php if($campoUsuario['rol'] == "0") { ?> selected <?php } ?>>Analista</option>
                                                </select>
                                                <?php } else if($_SESSION['rol'] == 2) { ?>
                                                <select class="form-control" name="rol" id="rol" required>
                                                    <option value="" <?php if($campoUsuario['rol'] == "") { ?> selected <?php } ?>>Seleccione</option>
                                                    <option value="0" <?php if($campoUsuario['rol'] == "0") { ?> selected <?php } ?>>Analista</option>
                                                </select>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Agencia</label>
                                                <select class="form-control" name="agencia" id="agencia" required>
                                                    <option value="Maturín" <?php if($campoUsuario['agencia'] == "Maturín") { ?> selected <?php } ?>>Maturín</option>
                                                    <option value="Bolívar" <?php if($campoUsuario['agencia'] == "Bolívar") { ?> selected <?php } ?>>Bolívar</option>
                                                    <option value="Puerto Ordaz" <?php if($campoUsuario['agencia'] == "Puerto Ordaz") { ?> selected <?php } ?>>Puerto Ordaz</option>
                                                    <option value="San Félix" <?php if($campoUsuario['agencia'] == "San Félix") { ?> selected <?php } ?>>San Félix</option>
                                                    <option value="Tumeremo" <?php if($campoUsuario['agencia'] == "Tumeremo") { ?> selected <?php } ?>>Tumeremo</option>
                                                    <option value="Upata" <?php if($campoUsuario['agencia'] == "Upata") { ?> selected <?php } ?>>Upata</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="result"></div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
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