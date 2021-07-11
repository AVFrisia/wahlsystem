<?php
require "util.php";
// If we have inital data, create the file and redirect to the voting page
if (isset($S_POST['type'])) {
    initialize_vote($S_POST['pin'], $S_POST['description'], $S_POST['type']);
    header('Location: /vote.php?pin=' . $S_POST["pin"]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta name="generator" content="HTML Tidy for HTML5 for Linux version 5.7.28">
    <title>
      Wahl Erstellen
    </title>
    <link rel="stylesheet" href="/vendor/uikit/uikit/dist/css/uikit.min.css">
    <script src="/vendor/uikit/uikit/dist/js/uikit.min.js"></script>
    <script src="/vendor/uikit/uikit/dist/js/uikit-icons.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="uk-container uk-container-xsmall uk-margin-medium-top">
      <h1 class="uk-heading-line uk-text-center"><span>Wahlgang Erstellen</span></h1>
      <form class="uk-form-horizontal" action="create-vote.php" method="post">
        <div class="uk-margin">
          <label class="uk-form-label" for="pin">PIN</label>
          <div class="uk-form-controls">
            <input type="text" class="uk-input" name="pin" value="<?php echo $S_POST['pin'] ?>" readonly>
          </div>
        </div>
        <div class="uk-margin">
          <label class="uk-form-label" for="pin">Beschreibung</label>
          <div class="uk-form-controls">
            <input type="text" class="uk-input" name="description" placeholder="Wahl zum Senior..." value="">
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-label">
            Art der Wahl
          </div>
          <div class="uk-form-controls uk-form-controls-text">
            <label for="grade-option"><input class="uk-radio" type="radio" id="grade-option" name="type" value="grade" checked> <span uk-icon="hashtag"></span> Note</label><br>
            <label for="binary-option"><input class="uk-radio" type="radio" id="binary-option" name="type" value="binary"> <span uk-icon="pencil"></span> Dafür/Dagegen</label><br>
            <label for="text-option"><input class="uk-radio" type="radio" id="text-option" name="type" value="text"> <span uk-icon="comments"></span> Text</label>
          </div>
        </div>
        <div class="uk-margin">
          <div class="uk-form-controls">
            <button type="submit" class="uk-button uk-button-primary uk-width-expand">Starten</button>
          </div>
        </div>
      </form>
      <div uk-alert="" class="uk-alert-warning">
        <b>Hinweis:</b> der PIN ist erst <i>nach</i> dem Starten der Wahl gültig.
      </div>
    </div><?php require "footer.php" ?>
  </body>
</html>
