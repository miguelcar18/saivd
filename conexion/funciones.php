<?php

// *************************************************************************** //
// Convierte fecha de mysql a normal                                           //
// *************************************************************************** //

function cambiaf_a_normal($fecha)
{ 
	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
   	return $lafecha; 
}

// *************************************************************************** //
// Convierte fecha de normal a mysql                                           //
// *************************************************************************** //

function cambiaf_a_mysql($fecha)
{ 
	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
   	return $lafecha; 
}

// **************************************************************************************** //
// Devuelve el string con todos los caracteres alfabéticos convertidos a mayúsculas         //
// **************************************************************************************** //

function strtoupper_utf8($cadena)
{
	$convertir_de=array(
	   "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
	   "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë","ę", "ì", "í", "î", "ï",
	   "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
	   "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
	   "ь", "э", "ю", "я"
	);
	$convertir_a=array(
	   "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
	   "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë","Ę", "Ì", "Í", "Î", "Ï",
	   "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
	   "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
	   "Ь", "Э", "Ю", "Я"
	);
	
	return str_replace($convertir_de, $convertir_a, $cadena);
}
	
// ************************************************ //
// Devuelve el string con el nombre del mes         //
// ************************************************ //

function nombremes($mes)
{
	setlocale(LC_TIME, 'spanish');  
	$nombre=strftime("%B", mktime(0, 0, 0, $mes, 1, 2000)); 
	return $nombre;
}

// ************************************************ //
// Elimina los acentos de una cadena de caracteres  //
// ************************************************ //

function quitar_tildes($cadena)
{
	$no_permitidas=array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
	
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");

	$texto=str_replace($no_permitidas, $permitidas ,$cadena);

	return $texto;
}

function upload_image($destination_dir,$name_media_field){
        $tmp_name = $_FILES[$name_media_field]['tmp_name'];
        //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
        if ( is_uploaded_file($tmp_name)) 
        {        
            $img_file  = $_FILES[$name_media_field]['name'] ;                      
            $img_type  = $_FILES[$name_media_field]['type'];   
            echo 1; 
            //¿es una imágen realmente?           
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,"jpg")) || strpos($img_type,"png") )){
                //¿Tenemos permisos para subir la imágen?
                echo 2;
                if(move_uploaded_file($tmp_name, $destination_dir.'/'.$img_file)){                
                    return true;
                }
            }
        }
        //si llegamos hasta aquí es que algo ha fallado
        return false; 
    }

?>