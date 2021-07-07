<?php
if (!isset($_SESSION)) {
 session_start();
}

// ALWAYS sanitize input ;)
$S_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$S_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Generate a pin
function pin(int $length = 4)
{
 if ($length == 0) {
  return;
 }
 return random_int(0, 9) . pin($length - 1);
}

// returns the path of a vote based on the pin
function vote_path(string $pin)
{
 return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $pin . ".json";
}

// retrieve a vote
function get_vote(string $pin)
{
 $file = vote_path($pin);
 if (file_exists($file)) {
  $votedata = json_decode(file_get_contents($file), true);
  return $votedata;
 } else {
  throw new Exception('Vote ' . $pin . ' does not exist.');
 }
}

// save a vote structure to disk
function save_vote(array $vote)
{
 $pin  = $vote["pin"];
 $file = vote_path($pin);
 $json = json_encode($vote, JSON_PRETTY_PRINT);
 file_put_contents($file, $json, LOCK_EX);
 chmod($file, 0600);
}

// Initializes a blank vote
function initialize_vote(string $pin, string $description, string $type)
{
 $vote_data = array(
  "pin"         => $pin,
  "description" => $description,
  "type"        => $type,
  "votes"       => array(),
 );
 save_vote($vote_data);
}

// append a vote to the vote file
function append_vote(string $pin, mixed $vote_contents)
{
 $vote = get_vote($pin);

 $parsed = null;

 // parse input depending on type of vote
 switch ($vote["type"]) {
  case "grade":
   $parsed = intval($vote_contents);
   break;
  case "binary":
   // workaround for abstentions
   if ($vote_contents == "NULL") {
    break;
   }
   $parsed = boolval($vote_contents);
   break;
  case "text":
   $parsed = strval($vote_contents);
   break;
 }

 // create vote entry
 $vote_entry = [
  "time"       => time(),
  "ip"         => md5($_SERVER['REMOTE_ADDR']),
  "session-id" => md5(session_id()),
  "contents"   => $parsed,
 ];

 // add to existing votes
 array_push($vote["votes"], $vote_entry);

 // write to the file
 save_vote($vote);
}

// Returns a string describing the majority of counted votes to all votes
function getMaj(int $votes, int $total)
{
 if ($votes == $total) {
  return "Einstimmige Mehrheit";
 }

 for ($i = $total; $i > 1; $i--) {
  if (($votes % $i) == 0 && ($total % $i) == 0) {
   $votes = $votes / $i;
   $total = $total / $i;
  }
 }
 return $votes . "/" . $total . " Mehrheit";
}
