<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Noticias RFETM</title>
</head>

<body>

<?php

function curl_get_contents($url)
{
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
   $html = curl_exec($ch);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
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

// Abre el fichero usando las cabeceras HTTP establecidas arriba
$fichero = curl_get_contents('http://www.rfetm.es/categoria.php?id_categoria=1#', false, $contexto);

echo $fichero;

$fichero = explode('<td colspan="3" valign="top" align="CENTER">',$fichero)[1]; 
$fichero = explode('<hr style="color:#d52e3f;height:2px">',$fichero)[0]; 
//$fichero = '<h3>Noticias RFETM</h3>' . $fichero;
echo $fichero;

?>


</body>
</html>