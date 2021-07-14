<?php

require __DIR__ . '/vendor/autoload.php';

require "util.php";

// If we have vote contents, add them to the appropriate file
if (isset($S_POST['votedata'])) {
 append_vote($S_POST['pin'], $S_POST['votedata']);
 header('Location: /results.php?pin=' . $S_POST["pin"]);
 exit();
}

$votedata = get_vote($S_GET["pin"]);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('vote.html', ['votedata' => $votedata]);

?>