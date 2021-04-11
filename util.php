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
 return "votes/" . $pin . ".json";
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
function append_vote(string $pin, string $vote_contents)
{

 $vote = get_vote($pin);

 // create vote entry
 $vote_entry = [
  "time"       => time(),
  "ip"         => $_SERVER['REMOTE_ADDR'],
  "session-id" => session_id(),
  "contents"   => $vote_contents,
 ];

 // add to existing votes
 array_push($vote["votes"], $vote_entry);

 // write to the file
 save_vote($vote);
}

// auto delete files
$days = 7;
$path = './votes/';

// Open the directory
if ($handle = opendir($path)) {
 // Loop through the directory
 while (false !== ($file = readdir($handle))) {
  // Check the file we're doing is actually a file
  if (is_file($path . $file)) {
   // Check if the file is older than X days old
   if (filemtime($path . $file) < (time() - ($days * 24 * 60 * 60))) {
    // Do the deletion
    unlink($path . $file);
   }
  }
 }
}
