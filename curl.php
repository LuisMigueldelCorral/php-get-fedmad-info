<?php

//$url = 'http://www.example.com';

$url = 'http://www.fedmadtm.com';

//$url = 'http://www.rfetm.es';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo '<p>HTTP code: ' . $httpcode . '</p>';

echo $output

?>