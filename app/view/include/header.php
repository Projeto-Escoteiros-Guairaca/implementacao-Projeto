<?php
#Nome do arquivo: view/include/header.php
#Objetivo: header a ser utilizados em todas as páginas do projeto
?>
<!DOCTYPE html>
<html lang="pt">
<head onload="const BASEURL = <?= BASEURL?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL?>/view/styles/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../view/styles/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="..\view\pages\home\images\escoteira_favicon.ico" type="image/x-icon">
    <title><?php echo APP_NAME; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.6/examples/navbars/">
    <link rel="stylesheet" href="<?= BASEURL ?>/view/styles/footer.css">


</head>
<body onload="carregar_modo()">
