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
<body>
    <main>
    <h2>Toevoeging gelukt</h2>

_END;

require_once 'login.php';
            if ($conn->connect_error) {
                die("Fatal connection");
            }

            if (!empty($_POST['postcode'])) {
                $voornaam       = $_POST['voornaam'];
                $achternaam     = $_POST['achternaam'];
                $adres          = $_POST['adres'];
                $huisnummer     = $_POST['huisnummer'];
                $postcode       = $_POST['postcode'];
                $woonplaats     = $_POST['woonplaats'];
                $email          = $_POST['email'];
                $telefoon       = $_POST['telefoon'];   
                $website        = "leden.php";

                $naamQuery = "INSERT INTO lid VALUES" . "(NULL,'$achternaam','$voornaam','$postcode','$huisnummer')";
                $naamResult = $conn->query($naamQuery);
                if (!$naamResult) {
                    echo "INSERT failed 1<br><br>";
                }

                $insertLidnummer = $conn->insert_id;
               
                $mailQuery = "INSERT INTO email VALUES" . "('$email','$insertLidnummer')";
                $mailResult = $conn->query($mailQuery);
                if (!$mailResult) {
                    echo "E-mailadres bestaat al<br><br>";  
                }              
                    
                $telQuery = "INSERT INTO telefoonnummers VALUES" . "('$telefoon','$insertLidnummer')";
                $telResult = $conn->query($telQuery);
                if (!$telResult) {
                    echo "Telefoonnummer bestaat al<br><br>";
                }                     

                $postQuery = "INSERT INTO postcode VALUES" . "('$postcode', '$adres', '$woonplaats')";
                $postResult = $conn->query($postQuery);
                if (!$postResult) {
                    echo "Postcode bestaat al<br><br>";

                }

            }

            if  (!empty($_POST['extraLid']) && !empty($_POST['extraMail']) && !empty($_POST['extraTel'])){

                $extraLid      = $_POST['extraLid'];
                $extraMail      = $_POST['extraMail'];
                $extraTel       = $_POST['extraTel'];  
                $website        = "leden.php";

                $extraMailQuery = "INSERT INTO email VALUES" . "('$extraMail','$extraLid')";
                $extraMailResult = $conn->query($extraMailQuery);
                                     
                $extraTelQuery = "INSERT INTO telefoonnummers VALUES" . "('$extraTel','$extraLid')";
                $extraTelResult = $conn->query($extraTelQuery);

                if (!$extraMailResult || !$extraTelResult) {
                    echo "INSERT both input failed <br><br>";  
                    } 
           
                }

            else if (!empty($_POST['extraLid']) && !empty($_POST['extraMail'])){

                $extraLid      = $_POST['extraLid'];
                $extraMail      = $_POST['extraMail'];
                $website        = "leden.php";

                $extraMailQuery = "INSERT INTO email VALUES" . "('$extraMail','$extraLid')";
                $extraMailResult = $conn->query($extraMailQuery);
                
                if (!$extraMailResult) {
                    echo "INSERT extra mail failed <br><br>";  
                    } 

                } 

            else if (!empty($_POST['extraLid']) && !empty($_POST['extraTel'])){

                    $extraLid      = $_POST['extraLid'];
                    $extraTel      = $_POST['extraTel'];
                    $website        = "leden.php";
    
                    $extraTelQuery = "INSERT INTO telefoonnummers VALUES" . "('$extraTel','$extraLid')";
                    $extraTelResult = $conn->query($extraTelQuery);
                    
                    if (!$extraTelResult) {
                        echo "INSERT extra telefoon failed <br><br>";  
                        } 

                }  

                $result->close();
                $conn->close();
    
                function get_post($conn, $var)
                {
                    return $conn->real_escape_string($_POST[$var]);
                }

?>
    <main>

</body>
</html>
