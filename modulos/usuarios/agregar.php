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

    $departamentos= $conexion->query("SELECT * FROM departamentos ORDER BY nombre");
    if(!$departamentos)
        echo $conexion->error;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('../../template/head.php') ?>
    <title>Agregar usuario - SAIVD</title>
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
                            Agregar Usuario
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
                                <form role="form" method="POST" action="guardar.php" name="usuarioForm" id="usuarioForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Nombre</label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Apellido</label>
                                                <input class="form-control" type="text" name="apellido" id="apellido" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Cédula</label>
                                                <input class="form-control" type="text" name="cedula" id="cedula" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label> Cargo </label>
                                                <select class="form-control" name="cargo" id="cargo" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Gerente</option>
                                                    <option value="2">Coordinador</option>
                                                    <option value="3">Analista</option>
                                                    <option value="0">Franquiciado</option>
                                                    <option value="4">Supervisor</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Departamento</label>
                                                <select class="form-control" name="fkdepartamento" id="fkdepartamento" required>
                                                    <option value="">Seleccione</option>
                                                    <?php 
                                                    while($row = $departamentos->fetch_array())
                                                        { 
                                                    ?>
                                                        <option value="<?= $row['iddepartamento'] ?>"><?= $row['nombre'] ?></option>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Correo</label>
                                                <input class="form-control" type="email" name="correo" id="correo" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Nombre de usuario</label>
                                                <input class="form-control" type="text" name="usuario" id="usuario" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Contraseña</label>
                                                <input class="form-control" type="password" name="password" id="password" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Repita Contraseña</label>
                                                <input class="form-control" type="password" name="password_confirmar" id="password_confirmar" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label>Rol de usuario</label>
                                                <?php if($_SESSION['rol'] == 1) { ?>
                                                <select class="form-control" name="rol" id="rol" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Coordinador / Gerente</option>
                                                    <option value="0">Analista / Franquiciado/ Supervisor</option> 
                                                </select>
                                                <?php } else if($_SESSION['rol'] == 2) { ?>
                                                <select class="form-control" name="rol" id="rol" required>
                                                    <option value="">Seleccione</option>
                                                     <option value="1">Administrador</option>
                                                    <option value="2">Coordinador / Gerente</option>
                                                    <option value="0">Analista/ Franquiciado/Supervisor</option> 
                                                </select>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Agencia</label>
                                                <select class="form-control" name="agencia" id="agencia" required>
                                                    <option value="Maturín">Maturín</option>
                                                    <option value="Bolívar">Bolívar</option>
                                                    <option value="Puerto Ordaz">Puerto Ordaz</option>
                                                    <option value="San Félix">San Félix</option>
                                                    <option value="Tumeremo">Tumeremo</option>
                                                    <option value="Upata">Upata</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label> Estado </label>
                                                <select class="form-control" name="estado" id="estado" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Habilitado</option>
                                                    <option value="0">Inhabilitado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-success">Guardar</button>
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