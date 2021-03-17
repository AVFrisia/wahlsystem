<?php
if(!isset($_SESSION)) {
    session_start();
}
  
  // ALWAYS sanitize input ;)
  $S_POST  = filter_input_array(INPUT_POST);
  $S_GET  = filter_input_array(INPUT_GET);
  
function pin($length)
{
    if ($length == 0) {
        return;
    }
    return rand(0, 9) . pin($length - 1);
}

  // auto delete files
  $days = 7;
  $path = './votes/';

  // Open the directory
if ($handle = opendir($path)) {
    // Loop through the directory
    while (false !== ($file = readdir($handle))) {
        // Check the file we're doing is actually a file
        if (is_file($path.$file)) {
            // Check if the file is older than X days old
            if (filemtime($path.$file) < ( time() - ( $days * 24 * 60 * 60 ) ) ) {
                // Do the deletion
                unlink($path.$file);
            }
        }
    }
}
?>
