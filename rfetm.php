<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Language" content="es">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META HTTP-EQUIV="Cache-Control" content="no-cache">
  <META HTTP-EQUIV="Pragma" content="no-cache">
  <title>CIRCULARES</title>
  <!-- Styles -->
  <link href="http://www.rfetm.es/css/app.css" rel="stylesheet">
  <link href="http://www.rfetm.es/css/estilo.css" rel="stylesheet">    

</head>

<body>

<?php

$url = "http://www.rfetm.es/circulares/0";


// ESTA PARTE FUNCIONA ES PARA NO SOBRECARGAR EL SERVIDOR
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

$fichero = curl_get_contents($url, false, $contexto);
$fichero = explode("<ul class=\"list-group\">",$fichero)[1]; 
$fichero = explode("</ul>",$fichero)[0]; 
/*
$fichero = str_replace("news/", "http://www.rfetm.es/news/", $fichero);
$fichero = str_replace('href="', 'href="http://www.rfetm.es/news/', $fichero);
$fichero = str_replace("href='", "href='http://www.rfetm.es/news/", $fichero);
*/
$fichero = '<h3 class="centrado">CIRCULARES TEMPORADA 2019-2020</h3>' . $fichero;
$fichero = utf8_encode($fichero);
echo $fichero;
/**/

$ch = curl_init($url);
$timestamp = curl_getinfo($ch, CURLINFO_FILETIME);
if ($timestamp != -1) { //otherwise unknown
    echo date("Y-m-d H:i:s", $timestamp); //etc
} 

?>


</body>
</html>