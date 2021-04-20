
<?php
session_start();

if(isset($_COOKIE['gebruiker'])) 
{
    
    $gebruiker = $_COOKIE['gebruiker'];

echo <<<_END

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Update Team</title>
    </head>
    <body>
    <div id="uitloggen">
    <small id='cookie'> $gebruiker</small>
    <form action="../logout.php" method="post" class="form" id='uitloggen'>
    <button onclick="index.php" class="formsubmit" for='uitloggen' id="uitlogknop">Uitloggen</button>
    </form>
    </div>
    <nav>
        <ul>
            <li><a href="leden.php" class='link'>Leden</a></li>
            <li><a href="teams.php" class='link'>Teams</a></li>
        </ul>
    </nav>
    <main class="main">

    <link rel='stylesheet' type='text/css' href='css/style.css' />

    <h2>Wijzig team</h2>

    _END;

require_once 'login.php';

if ($conn->connect_error) {
    die("Fatal connection");
}
    if(!empty($_POST['wijzigteam'])){
    $wijzigteamnaam = $_POST['wijzigteam']; 
    $wijzigteamabout = $_POST['wijzigteamabout'];
    }

    echo <<<_END
                    <form action="wijzigteam.php" method="post" class="form" id='wijzigteamnaam'>
                    Teamnaam &#42;<input type="text" name="wijzigteamnaam" value='$wijzigteamnaam' pattern="[A-Za-z0-9._%+- ]" for='wijzigteamnaam' required>
                    <br><br>
                    Vervang lid&colon;<select name="wijzigteamlidoud" size="1" for="wijzigteamnaam">
                    <option></option>
                    _END;

                    $teamlidquery = "SELECT * FROM teamlid WHERE teamnaam='$wijzigteamnaam'";
                    $teamlidresult = $conn->query($teamlidquery);
                    if(!$teamlidresult) {
                        die('geen teamlidnummer gevonden');
                    }

                    $teamlidrows = $teamlidresult->num_rows;   

                    for ($j = 0 ; $j < $teamlidrows ; ++$j){

                        $teamlidrow = $teamlidresult->fetch_array(MYSQLI_NUM);

                        $teamlidnaamquery = "SELECT * FROM lid WHERE lidnummer='$teamlidrow[2]'";
                        $teamlidnaamresult = $conn->query($teamlidnaamquery);
                        if(!$teamlidnaamresult){
                            die('geen teamleden gevonden');
                        }

                        $teamlidnaamrows = $teamlidnaamresult->num_rows;

                        for ($k = 0 ; $k < $teamlidnaamrows ; ++$k){
                            $teamlidnaamrow = $teamlidnaamresult->fetch_array(MYSQLI_NUM);
                            echo "<option value='$teamlidrow[0]'>uit&colon; $teamlidnaamrow[2] $teamlidnaamrow[1]</option>";
                        } 
                    }
                    echo <<<_END
                    </select>
                    <br>
                    <select name="wijzigteamlidnieuw" size="1" for="wijzigteamnaam">
                    <option></option>
                    _END;
    
                    $lidqueryone = "SELECT * FROM lid";
                    $lidresultone = $conn->query($lidqueryone);
                    if (!$lidresultone) {
                    die('Fatal Database error');
                    }
        
                    $lidonerows = $lidresultone->num_rows;
    
                    for ($m = 0; $m < $lidonerows; ++$m) {
           
                            $lidonerow = $lidresultone->fetch_array(MYSQLI_NUM);
                            echo "<option value='" . $lidonerow[0] . "'for='selectform'>in&colon; " . $lidonerow[2] . " " . $lidonerow[1] . "</option>";
                        }
    
                    
    
                    echo <<<_END

                    echo <<<_END
                    </select>
                    <br><br>
                    Voeg lid toe&colon;<select name="wijzigteamnieuwlid" size="1" for="wijzigteamnaam">
                    <option></option>
                    _END;
    
                    $lidqueryone = "SELECT * FROM lid";
                    $lidresultone = $conn->query($lidqueryone);
                    if (!$lidresultone) {
                    die('Fatal Database error');
                    }
        
                    $lidonerows = $lidresultone->num_rows;
    
                    for ($m = 0; $m < $lidonerows; ++$m) {
           
                            $lidonerow = $lidresultone->fetch_array(MYSQLI_NUM);
                            echo "<option value='" . $lidonerow[0] . "'for='selectform'>" . $lidonerow[0] . "&colon; " . $lidonerow[2] . " " . $lidonerow[1] . "</option>";
                        }
    
                    
    
                    echo <<<_END
                    </select>
                    <br><br>
                    Verwijder lid&colon;<select name="wijzigteamverwijderlid" size="1" for="wijzigteamnaam">
                    <option></option>
                    _END;
    
                    $verwijderlidquery = "SELECT * FROM teamlid WHERE teamnaam='$wijzigteamnaam'";
                    $verwijderlidresult = $conn->query($verwijderlidquery);
                    if(!$verwijderlidresult) {
                        die('geen teamlidnummer gevonden');
                    }

                    $verwijderlidrows = $verwijderlidresult->num_rows;   

                    for ($l = 0 ; $l < $verwijderlidrows ; ++$l){

                        $verwijderlidrow = $verwijderlidresult->fetch_array(MYSQLI_NUM);

                        $verwijderlidnaamquery = "SELECT * FROM lid WHERE lidnummer='$verwijderlidrow[2]'";
                        $verwijderlidnaamresult = $conn->query($verwijderlidnaamquery);
                        if(!$verwijderlidnaamresult){
                            die('geen teamleden gevonden');
                        }

                        $verwijderlidnaamrows = $verwijderlidnaamresult->num_rows;

                        for ($k = 0 ; $k < $verwijderlidnaamrows ; ++$k){
                            $verwijderlidnaamrow = $verwijderlidnaamresult->fetch_array(MYSQLI_NUM);
                            echo "<option value='$verwijderlidrow[0]'>$verwijderlidnaamrow[2] $verwijderlidnaamrow[1]</option>";
                        } 
                    }
                    
    
                    echo <<<_END
                    </select>
                    <br><br>
                    Omschrijving&colon;<textarea name='wijzigteamabout' for='nieuwteam' rows='4' class='textarea'>$wijzigteamabout</textarea>
                    <br>
                    <input type="hidden" value="$wijzigteamnaam" name="teamnaam" for='nieuwteam'>
                    <input type="submit" value="bewerk" class="formsubmit" for='nieuwteam'>
                    </form>
                    <br>
                    <form action="teams.php" method="post" class="form" id='cancel'>
                    <input type='hidden' name='changeformback' for='cancel'>
                    <button onclick="teams.php" class="formsubmit" for='cancel'>annuleren</button>
                    </form>

                    _END;
                
                
    $result->close();
    $conn->close();

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }

} else {
    echo <<<_END
    <!DOCTYPE html>
    <html lang='nl'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv = "refresh" content = "1; url = ../index.php" />
        <link rel='stylesheet' href='php/css/style.css'>
        <title>Welkom</title>
    </head>
    <body>
    <main id='authen'>            
    <div style='text-align:center'>
    <br><br>
    <h2>U bent niet ingelogd</h2>
    </div>

    _END;
}    

    ?>

    <main>

</body>
</html>