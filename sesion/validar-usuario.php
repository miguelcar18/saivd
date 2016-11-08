<?php
    session_start();
    include("../conexion/conexion-bd.php");
    include("../conexion/funciones.php");

    $usuario = $_POST['usuario'];
    $clave = $_POST['password'];

    $consulta_usuario = $conexion->query("
        SELECT 
        * 
        FROM 
        usuarios 
        WHERE 
        usuario = '$usuario' 
        AND  
        password='" . md5($clave) . "' 
    ") or die ($conexion->error);

    if ($consulta_usuario->num_rows > 0) 
    {
        $campoUsuario = $consulta_usuario->fetch_array();
        $_SESSION['usuario']        = $usuario;
        $_SESSION['id_usuario']     = $campoUsuario ['idusuario'];
        $_SESSION['nombre']         = $campoUsuario ['nombre'];
        $_SESSION['apellido']       = $campoUsuario ['apellido'];
        $_SESSION['cedula']         = $campoUsuario ['cedula'];
        $_SESSION['cargo']          = $campoUsuario ['cargo'];
        $_SESSION['fkdepartamento'] = $campoUsuario ['fkdepartamento'];
        $_SESSION['rol']            = $campoUsuario ['rol'];

        if($campoUsuario ['fkdepartamento'] == $_POST['dpto'] || $campoUsuario ['rol'] == 1)
        {
            $consulta_departamento = $conexion->query("
                SELECT 
                * 
                FROM 
                departamentos 
                WHERE 
                iddepartamento = '".$_POST['dpto']."' 
            ") or die ($conexion->error);
            $campoDepartamento = $consulta_departamento->fetch_array();
            ?>

            <script language="javascript" type="text/javascript">
                window.location.replace("modulos/<?= strtolower(quitar_tildes($campoDepartamento['nombre'])) ?>/index.php");
            </script>

            <?php
        }
        else 
        {
            echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align:left\"><i class=\"fa fa-ban\"></i> <b>Error: </b> Este usuario no pertenece al departamento seleccionado.</div>";
        }
    } 
    else 
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align:left\"><i class=\"fa fa-ban\"></i> <b>Error: </b> Usuario o contraseña incorrectos. Si no esta registrado contacte a su coordinador.</div>";
    }

?>