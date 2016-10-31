<?php
    include("../../conexion/conexion-bd.php");

    switch ($_GET['fun']) {
        case 'c': guardar(); break;
        case 'r': mensajeError("Aqui estoy"); break;
        case 'u': editar(); break;
        case 'd': eliminar($_POST['id']); break;
    }

    function guardar()
    {
        $conexion       = $GLOBALS["conexion"];
        $nombre         = $_POST['nombre'];
        $apellido       = $_POST['apellido'];
        $cedula         = $_POST['cedula'];
        $cargo          = $_POST['cargo'];
        $fkdepartamento = $_POST['fkdepartamento'];
        $correo         = $_POST['correo'];
        $usuario        = $_POST['usuario'];
        $password       = md5($_POST['password']);
        $rol            = $_POST['rol'];
        $agencia        = $_POST['agencia'];

        $stringGuardar = "insert into usuarios ("
            . "nombre, "
            . "apellido, "
            . "cedula, "
            . "cargo, "
            . "fkdepartamento, "
            . "correo, "
            . "usuario, "
            . "password, "
            . "rol, "
            . "agencia"
            . ") values ("
            . "'".$nombre."', "
            . "'".$apellido."', "
            . "'".$cedula."', "
            . "'".$cargo."', "
            . "'".$fkdepartamento."', "
            . "'".$correo."', "
            . "'".$usuario."', "
            . "'".$password."', "
            . "'".$rol."' , "
            . "'".$agencia."' "
            . ")";

        //Comprobar que no este duplicado
        $revision = consultaNuevo($cedula, $correo, $usuario);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Usuario ya existente', 'alert-danger');
        }
        else
        {
            $queryGuardar =  $conexion->query($stringGuardar);
            mensaje('Usuario guardado satisfacoriamente', 'alert-success');
            limpiarFormulario();
        }
    }

    function consultaNuevo($cedula, $correo, $usuario)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM usuarios WHERE 
        cedula = $cedula 
        OR correo = '$correo' 
        OR usuario = '$usuario' 
        ";
        if ($sqlConsulta =  $conexion->query($stringConsulta))
            $cantidadConsulta = $sqlConsulta->num_rows;
        else
            $cantidadConsulta = 0;

        return $cantidadConsulta;
    }

    function limpiarFormulario()
    {
        ?><script type="text/javascript">

        $('form#usuarioForm').each(function () {
            this.reset();
        });

        </script><?php
    }

    function consultaEditar($idusuario, $cedula, $correo, $usuario)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM usuarios WHERE 
        idusuario != $idusuario 
        AND 
        (cedula = '$cedula' 
        OR correo = '$correo' 
        OR usuario = '$usuario')
        ";
        if ($sqlConsulta =  $conexion->query($stringConsulta))
            $cantidadConsulta = $sqlConsulta->num_rows;
        else
            $cantidadConsulta = 0;

        return $cantidadConsulta;
    }

    function mensaje($mensaje, $tipoAlerta)
    {
        ?>
        <div class="alert <?= $tipoAlerta; ?>" role="alert">
            <?= $mensaje; ?>
        </div>
        <?php
    }

    function editar()
    {
        $conexion       = $GLOBALS["conexion"];
        $nombre         = $_POST['nombre'];
        $apellido       = $_POST['apellido'];
        $cedula         = $_POST['cedula'];
        $cargo          = $_POST['cargo'];
        $fkdepartamento = $_POST['fkdepartamento'];
        $correo         = $_POST['correo'];
        $usuario        = $_POST['usuario'];
        $rol            = $_POST['rol'];
        $agencia        = $_POST['agencia'];
        $idOriginal     = $_POST['id'];

        $stringEditar = "UPDATE usuarios SET "
            . "nombre= '".$nombre."', "
            . "apellido= '".$apellido."', "
            . "cedula= '".$cedula."', "
            . "cargo= '".$cargo."', "
            . "fkdepartamento= '".$fkdepartamento."', "
            . "correo= '".$correo."', "
            . "usuario= '".$usuario."', "
            . "rol= '".$rol."', "
            . "agencia= '".$agencia."' "
            . "WHERE idusuario=".$idOriginal;

        //Comprobar que no este duplicado
        $revision = consultaEditar($idOriginal, $cedula, $correo, $usuario);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Datos ya existentes o no ha realizado ninguna modificación', 'alert-danger');
        }
        else
        {
            $queryGuardar =  $conexion->query($stringEditar);
            mensaje('Usuario actualizado satisfacoriamente', 'alert-success');
            limpiarFormulario();
        }    
    }

    function eliminar($id)
    {
        $conexion       = $GLOBALS["conexion"];
        $stringEliminar = "delete from usuarios where idusuario=".$id;
        $queryEliminar  = $conexion->query($stringEliminar);
        mensaje('Usuario eliminado satisfacoriamente', 'alert-success');

    }