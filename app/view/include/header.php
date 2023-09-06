<?php
#Nome do arquivo: view/include/header.php
#Objetivo: header a ser utilizados em todas as páginas do projeto
?>
<!DOCTYPE html>
<html lang="pt">
<head onload="const BASEURL = <?= BASEURL?>">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../view/styles/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="..\view\pages\home\images\escoteira_favicon.ico" type="image/x-icon">
    <title><?php echo APP_NAME; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
        crossorigin="anonymous">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body onload="carregar_modo()">