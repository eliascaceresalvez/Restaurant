<?php
//TOKEN QUE NOS DA FACEBOOK
$token = 'EAAPn8LhhX7EBO1qmFmBFqge7ThWDOaokFYumRGkrpdcnYRanMvDp27uCkdBu3ULXWzHuHOsWrBeL23JLALNxpHMg5VUUDiTb4oQdcnlPKAcSatV0U6FCkeVRyMX32U9iogfI3bLvESWJkjJ9MbyGGguKIF1sQY5Vod6MPZBZB93RJRp6aH3GUFylYPptndMap8jsXTM1ZC0RaVEabs3B4Os48Xk';
//NUESTRO TELEFONO
$telefono = '543764889852';
//URL A DONDE SE MANDARA EL MENSAJE
$url = 'https://graph.facebook.com/v21.0/482649381599228/messages';

//CONFIGURACION DEL MENSAJE
$mensaje = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"type": "template", '
        . '"template": '
        . '{'
        . '     "name": "hello_world",'
        . '     "language":{ "code": "en_US" } '
        . '} '
        . '}';
//DECLARAMOS LAS CABECERAS
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
//INICIAMOS EL CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
$response = json_decode(curl_exec($curl), true);
//IMPRIMIMOS LA RESPUESTA 
print_r($response);
//OBTENEMOS EL CODIGO DE LA RESPUESTA
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//CERRAMOS EL CURL
curl_close($curl);
?>