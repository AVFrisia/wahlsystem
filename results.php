<?php
require "util.php";
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Wahl</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/grids-responsive-min.css" />
    <link rel="stylesheet" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="content">
      <?php $votedata = get_vote($S_GET["pin"]); ?>
      <h1>Ergebnisse</h1>
      <h2><?php echo $votedata["description"]; ?></h2>
      <div class="pure-button-group" role="group">
        <a href="" class="pure-button pure-input-1 pure-button-primary"><ion-icon name="refresh"></ion-icon> Neuladen</a>
        <a href="/" class="pure-button pure-input-1"><ion-icon name="home"></ion-icon> Zurück</a>
        <a href="javascript:if(window.print)window.print()" class="pure-button pure-input-1"><ion-icon name="print"></ion-icon></a>
      </div>
      <br>
<?php
$votes = $votedata["votes"];

// display only if we have valid votes
if ($votes) {
 // shuffle
 shuffle($votes);

 // we want to count our "bad" votes, e.g. one person votes twice
 $sess_ids  = array();
 $bad_votes = 0;

 // additional variables for statistics
 $votes_external = 0;

 echo '<div class="pure-g">';

 // loop for each vote
 foreach ($votes as $vote) {
  // extract our data
  $id       = $vote['session-id'];
  $contents = ucwords(strtolower($vote['contents']));

  echo "<div class='pure-u-1-2 pure-u-sm-1-2 pure-u-md-1-3'>";

  // check if this vote has been cast after another by the same person
  if (in_array($id, $sess_ids)) {
   echo "<div class='card error'>" . $contents . "</div>";
   $bad_votes++;
  } else {
   echo "<div class='card' onclick='this.classList.toggle(\"counted\");'>" . $contents . "</div>";
   array_push($sess_ids, $id);
  }
  echo '</div>';
 }
 echo '</div>';
} else {
 echo ('<h2>Wahl existiert nicht!</h2>');
}
if ($votes) {
 if ($bad_votes > 0) {
  echo "<p><b>Achtung:</b> " . $bad_votes . " Stimme(n) wurden von einem Wähler neu gewählt und in <span class='error'>rot</span> markiert.</p>";
 }
 echo "<h2>Statistiken</h2>";
 echo "<p>Anzahl stimmen: " . count($votes) . "</p>";
}
?>
    </div>
    <?php require "footer.php" ?>
  </body>
</html>
