<?php

ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('html_errors', TRUE);
ini_set('error_log', '/home/sxhd01ne/public_html/codemia/_error_log.txt');

// **************** ALTERAR! Veio do DLC ************* 	
require_once('inc/class.mail.php');
require_once('inc/class.erro.php');
require_once('inc/class.db.php');
$db = new dbClass;
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
$get = $id ? '?id=' . $_GET['id'] : '';

echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/css.css?' . time() . '">    
    <link rel="stylesheet" type="text/css" href="css/' . $css . '.css?' . time() . '">    
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Codemia' . $title . '">
    <meta property="og:url" content="http://codemia.pt' . $_SERVER['PHP_SELF'] . $get . '">
    <meta property="og:image" content="http://codemia.pt/codemia/img/curso.jpg.php?id=' . $id . '">
    <meta property="og:image:secure_url" content="http://codemia.pt/codemia/img/curso.jpg.php?id=' . $id . '"> 
    <meta property="og:image:type" content="image/jpeg"> 
    <meta property="og:image:width" content="600"> 
    <meta property="og:image:height" content="450">
    <meta property="og:site_name" content="Codemia - Cursos de programação">
    <meta property="og:description" content="Codemia - Cursos de programação">
    <meta property="fb:app_id" content="966242223397117">
    <link rel="canonical" href="http://codemia.pt' . $_SERVER['PHP_SELF'] . $get . '">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"> 
    <script>this.top.location !== this.location && (this.top.location = this.location);</script>
    <title>Codemia' . $title . '</title>
</head>
<body>
<div id="wrap">
    <div id="header">
        <div class="container">
            <div id="header-logo"><a href="index.php">C:<span style="color:red">/</span>odemia</a></div>
            <div id="header-links">
                <a href="contacto.php">Contacto</a> 
                <a href="empregos.php">Empregos</a> 
                <a href="faq.php">FAQ</a>
            </div>
            <div id="header-hamburger" onClick="fn_menu()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"/>
                </svg>
            </div>
        </div>
        <div class="container">
            <div class="menu">
                <p><a href="contacto.php">Contacto</a></p>
                <p><a href="empregos.php">Empregos</a></p>
                <p><a href="faq.php">FAQ</a></p>
            </div>
        </div>
    </div> <!-- fim de header -->

    <div id="main">';
?>