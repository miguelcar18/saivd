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
        $conexion       = $GLOBALS["conexion"];
        $contenidop     = $_POST['pregunta'];
        $tipo_respuesta = $_POST['tipo_respuesta'];
        $fkmodulo       = $_POST['fkmodulo'];

        $stringGuardarPregunta = "insert into preguntas ("
            . "contenidop, "
            . "fkmodulo, "
            . "tipo_respuesta "
            . ") values ("
            . "'".$contenidop."', "
            . "'".$fkmodulo."', "
            . "'".$tipo_respuesta."' "
            . ")";

        //Comprobar que no este duplicado
        $revision = consultaNuevo($contenidop, $fkmodulo, $tipo_respuesta);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Pregunta ya existente', 'alert-danger');
        }
        else
        {
            $queryGuardar   =  $conexion->query($stringGuardarPregunta);
            $ultimoId       =  $conexion->insert_id;

            for($i = 0; $i < count($_POST['respuestaA']); $i++)
            {
                $respuesta  = $_POST['respuestaA'][$i];
                $opcion     = $_POST['opcionA'][$i];

                $stringGuardarRespuesta = "insert into respuestas ("
                . "contenido, "
                . "fkpregunta, "
                . "correcta "
                . ") values ("
                . "'".$respuesta."', "
                . "'".$ultimoId."', "
                . "'".$opcion."' "
                . ")";

                $queryGuardarRespuestas =  $conexion->query($stringGuardarRespuesta);
            }

            mensaje('Pregunta y respuestas guardadas satisfacoriamente', 'alert-success');
            limpiarFormulario();
        }
    }

    function consultaNuevo($contenidop, $fkmodulo, $tipo_respuesta)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM preguntas WHERE 
        contenidop = $contenidop 
        AND fkmodulo = '$fkmodulo' 
        AND tipo_respuesta = '$tipo_respuesta' 
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

        $('form#preguntaVentasForm').each(function () {
            this.reset();
        });
        $("#respuestasTabla tbody > tr").remove();

        </script><?php
    }

    function consultaEditar($idpregunta, $contenidop, $fkmodulo, $tipo_respuesta)
    {
        $conexion = $GLOBALS["conexion"];
        $stringConsulta = "SELECT * FROM preguntas WHERE 
        idpregunta != $idpregunta 
        AND 
        (contenidop = '$contenidop' 
        AND fkmodulo = '$fkmodulo' 
        AND tipo_respuesta = '$tipo_respuesta')
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
        $contenidop     = $_POST['pregunta'];
        $tipo_respuesta = $_POST['tipo_respuesta'];
        $fkmodulo       = $_POST['fkmodulo'];
        $idOriginal     = $_POST['id'];
        //$archivos   = $_FILES['archivos'];

        $stringEditar = "UPDATE preguntas SET "
            . "contenidop= '".$contenidop."', "
            . "tipo_respuesta= '".$tipo_respuesta."', "
            . "fkmodulo= '".$fkmodulo."' "
            . "WHERE idpregunta=".$idOriginal;

        //Comprobar que no este duplicado
        $revision = consultaEditar($idOriginal, $contenidop, $fkmodulo, $tipo_respuesta);

        if($revision > 0)
        {
            mensaje('<strong>Error: </strong>Datos ya existentes o no ha realizado ninguna modificación', 'alert-danger');
        }
        else
        {
            $queryGuardar   =  $conexion->query($stringEditar);

            $stringRespuestas   = "SELECT * FROM respuestas WHERE fkpregunta = ".$idOriginal;
            $consultaRespuestas = $conexion->query($stringRespuestas);

            while($row = $consultaRespuestas->fetch_array())
            {
                $respuestasBD[]     = $row['contenido'];
                $idRespuestasBD[]   = $row['idrespuesta'];
            }

            for($i = 0; $i < count($_POST['respuestaA']); $i++)
            {
                if(!in_array($_POST["respuestaA"][$i], $respuestasBD))
                {
                    $respuesta  = $_POST['respuestaA'][$i];
                    $opcion     = $_POST['opcionA'][$i];

                    $stringGuardarRespuesta = "insert into respuestas ("
                    . "contenido, "
                    . "fkpregunta, "
                    . "correcta "
                    . ") values ("
                    . "'".$respuesta."', "
                    . "'".$idOriginal."', "
                    . "'".$opcion."' "
                    . ")";
                    $queryGuardarRespuestas =  $conexion->query($stringGuardarRespuesta);
                }

                else if(in_array($_POST["respuestaA"][$i], $respuestasBD))
                {
                    $respuesta          = $_POST['respuestaA'][$i];
                    $opcion             = $_POST['opcionA'][$i];

                    $buscarId           = "SELECT * FROM respuestas WHERE contenido = '".$respuesta."' AND fkpregunta = ".$idOriginal; 

                    $consultaBuscarId   = $conexion->query($buscarId);
                    $campoBuscaId       = $consultaBuscarId->fetch_array();
                    $idRespuesta        = $campoBuscaId["idrespuesta"];

                    $stringEditarRespuesta = "UPDATE respuestas SET "
                    . "contenido = '".$respuesta."', "
                    . "fkpregunta = ".$idOriginal.", "
                    . "correcta = ".$opcion." "
                    . "WHERE idrespuesta = ".$idRespuesta;
                    $queryEditarRespuestas =  $conexion->query($stringEditarRespuesta);
                }
            }

            for($j = 0; $j < count($respuestasBD); $j++)
            {
                if(!in_array($respuestasBD[$j], $_POST["respuestaA"]))
                {
                    $stringEliminarRespuesta = "delete from respuestas where "
                    . "idrespuesta = ".$idRespuestasBD[$j];
                    $queryEliminarRespuestas =  $conexion->query($stringEliminarRespuesta);
                }
            }

            mensaje('Pregunta actualizada satisfacoriamente', 'alert-success');
        }    
    }

    function eliminar($id)
    {
        $conexion                   = $GLOBALS["conexion"];
        $stringEliminarRespuestas   = "delete from respuestas where fkpregunta=".$id;
        $queryEliminarRespuestas    = $conexion->query($stringEliminarRespuestas);
        $stringEliminarPregunta     = "delete from preguntas where idpregunta=".$id;
        $queryEliminarPregunta      = $conexion->query($stringEliminarPregunta);
        mensaje('Pregunta y respuestas eliminadas satisfacoriamente', 'alert-success');
    }