<?php

function file_get_contents_utf8($fn) { 
	 $content = file_get_contents($fn); 
	 return $content;
}

// Crear un flujo
$opciones = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$contexto = stream_context_create($opciones);
$day = (date("d")+1) . "%2F" . date("m") . "%2F" . date("Y");
$cadena = 'http://www.fedmadtm.com/listar_encuentros_de_la_semana.php?fecha_act_usuario='.$day.'&club_sel=72';
$fichero = file_get_contents_utf8($cadena, false, $contexto);       
$t = explode("Exportar_a_Excel' width='720px' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='font: 85% Tahoma, Trebuchet MS, verdana, arial, sans-serif;'>",$fichero)[1]; 
$tem = explode('Total de encuentros:', $t)[0];
$tem = str_replace("nowrap", "", $tem);
$tem = str_replace(["/bgcolor=\"#85CFEB\"/"], "", $tem);
$tem = preg_replace("/clasificaciones_listar/", "http://www.fedmadtm.com/clasificaciones_listar", $tem);
$tem = str_replace("FUENCARRAL - EL PARDO T.M.", "FUENCARRAL TM", $tem);
if(strlen($tem) <= 0){
	$temp = "<p class='calendarioVacio'>Vaya parece que hay algún problema de conexión con los datos.<br><br>";
	$temp = $temp.'<a title="" href="'.$cadena.'" target="_blank" rel="noopener noreferrer">Acceso al calendario</a></p>';
}		
else if(strlen($tem) <= 59){
	$temp = "<p class='calendarioVacio'>Vaya parece que el calendario está vacío</p>";
}
else{
	    //$temp = $temp.'<p><button id="printCanvas" onclick="calendarioPrint()">Descargar</button></p>';			
    $temp = $temp.'<table id="miCalendario"><tbody>'.$tem.'</td></tr></tbody></table>';
}
echo $temp;

?>