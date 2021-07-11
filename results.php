<?php
require "util.php";
$votedata = get_vote($S_GET['pin']);
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Wahl</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/css/uikit.min.css">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit-icons.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="uk-container uk-container-xsmall uk-margin-medium-top">
      <h1 class="uk-heading-line uk-text-center"><span>Ergebnisse</span></h1>
      <h2><?= $votedata['pin']; ?></h2>
      <div class="uk-button-group">
        <a href="" class="uk-button uk-button-primary"><span uk-icon="refresh"></span></a>
        <a href="/" class="uk-button uk-button-default"><span uk-icon="home"></span></a>
        <a href="javascript:if(window.print)window.print()" class="uk-button uk-button-default"><span uk-icon="print"></span></a>
        <button class="uk-button uk-button-default" uk-toggle="target: #modal-example"><span uk-icon="code"></span></button>
      </div>

      <div id="modal-example" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h3 class="uk-modal-title">Rohdaten</h3>
            <p>Folgende Daten dienen zur Verifizierung und Archivierung.</p>
            <p>IP-Addressen und Session IDs wurden mit einer kryptographischen Einwegfunktion gesichert.</p>
            <pre><?=json_encode($votedata, JSON_PRETTY_PRINT)?></pre>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Schließen</button>
            </p>
        </div>
    </div>
    <!--<a href="<?='data:application/json;base64,' . base64_encode(json_encode($votedata, JSON_PRETTY_PRINT));?>" download='Wahlgang.json'>daten</a>-->
      <br>
<?php
$votes = $votedata["votes"];

// display only if we have valid votes
$abstention = null;
$against = null;
$bad_votes = null;
$for = null;
$total = null;
if ($votes) {
 // shuffle
 shuffle($votes);

 // we want to count our "bad" votes, e.g. one person votes twice
 $sess_ids  = array();
 $bad_votes = 0;

 // additional variables for statistics

 echo '<div uk-grid class="uk-margin-top" uk-scrollspy="cls: uk-animation-fade uk-animation-fast; target: .uk-card; repeat: true">';

 // loop for each vote
 foreach ($votes as $vote) {
  // extract our data
  $id = $vote['session-id'];

  // different display methods for different data
  $contents = null;
  switch ($votedata["type"]) {
   case "grade":
    $total += $vote["contents"];
    $contents = number_format($vote["contents"], 1);
    break;
   case "binary":
    if (is_null($vote["contents"])) {
     $abstention++;
     $contents = "[Enthalten]";
    } elseif ($vote["contents"]) {
     $for++;
     $contents = "Dafür";
    } elseif (!$vote["contents"]) {
     $against++;
     $contents = "Dagegen";
    }
    break;
   case "text":
    $contents = $vote["contents"];
    break;
  }

  echo "<div>";

  // check if this vote has been cast after another by the same person
  if (in_array($id, $sess_ids)) {
   echo "<div class='uk-card uk-card-default uk-card-body'><div class='uk-card-badge uk-label uk-label-danger'>!</div><p>" . $contents . "</p></div>";
   $bad_votes++;
  } else {
   echo "<div class='uk-card uk-card-default uk-card-body'><p>" . $contents . "</p></div>";
   array_push($sess_ids, $id);
  }
  echo '</div>';
 }
 echo '</div>';
} else {
 echo ('<h2>Wahl existiert nicht!</h2>');
}
echo "<hr>";
if ($votes) {
 $vote_count = count($votes);

 if ($bad_votes > 0) {
  echo '<p><span uk-icon="warning"></span> <b>Achtung:</b> ' . $bad_votes . ' Stimme(n) wurden von einem Wähler neu gewählt und in <span class="error">rot</span> markiert.</p>';
 }
 echo '<p><span uk-icon="pull"></span> <b>Anzahl stimmen:</b> ' . $vote_count . '</p>';

 // calculate average if it's a grade
 switch ($votedata["type"]) {
  case "grade":
   $average = $total / $vote_count;
   echo '<p><span uk-icon="info"></span> <b>Durchschnitt:</b> ' . number_format($average, 1, ',') . ' (gerundet)</p>';
   break;
  case "binary":
   $vote_count -= $abstention;
   if ($for > $against) {
    echo '<p><span uk-icon="check"></span> <b>' . getMaj($for, $vote_count) . ' </b> ist dafür</p>';
   } elseif ($for < $against) {
    echo '<p><span uk-icon="ban"></span> <b>' . getMaj($against, $vote_count) . ' </b> ist dagegen</p>';
   } else {
    echo '<p><span uk-icon="users"></span> <b>Gleichstand.</b></p>';
   }
 }
}
?>
    </div>
    <?php require "footer.php" ?>
  </body>
</html>
