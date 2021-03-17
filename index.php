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
      <h1>Wahlsystem</h1>
      <div class="pure-g">
        <div class="pure-u-1 pure-u-md-1-2">
          <div class="l-box">
            <h2>Wahl Beitreten</h2>
            <p>Ich habe schon einen PIN für einen Wahlgang bekommen.</p>
            <form class="pure-form pure-form-stacked" action="vote.php" method="post">
              <input type="number" class="pure-input-1" name="pin" placeholder="PIN" required=""/>
              <button type="submit" class="pure-button pure-input-1 pure-button-primary">Los</button>
            </form>
          </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-2">
          <div class="l-box">
            <h2>Neuen Wahlgang Starten</h2>
            <p>Ich möchte einen neuen Wahlgang starten.</p>
            <form class="pure-form pure-form-stacked" action="vote.php" method="post">
              <input type="hidden" name="pin" value="<?php echo pin(4) ?>" />
              <button type="submit" class="pure-button pure-input-1">Los</button>
            </form>
          </div>
        </div>
      </div>
      <div class="center">
        <p>"I love democracy."</p>
        <p><i>&#8213; Emperor Palpatine</i></p>
      </div>
    </div>
    <?php require "footer.php"; ?>
  </body>
</html>
