<?php
include_once('config/url.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=$BASE_URL?>css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <div class="container-img">
        <img src="https://lirp.cdn-website.com/d8dad59b/dms3rep/multi/opt/logo-mabu-dfd0999c-640w.png">
        </div>
        <aside class="nav-buttons">
            <a href="<?= $BASE_URL ?>index.php">Estoque</a>
            <a href="<?= $BASE_URL ?>entrada.php">Entrada</a>
            <a href="<?= $BASE_URL ?>output.php">Saida</a>
        </aside>
    </header>