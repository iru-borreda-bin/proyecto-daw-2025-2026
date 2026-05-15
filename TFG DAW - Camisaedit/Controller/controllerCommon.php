<?php
// Este archivo se encargará de contener funciones comunes a varios controladores, para evitar repetir código. 
// Por ejemplo, funciones para hacer logs en la consola del navegador o para coger la fecha actual.

// Función para logear progreso en la consola de forma más sencilla (para archivos PHP)
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function alert_popup($message)
{
    echo '<script>alert(' . json_encode($message, JSON_HEX_TAG) . ');</script>';
}

function getCurrentDate()
{
    console_log('Obteniendo fecha actual para registro...');
    console_log('Fecha obtenida: ' . date("Y-m-d"));
    return date("Y-m-d");
}

?>