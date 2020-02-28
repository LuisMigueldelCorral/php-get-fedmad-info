<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Language" content="es">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <META HTTP-EQUIV="Cache-Control" content="no-cache">
  <META HTTP-EQUIV="Pragma" content="no-cache">
  <title>Noticias RFETM</title>
  <style type="text/css">
    
    .categoria{
      color: #069;
    }
    * {
        font-size: initial;
    }
    hr{
      color: #069 !important;
      background-color: #069 !important;
      height: 5px !important;
    }
    h3{
      padding:  20px;
      border-bottom: 5px solid #069;
    }
    a{
        color: #069;
    }
    .centrado{
      text-align: center;
      margin: 0 auto; 
    }

    html{
      background-color: #dbe3e8;
    }
    img{
      margin: 20px;
      border: 2px double #eee;
      padding: 5px;      
    }

  </style>
</head>

<body>

<?php

$url = "http://www.rfetm.es/categoria.php?id_categoria=1#";


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
$fichero = explode("<td colspan='3' valign='top' ALIGN='CENTER'>",$fichero)[1]; 
$fichero = explode("<hr style='color:#d52e3f;height:2px'><p align='center'>",$fichero)[0]; 
$fichero = explode('<td width="30%" valign="top" align="center" bgcolor="#eeeeee">',$fichero)[0]; 
$fichero = str_replace("news/", "http://www.rfetm.es/news/", $fichero);
$fichero = str_replace('href="', 'href="http://www.rfetm.es/news/', $fichero);
$fichero = str_replace("href='", "href='http://www.rfetm.es/news/", $fichero);

$fichero = '<h3 class="centrado">Noticias RFETM</h3>' . $fichero;
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