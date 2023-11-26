<?php
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];
    
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
