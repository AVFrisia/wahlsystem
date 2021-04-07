<?php
  require "util.php";
?>

<?php
    // If we have inital data, create the file and redirect to the voting page
    if (isset($_POST['type'])) {
        $file = "votes/".$S_POST["pin"].".json";
        $vote = array(
            "pin" => $S_POST["pin"],
            "description" => $S_POST["description"],
            "type" => $S_POST["type"],
            "votes" => array(),
        );
        
        file_put_contents($file, json_encode($vote, JSON_PRETTY_PRINT));
        
        header('Location: /vote.php?pin=' . $S_POST["pin"]);
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Wahl Erstellen</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="content">
    <h1>Wahl Erstellen</h1>
    <form class="pure-form pure-form-aligned" action="create-vote.php" method="post">
        <fieldset>
        <div class="pure-control-group"><label for="pin">PIN</label>
            <input type="text" name="pin" value="<?php echo $S_POST["pin"] ?>" readonly >
            <span class="pure-form-message-inline">Diese Zahl muss mitgeteilt werden</span>
        </div>
        <div class="pure-control-group">
            <label for="pin">Beschreibung</label>
            <input type="text" name="description" value="Wahl <?php echo $S_POST["pin"] ?>" >
        </div>
        <div class="pure-controls">
            <label for="grade-option" class="pure-radio">
            <input type="radio" id="grade-option" name="type" value="grade" checked> Note</label>
            <label for="binary-option" class="pure-radio">
            <input type="radio" id="binary-option" name="type" value="binary"> Ja / Nein</label>
            <label for="text-option" class="pure-radio">
            <input type="radio" id="text-option" name="type" value="text"> Text</label>
        </div>
        <div class="pure-controls">
            <button type="submit" class="pure-button pure-button-primary">Starten</button>
        </div>
        </fieldset>
    </form>
</div>
<?php require "footer.php" ?>
</body>
</html>
