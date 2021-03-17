<!-- Copyright (c) Johannes Arnold 2020 -->
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
      <h1>Wahlsystem</h1>
      <h2>Pin: <?php echo $S_POST["pin"];?></h2>
      <form class="pure-form pure-form-stacked" action="record-vote.php" method="post">
        <textarea class="pure-input-1" name="votedata" placeholder="Stimme..."></textarea>
        <input type="hidden" name="pin" value="<?php echo $S_POST["pin"];?>" />
        <div class="pure-button-group" role="group">
            <a href="/results.php?pin=<?php echo $S_POST["pin"];?>" class="pure-button pure-input-1-3">Enthalten</a>
            <button type="submit" class="pure-button pure-button-primary pure-input-2-3">Abgeben</button>
        </div>
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
    <?php include "footer.php" ?>
  </body>
</html>
