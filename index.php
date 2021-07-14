<?php

require __DIR__ . '/vendor/autoload.php';
require 'util.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html');

?>