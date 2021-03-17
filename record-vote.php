<?php

require "util.php";

$file = "votes/".$S_POST["pin"].".json";

// read old vote data
$votes = json_decode(file_get_contents($file));

// make array if it isn't (e.g. file hasn't been created)
is_array($votes) ? : $votes = array();

// create vote data
$vote = [
  "time" => time(),
  "ip" => $_SERVER['REMOTE_ADDR'],
  "session-id" => session_id(),
  "contents" => $S_POST["votedata"]
];

// add to existing votes
array_push($votes, $vote);

file_put_contents($file, json_encode($votes, JSON_PRETTY_PRINT));

header('Location: /results.php?pin=' . $S_POST["pin"]);
?>
