<?php

require "util.php";

$file = "votes/" . $S_POST["pin"] . ".json";

$votedata = array();

// read old vote data
if (file_exists($file)) {
 $votedata = json_decode(file_get_contents($file), true);
} else {
 echo "<h1>Fehler!</h1><h2>Wahl existiert nicht.</h2>";
 return;
}

// create vote data
$vote = [
 "time"       => time(),
 "ip"         => $_SERVER['REMOTE_ADDR'],
 "session-id" => session_id(),
 "contents"   => $S_POST["votedata"],
];

// add to existing votes
array_push($votedata["votes"], $vote);

// write to the file
file_put_contents($file, json_encode($votedata, JSON_PRETTY_PRINT));

// Redirect
header('Location: /results.php?pin=' . $S_POST["pin"]);
