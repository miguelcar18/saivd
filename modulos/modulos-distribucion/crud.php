<?php
    include("../../conexion/conexion-bd.php");
    include("../../conexion/funciones.php");

    switch ($_GET['fun']) {
        case 'c': guardar(); break;
        case 'r': mensajeError("Aqui estoy"); break;
        case 'u': editar(); break;
        case 'd': eliminar($_POST['id']); break;
    }

    function guardar()
    {
        $conexion   = $GLOBALS["conexion"];
        $nombre     = $_POST['nombre'];
        $nivel_mod  = $_POST['nivel_mod'];
        $archivos   = $_FILES['archivos'];

        if(!is_dir("../../archivos/distribucion/".$_POST['nombre']."")) 
            mkdir("../../archivos/distribucion/".$_POST['nombre']."", 0777);

        $files = array();
        foreach ($archivos  as $k => $l) {
            foreach ($l as $i => $v) {
                if (!array_key_exists($i, $files))
                    $files[$i] = array();
                $files[$i][$k] = $v;
            }
        }

        $stringGuardar = "insert into modulos ("
            . "nombre, "
            . "nivel_mod, "
            . "fkdepartamento "
            . ") values ("
            . "'".$nombre."', "
            . "'".$nivel_mod."', "
            . "'2' "
            . ")";

        //Comprobar que no este duplicado
        $revision = consultaNuevo($nombre, $nivel_mod, 2);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Módulo ya existente', 'alert-danger');
        }
        else
        {
            $queryGuardar   =  $conexion->query($stringGuardar);
            $ultimoId       =  $conexion->insert_id;

            $nombresArchivos = array();
            foreach ($files as $file) {
                $tipo               = $file["type"];
                $nombreA            = quitar_tildes(str_replace(' ', '_', $file["name"]));
                $nombresArchivos[]  = $nombreA;
                move_uploaded_file(@$file["tmp_name"], "../../archivos/distribucion/".$_POST['nombre']."/". $nombreA);

                sleep(5);

                $stringGuardarArchivo = "insert into archivos ("
                . "nombrel, "
                . "fkmodulo "
                . ") values ("
                . "'".$nombreA."', "
                . "'".$ultimoId."' "
                . ")";

                $queryGuardarArchivo =  $conexion->query($stringGuardarArchivo);
            }

            mensaje('Módulo guardado satisfacoriamente', 'alert-success');
            limpiarFormulario();
        }
    }

    function consultaNuevo($nombre, $nivel_mod, $fkdepartamento)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM modulos WHERE 
        nombre = $nombre 
        AND nivel_mod = '$nivel_mod' 
        AND fkdepartamento = '$fkdepartamento' 
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

        $('form#moduloDistribucionForm').each(function () {
            this.reset();
        });

        </script><?php
    }

    function consultaEditar($idmodulo, $nombre, $nivel_mod, $fkdepartamento)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM modulos WHERE 
        idmodulo != $idmodulo 
        AND 
        (nombre = '$nombre' 
        AND nivel_mod = '$nivel_mod' 
        AND fkdepartamento = '$fkdepartamento')
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
        $nivel_mod      = $_POST['nivel_mod'];
        $idOriginal     = $_POST['id'];
        $nombreAnterior = $_POST['nombreAnterior'];
        //$archivos   = $_FILES['archivos'];

        $stringEditar = "UPDATE modulos SET "
            . "nombre= '".$nombre."', "
            . "nivel_mod= '".$nivel_mod."' "
            . "WHERE idmodulo=".$idOriginal;

        //Comprobar que no este duplicado
        $revision = consultaEditar($idOriginal, $nombre, $nivel_mod, 2);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Datos ya existentes o no ha realizado ninguna modificación', 'alert-danger');
        }
        else
        {
            $queryGuardar =  $conexion->query($stringEditar);
            rename('../../archivos/distribucion/'.$nombreAnterior,'../../archivos/distribucion/'.$nombre);
            mensaje('Módulo actualizado satisfacoriamente', 'alert-success');
            limpiarFormulario();
        }    
    }

    function eliminar($id)
    {
        $conexion               = $GLOBALS["conexion"];
        $stringConsultarCarpeta = "select * from modulos where idmodulo=".$id;
        $queryConsultarCarpeta  = $conexion->query($stringConsultarCarpeta);
        $carpetaModulo          = $queryConsultarCarpeta->fetch_array();
        eliminarDir($carpetaModulo["nombre"]);
        $stringEliminarArchivos = "delete from archivos where fkmodulo=".$id;
        $queryEliminarArchivos  = $conexion->query($stringEliminarArchivos);
        $stringEliminarModulos  = "delete from modulos where idmodulo=".$id;
        $queryEliminarModulos   = $conexion->query($stringEliminarModulos);
        mensaje('Módulo eliminado satisfacoriamente', 'alert-success');

    }

    function eliminarDir($carpeta)
    {
        foreach(glob("../../archivos/distribucion/".$carpeta . "/*") as $archivos_carpeta)
        {
            if (is_dir($archivos_carpeta))
            {
                eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
        rmdir("../../archivos/distribucion/".$carpeta);
    }