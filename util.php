<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

// Generate a pin
/**
 * @return string
 */
function pin(int $length = 4): string
{
 if ($length == 1) {
   return strval(random_int(0, 9));
 }

 return random_int(0, 9) . pin($length - 1);
}

// returns the path of a vote based on the pin
function vote_path(string $pin): string
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
   return NULL;
 }
}

// save a vote structure to disk
function save_vote(array $vote): void
{
 $pin  = $vote["pin"];
 $file = vote_path($pin);
 $json = json_encode($vote);
 file_put_contents($file, $json, LOCK_EX);
 chmod($file, 0600);
}

// Initializes a blank vote
function initialize_vote(string $pin, string $description, string $type): void
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
function append_vote(string $pin, mixed $vote_contents): void
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
  "ip"         => sha1($_SERVER['REMOTE_ADDR']),
  "session-id" => session_id(),
  "contents"   => $parsed,
 ];

 // add to existing votes
 array_push($vote["votes"], $vote_entry);

 // write to the file
 save_vote($vote);
}

// Helper function to find out if someone is resubmitting their vote
function has_voted(string $pin): bool {
  
  $target = session_id();
  $votedata = get_vote($pin);

  foreach ($votedata['votes'] as $vote) {
    if ($vote['session-id'] == $target) {
      return true;
    }
  }
  return false;
}

// Returns a string describing the majority of counted votes to all votes
function getMaj(int $votes, int $total): string
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
