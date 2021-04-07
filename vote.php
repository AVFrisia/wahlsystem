<?php
  require "util.php";
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Wahl</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="content">
      <?php
        $votedata = get_vote($S_GET["pin"]);
      ?>
      <h1>Wahlsystem</h1>
      <h2><?php echo $votedata["description"];?></h2>
      <form class="pure-form pure-form-aligned" action="record-vote.php" method="post">
        <fieldset>
        <input type="hidden" name="pin" value="<?php echo $S_GET["pin"];?>" />
        <?php
            // here we display different types of voting UIs
            switch ($votedata["type"]) {
                case "grade":
                    ?>
                        <div class="pure-control-group">
                            <label for="grade">Note</label>
                            <input id="grade" type="number" name="votedata" min="1" max="5" value="1">
                            <span class="pure-form-message-inline">Eine Zahl von 1-5</span>
                        </div>
                    <?php
                    break;
                case "binary":
                    ?>
                        <div class="pure-controls">
                            <label for="yes-vote" class="pure-radio">
                            <input type="radio" id="yes-vote" name="votedata" value="Dafür" checked> Stimme Dafür</label>
                            <label for="no-vote" class="pure-radio">
                            <input type="radio" id="no-vote" name="votedata" value="Dagegen"> Stimme Dagegen</label>
                        </div>
                    <?php
                    break;
                case "text":
                    ?>
                        <textarea class="pure-input-1" name="votedata" placeholder="Stimme..."></textarea>
                    <?php
                    break;
            }
        ?>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary pure-input-2-3">Abgeben</button>
            </div>
        </fieldset>
      </form>
      <p>
        Mit der Stimmabgabe bestätige ich mein Stimmrecht und sehe ein dass eine Abgabe permanent ist. Ich bin Einverstanden, dass jeder Wahlgang zwecks Bewertung 7 Tage <b>anonym</b> gespeichert wird, wonach er permanent gelöscht wird.
      </p>
      <p>
        Nach Abgabe der Stimme bin ich ebenfalls einverstanden, dass Conventsgeheimnis nach Art. 140 GO zu bewahren.
      </p>
      <p>
        <i>Juristen:</i> bitte diese Seite <b>nicht</b> neu laden!
      </p>
    </div>
    <?php require "footer.php" ?>
  </body>
</html>
