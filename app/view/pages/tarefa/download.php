<?php
if (isset($_GET['file'])) {
    $string = '\"';
    $string = str_replace(array('"'), "", $string);

    $string2 ="view\pages\'tarefa\'";
    $string2 = str_replace(array("'"), "", $string2);

    $filePath =  __DIR__ . $_GET['file'];
    $filePath = str_replace(array('..'), '',$filePath);
    $filePath = str_replace(array('/'), $string,$filePath);
    $filePath = str_replace(array($string2), "",$filePath);
    
    var_dump($filePath); 
    if (file_exists($filePath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
        exit;
    } else {
        echo 'Arquivo não encontrado.';
    }
} else {
    echo 'Parâmetro de arquivo ausente.';
}
?>
