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
    <h2>Verwijderen gelukt</h2>
<?php

require_once 'login.php';
            if ($conn->connect_error) {
                die("Fatal connection");
            }

            if (!empty($_POST['deleteLid'])) {
                $lidnummers     = $_POST['deleteLid'];

                $query = "DELETE FROM lid WHERE lidnummer='$lidnummers'";
                $result = $conn->query($query);
                if (!$result) {
                    echo "Verwijderen mislukt <br><br>";
                }
    
                $queryMail = "DELETE FROM email WHERE lidnummer='$lidnummers'";
                $resultMail = $conn->query($queryMail);
                if (!$resultMail) {
                    echo "Verwijderen mislukt <br><br>";
                }
    
                $queryTel = "DELETE FROM telefoonnummers WHERE lidnummer='$lidnummers'";
                $resultTel = $conn->query($queryTel);
                if (!$resultTel) {
                    echo "Verwijderen mislukt <br><br>";
                }
    
            }

            if  (!empty($_POST['delMail']) && !empty($_POST['delTel'])){

                $extraMail      = $_POST['delMail'];
                $extraTel       = $_POST['delTel'];  

                $extraMailQuery = "DELETE FROM email WHERE email=" . "('$extraMail')";
                $extraMailResult = $conn->query($extraMailQuery);
                                     
                $extraTelQuery = "DELETE FROM telefoonnummers WHERE telefoonnummer=" . "('$extraTel')";
                $extraTelResult = $conn->query($extraTelQuery);

                if (!$extraMailResult || !$extraTelResult) {
                    echo "INSERT both input failed <br><br>";  
                    } 
           
                }

            else if (!empty($_POST['delMail'])){

                $extraMail      = $_POST['delMail'];

                $extraMailQuery = "DELETE FROM email WHERE email=" . "('$extraMail')";
                $extraMailResult = $conn->query($extraMailQuery);
                
                if (!$extraMailResult) {
                    echo "INSERT extra mail failed <br><br>";  
                    } 

                } 

            else if (!empty($_POST['delTel'])){

                    $extraTel      = $_POST['delTel'];
    
                    $extraTelQuery = "DELETE FROM telefoonnummers WHERE telefoonnummer=" . "('$extraTel')";
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
