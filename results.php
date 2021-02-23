<!-- Copyright (c) Johannes Arnold 2020 -->
<?php
  require "util.php";
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Wahl</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/grids-responsive-min.css" />
    <link rel="stylesheet" href="/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/eva-icons"></script>
  </head>
  <body>
    <div class="content">
      <h1>Ergebnisse für Wahl &#8470; <?php echo $S_GET["pin"] ?></h1>
      <div class="pure-button-group" role="group">
        <a href="" class="pure-button pure-input-1 pure-button-primary"><i data-eva="refresh" data-eva-fill="#ffffff" data-eva-height="1em"></i> Neuladen</a>
        <a href="/" class="pure-button pure-input-1"><i data-eva="home" data-eva-height="1em"></i> Zurück</a>
        <a href="javascript:if(window.print)window.print()" class="pure-button pure-input-1"><i data-eva="printer" data-eva-height="1em"></i></a>
      </div>
      <br>
      <?php
        $filedata = file_get_contents("votes/".$S_GET["pin"] . ".json");
        
        $votes = json_decode($filedata, true);
        
        // display only if we have valid votes
        if ($votes) {
          // shuffle
          shuffle($votes);
          
          // we want to count our "bad" votes, e.g. one person votes twice
          $sess_ids = array();
          $bad_votes = 0;

          // additional variables for statistics
          $adh = '77.23.48.125';
          $votes_external = 0;

          echo '<div class="pure-g">';
           
          // loop for each vote
          foreach ($votes as $vote) {
            // extract our data
            $id = $vote['session-id'];
            $contents = ucwords(strtolower($vote['contents']));

            if (strcmp($vote['ip'], $adh)) {
              $votes_external++;
            }

            echo "<div class='pure-u-1-2 pure-u-sm-1-2 pure-u-md-1-3'>";

            // check if this vote has been cast after another by the same person
            if (in_array($id, $sess_ids)) {
              echo "<div class='card error'>".$contents."</div>";
              $bad_votes++;
            } else {
              echo "<div class='card' onclick='this.classList.toggle(\"counted\");'>".$contents."</div>";
              array_push($sess_ids, $id);
            }

            echo '</div>';
          }
          
          echo '</div>';

        } else {
          echo('<h2>Wahl existiert nicht!</h2>');
        } 
      ?>
      <?php
        if ($votes) {
          if ($bad_votes > 0) {
            echo "<p><b>Achtung:</b> ".$bad_votes." Stimme(n) wurden von einem Wähler neu gewählt und in <span class='error'>rot</span> markiert.</p>";
          }
          echo "<h2>Statistiken</h2>";
          echo "<p>Anzahl stimmen: ".count($votes)."</p>";
          echo "<p>Davon außerhalb adH: ".$votes_external."</p>";
        }
      ?>
    </div>
    <script>
      eva.replace();
    </script>
    <?php include "footer.php" ?>
  </body>
</html>
