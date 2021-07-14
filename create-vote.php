<?php

require_once __DIR__ . '/vendor/autoload.php';
require "util.php";

// If we have inital data, create the file and redirect to the voting page
if (isset($S_POST['type'])) {
    initialize_vote($S_POST['pin'], $S_POST['description'], $S_POST['type']);
    header('Location: /vote.php?pin=' . $S_POST["pin"]);
    exit();
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, ['cache' => '.cache']);

echo $twig->render('create-vote.html', ['pin' => pin()]);

?>