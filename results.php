<?php

require_once __DIR__ . '/vendor/autoload.php';
require "util.php";

$votedata = get_vote($S_GET["pin"]);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, ['cache' => '.cache']);

echo $twig->render('results.html', ['votedata' => $votedata]);
exit();
?>
