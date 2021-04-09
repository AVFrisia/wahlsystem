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
    <form class="pure-form pure-form-stacked" action="create-vote.php" method="post">
        <fieldset>
            <label for="pin">PIN</label>
            <input type="text" class="pure-input-1" name="pin" value="<?php echo $S_POST["pin"] ?>" readonly >
            <label for="pin">Beschreibung</label>
            <input type="text" class="pure-input-1" name="description" value="Wahl <?php echo $S_POST["pin"] ?>" >
            <label for="grade-option" class="pure-radio">
            <input type="radio" id="grade-option" name="type" value="grade" checked> <ion-icon name="ribbon"></ion-icon> Note</label>
            <label for="binary-option" class="pure-radio">
            <input type="radio" id="binary-option" name="type" value="binary"> <ion-icon name="checkmark"></ion-icon> Ja / Nein</label>
            <label for="text-option" class="pure-radio">
            <input type="radio" id="text-option" name="type" value="text"> <ion-icon name="document-text"></ion-icon> Text</label>
            <button type="submit" class="pure-button pure-button-primary pure-input-1">Starten</button>
        </fieldset>
    </form>
</div>
<?php require "footer.php" ?>
</body>
</html>
