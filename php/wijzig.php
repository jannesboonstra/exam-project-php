<?php

echo <<<_END
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv = "refresh" content = "1; url = leden.php" />
    <link rel="stylesheet" href="css/style.css">
    <title>Ledenlijst</title>
</head>
    <main>
    <h2>Wijziging gelukt</h2>
_END;

require_once 'login.php';

if ($conn->connect_error) {
    die("Fatal connection");
}

    if (!empty($_POST['wijzigPostcode']) && !empty($_POST['wijzigLid'])) {
        $wijzigLid      = $_POST['wijzigLid'];
        $adres          = $_POST['wijzigAdres'];
        $huisnummer     = $_POST['wijzigHuisnummer'];
        $postcode       = $_POST['wijzigPostcode'];
        $woonplaats     = $_POST['wijzigWoonplaats'];


        $doublequery= "SELECT postcode FROM postcode WHERE postcode='$postcode'";
        $doubleresult = $conn->query($doublequery);
        $fetchpostcode = $doubleresult->fetch_array(MYSQLI_ASSOC);
        $getpostcode = htmlspecialchars($fetchpostcode['postcode']);

        if ($postcode == $getpostcode)
        {

            $updateNaamH = "UPDATE lid SET huisnummer='$huisnummer' WHERE lidnummer='$wijzigLid'";
            $naamHResult = $conn->query($updateNaamH);
            if (!$naamHResult) {
                echo "Huisnummer Insert failed<br><br>";
            }

            $updatestraatquery = "UPDATE postcode SET straat='$adres' WHERE postcode='$postcode'";
            $updatestraatresult = $conn->query($updatestraatquery);
            if (!$updatestraatresult) {
                echo "adres update failed<br><br>";
            }

            $updateplaatsquery = "UPDATE postcode SET woonplaats='$woonplaats' WHERE postcode='$postcode'";
            $updateplaatsresult = $conn->query($updateplaatsquery);
            if (!$updateplaatsresult) {
                echo "woonplaats update failed<br><br>";
            }

        } 
        else if ($postcode != $getpostcode)
        {
            $updateNaamH = "UPDATE lid SET huisnummer='$huisnummer' WHERE lidnummer='$wijzigLid'";
            $naamHResult = $conn->query($updateNaamH);
            if (!$naamHResult) {
                echo "Huisnummer Insert failed<br><br>";
            }

            $postQuery = "INSERT INTO postcode VALUES" . "('$postcode', '$adres', '$woonplaats')";
            $postResult = $conn->query($postQuery);

            $updateNaamP = "UPDATE lid SET postcode='$postcode' WHERE lidnummer='$wijzigLid'";
            $naamPResult = $conn->query($updateNaamP);
            if (!$naamPResult) {
                echo "Postcode Insert failed<br><br>";
            }

        }

    }

    if (!empty($_POST['oldMail']) && !empty($_POST['changedMail'])){
        $oldmail = $_POST['oldMail'];
        $changemail = $_POST['changedMail'];

        echo $oldmail;

        $updatemail = "UPDATE email SET email='$changemail' WHERE email='$oldmail'";
        $updatemailresult = $conn->query($updatemail);
        if(!$updatemailresult){
            echo "veranderen van email is niet gelukt<br><br>";
        }
    }

    if (!empty($_POST['oldTel']) && !empty($_POST['changedTel'])){
        $oldtel = $_POST['oldTel'];
        $changetel = $_POST['changedTel'];
        $website        = "leden.php";

        echo $oldmail;

        $updatetel = "UPDATE telefoonnummers SET telefoonnummer='$changetel' WHERE telefoonnummer='$oldtel'";
        $updatetelresult = $conn->query($updatetel);
        if(!$updatetelresult){
            echo "veranderen van telefoonnummer is niet gelukt<br><br>";
        }
    }

    $result->close();
    $conn->close();

?>

    <main>

</body>
</html>