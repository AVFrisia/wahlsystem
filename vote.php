<?php

require_once __DIR__ . '/vendor/autoload.php';
require "util.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, ['cache' => '.cache']);

$votedata = get_vote($_GET["pin"]);

// If votedata is null, the vote hasn't been created yet
if (is_null($votedata)) {
    echo $twig->render('error.html', ['title' => "Wahl existiert nicht", 'message' => 'Eine Wahl mit PIN '.$_GET["pin"].' konnte nicht gefunden werden. Vielleicht wurde Sie noch nicht frei gegeben?']);
    exit();
}

// Stop someone from voting twice
if (has_voted($_GET['pin'])) {
    echo $twig->render('error.html', ['title' => "Schon gewählt", 'message' => 'Du hast bereits für diese Wahl eine Stimme abgegeben.']);
    exit();
 }

// If we have vote contents, add them to the appropriate file
if (isset($_POST['votedata'])) {
    append_vote($_GET['pin'], $_POST['votedata']);
    header('Location: /results.php?pin=' . $_GET["pin"]);
    exit();
   }

echo $twig->render('vote.html', ['votedata' => $votedata]);

?>
