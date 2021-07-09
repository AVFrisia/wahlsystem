<?php
require "util.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta name="generator" content="HTML Tidy for HTML5 for Linux version 5.7.28">
  <title>Wahl</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/css/uikit.min.css">
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.0/dist/js/uikit-icons.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="uk-container uk-container-xsmall uk-margin-medium-top">
      <h1 class="uk-heading-line uk-text-center"><span>Wahlsystem</span></h1>
    <div uk-grid="" class="uk-child-width-expand@s uk-grid-divider">
      <div>
        <h2>Stimme Abgeben</h2>
        <p>Ich habe schon einen PIN für einen Wahlgang bekommen.</p>
        <form class="pure-form pure-form-stacked" action="vote.php" method="get">
          <input type="number" class="uk-input uk-width-auto" name="pin" placeholder="PIN" required=""> <button type="submit" class="uk-button uk-button-primary uk-width-auto">Los</button>
        </form>
      </div>
      <div>
        <h2>Neuen Wahlgang Starten</h2>
        <p>Ich möchte einen neuen Wahlgang starten.</p>
        <form action="create-vote.php" method="post">
          <input type="hidden" name="pin" value="<?php echo pin(4) ?>"> <button type="submit" class="uk-button uk-button-default uk-width-expand">Los</button>
        </form>
      </div>
    </div><img src="/waal.svg">
    <p><i>Der Wahl Wal wünscht wunderbare Wahlen.</i></p>
  </div><?php require "footer.php"; ?>
</body>
</html>
