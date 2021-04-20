<?php

echo <<<_END
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv = "refresh" content = "1; url = teams.php" />
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

    
    if (!empty($_POST['wijzigteamnaam'])){
        $teamnaam                   = $_POST['teamnaam'];
        $wijzigteamnaam             = $_POST['wijzigteamnaam'];
        $wijzigteamlidoud           = $_POST['wijzigteamlidoud'];
        $wijzigteamlidnieuw         = $_POST['wijzigteamlidnieuw'];
        $wijzigteamnieuwlid         = $_POST['wijzigteamnieuwlid'];
        $wijzigteamverwijderlid     = $_POST['wijzigteamverwijderlid'];
        $wijzigteamabout            = $_POST['wijzigteamabout'];

        $updateteamnaam1            = "UPDATE teamlid SET teamnaam='$wijzigteamnaam' WHERE teamnaam='$teamnaam'";
        $updateteamnaamresult1      = $conn->query($updateteamnaam1);

        $updateteamnaam2             = "UPDATE teams SET teamnaam='$wijzigteamnaam' WHERE teamnaam='$teamnaam'";
        $updateteamnaamresult2       = $conn->query($updateteamnaam2);

        $updatelid                  = "UPDATE teamlid SET lidnummer='$wijzigteamlidnieuw' WHERE teamlid_id='$wijzigteamlidoud'";
        $updatelidresult            = $conn->query($updatelid);        
    
        $nieuwlid           = "INSERT INTO teamlid VALUES" . "(NULL, '$teamnaam', '$wijzigteamnieuwlid')";
        $nieuwlidresult     = $conn->query($nieuwlid);
        
        $updateteamabout            = "UPDATE teams SET omschrijving='$wijzigteamabout' WHERE teamnaam='$teamnaam'";
        $updateteamaboutresult      = $conn->query($updateteamabout);        

        $verwijderlid           = "DELETE FROM teamlid WHERE teamlid_id='$wijzigteamverwijderlid'";
        $verwijderlidresult     = $conn->query($verwijderlid);
                
    }

    if (!empty($_POST['teamnaam']) && ($_POST['lidone'] != $_POST['lidtwo']) && ($_POST['lidtwo'] != $_POST['lidthree']) && ($_POST['lidone'] != $_POST['lidthree'])){
        $teamnaam       = $_POST['teamnaam'];
        $teamlidone     = $_POST['lidone'];
        $teamlidtwo     = $_POST['lidtwo'];
        $teamlidthree   = $_POST['lidthree'];
        $about          = $_POST['about'];
        $website        = "teams.php";

        $mailcheckquery = "SELECT * FROM teams WHERE teamnaam='$teamnaam'";
        $mailcheckresult = $conn->query($mailcheckquery);

        $mailcheckrows = $mailcheckresult->num_rows;

        for($j = 0; $j < $mailcheckrows; ++$j){
            $mailcheckrow = $mailcheckresult->fetch_array(MYSQLI_NUM);

            if($mailcheckrow[0] == $teamnaam){
                die("teamnaam bestaat al");
            }                   

        }

        $teamaboutquery     = "INSERT INTO teams VALUES" . "('$teamnaam', '$about')";
        $teamaboutresult    = $conn->query($teamaboutquery);

        $teaminsertquery    = "INSERT INTO teamlid VALUES" . "(NULL, '$teamnaam', '$teamlidone'),(NULL, '$teamnaam', '$teamlidtwo'),(NULL, '$teamnaam', '$teamlidthree')";
        $teaminsertresult   = $conn->query($teaminsertquery);

        if (!teamaboutresult) {
            echo "team creation failed <br><br>";
        }

    }
    
    if (!empty($_POST['deleteTeam'])){
        $teamnaam   = $_POST['deleteTeam'];

        $deleteteamquery = "DELETE FROM teams WHERE teamnaam='$teamnaam'";
        $deleteteamresult = $conn->query($deleteteamquery);
        if (!$deleteteamresult) {
            echo "Team niet kunnen verwijderen uit teams database!";
        }

        $deleteteamlidquery = "DELETE FROM teamlid WHERE teamnaam='$teamnaam'";
        $deleteteamlidresult = $conn->query($deleteteamlidquery);
        if (!$deleteteamlidresult) {
            echo "Team niet kunnen verwijderen uit teamleden database!";
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