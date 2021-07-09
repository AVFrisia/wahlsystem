<?php
require "util.php";
// If we have vote contents, add them to the appropriate file
if (isset($S_POST['votedata'])) {
 append_vote($S_POST['pin'], $S_POST['votedata']);
 header('Location: /results.php?pin=' . $S_POST["pin"]);
 exit();
}

$votedata = get_vote($S_GET["pin"]);
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
      <h1 class="uk-heading-line uk-text-center"><span>Abstimmen</span></h1>
      <h2>PIN: <?= $S_GET["pin"]; ?></h2>
      <h2><?= $votedata["description"]; ?></h2>
      <form class="uk-form-stacked" action="vote.php" method="post">
      <div class="uk-margin">
        <input type="hidden" name="pin" value="<?= $S_GET["pin"]; ?>" />
        <?php
// here we display different types of voting UIs
switch ($votedata["type"]) {
 case "grade":
  ?>
                        <label class="uk-form-label" for="grade">Note</label>
                        <div class="uk-form-controls">
                        <select id="grade" class="uk-select" name="votedata">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        </div>
                    <?php
break;
 case "binary":
  ?>
                        <div class="uk-form-label">
          Entscheidung
        </div>
        <div class="uk-form-controls uk-form-controls-text">
        <label for="yes-vote">
                        <input class="uk-radio" type="radio" id="yes-vote" name="votedata" value="1" checked> Stimme Dafür</label><br>
                        <label for="no-vote">
                        <input class="uk-radio" type="radio" id="no-vote" name="votedata" value="0"> Stimme Dagegen</label><br>
                        <label for="abstention-vote">
                        <input class="uk-radio" type="radio" id="abstention-vote" name="votedata" value="NULL"> Stimme Enthalten</label>
        </div>
                        
                    <?php
break;
 case "text":
  ?>
                        <textarea class="uk-textarea" name="votedata" placeholder="Stimme..." required></textarea>
                    <?php
break;
}
?>
        <div class="uk-margin">
        <div class="uk-form-controls">
          <button type="submit" class="uk-button uk-button-primary uk-width-expand">Abgeben</button>
        </div>
      </div>
        </div>
      </form>
      <p>
        Mit der Stimmabgabe bestätige ich mein Stimmrecht und sehe ein dass eine Abgabe permanent ist. Ich bin Einverstanden, dass jeder Wahlgang zwecks Bewertung 7 Tage <b>anonym</b> gespeichert wird, wonach er permanent gelöscht wird.
      </p>
      <p>
        Nach Abgabe der Stimme bin ich ebenfalls einverstanden, dass Conventsgeheimnis nach Art. 140 GO zu bewahren.
      </p>
    </div>
    <?php require "footer.php" ?>
  </body>
</html>
