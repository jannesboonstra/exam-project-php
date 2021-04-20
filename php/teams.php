<?php

session_start();

if(isset($_COOKIE['gebruiker']) && isset($_SESSION['forename'])) 
{
    
    $gebruiker = $_COOKIE['gebruiker'];

echo <<<_END

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Teamlijst</title>
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
    <main>
    
    _END;

    $displayhidden= "style='display:none'";
    

    if (isset($_POST['voegtoe'])){
        $displayhidden = "style='display:default'";
        $displayStyle2 = "id='blur'";
    }

    echo <<<_END

    <link rel='stylesheet' type='text/css' href='css/style.css' />


    <h2 $displayStyle2>Teams&colon;</h2>
    <div class="leden" id="teams">

    _END;

        require_once 'login.php';
        if ($conn->connect_error) {
            die("Fatal connection");
        }

        $teamquery = "SELECT * FROM teams";
        $teamresult = $conn->query($teamquery);
        if (!$teamresult) {
            die('Fatal Database error');
        }

        $teamrows = $teamresult->num_rows;

        for ($i = 0; $i < $teamrows; ++$i){
            
            $teamrow= $teamresult->fetch_array(MYSQLI_NUM);

            echo "<div class='teams'><table $displayStyle2>";
            echo "<tr><td><h3>" . htmlspecialchars($teamrow[0]) . "</h3></td></tr>";

            $teamledenquery = "SELECT * FROM teamlid WHERE teamnaam='$teamrow[0]'";
            $teamledenresult = $conn->query($teamledenquery);
            if (!$teamledenresult){
                die('geen leden gevonden');
            }
            
            $teamledenrows = $teamledenresult->num_rows;

            for ($j = 0; $j < $teamledenrows ; ++$j){
                $teamledenrow = $teamledenresult->fetch_array(MYSQLI_NUM);
                //echo "<tr><td>" . htmlspecialchars($teamledenrow[2]) . "</td></tr>";

                $teamlidquery = "SELECT * FROM lid WHERE lidnummer='$teamledenrow[2]'";
                $teamlidresult = $conn->query($teamlidquery);
                if (!$teamledenresult){
                    die('geen lidnaam gevonden');
                }

                $teamlidrow = $teamlidresult->fetch_array(MYSQLI_NUM);

                echo "<tr><td>" . htmlspecialchars($teamlidrow[2]) . " " . htmlspecialchars($teamlidrow[1]) . "</td></tr>";    
            
            }
            
            echo "<tr><td><br><small>" . htmlspecialchars($teamrow[1]) . "</small><br><br></td></tr>";
            echo <<<_END
            <tr><td>
            <form action="updateteam.php" method="post" class="form" id="wijzigteam">
            <input type="hidden" name="wijzigteam" value="$teamrow[0]" for="wijzigteam">
            <input type="hidden" name="wijzigteamabout" value="$teamrow[1]" for="wijzigteam">
            <input type="submit" value="bewerken" class="formsubmit" for="wijzigteam">
            </form>
            </td></tr>
            <br>
            <tr><td>
            <form action="wijzigteam.php" method="post" class="form" id="delteam">
            <input type="hidden" name="deleteTeam" value="$teamrow[0]" for="delteam">
            <input type="submit" value="verwijderen" class="formsubmit" for="delteam">
            </form>
            </td></tr>
            </table></div>
            _END;
            
            
        }



            echo <<<_END

                    
                    
                    </div>
                    <div>
                    <form action="teams.php" method="post" class="form" $displayStyle2>
                    <input type="submit" value="maak een nieuw team" name="voegtoe" class="formsubmit" id="voegen" $displayStyle2>
                    </form>
                    </div>
                    
                    <div class="aanpassen" id="centertwee">

                    <div class="toevoegen" id="toevoegen" $displayhidden>        
                    <h2>Toevoegen&colon;</h2>
                    <small>Maak een team</small>
                    <br><br>
                    <form action="wijzigteam.php" method="post" class="form" id='nieuwteam'>
                    Teamnaam &#42;<input type="text" name="teamnaam" pattern="[A-Za-z0-9._%+- ]" for='nieuwteam' required>
                    Selecteer lid 1&colon;<select name="lidone" size="1" for="nieuwteam">
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
                    Selecteer lid 2&colon;<select name="lidtwo" size="1" for="nieuwteam">
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
                    Selecteer lid 3&colon;<select name="lidthree" size="1" for="nieuwteam">
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
                    Omschrijving&colon;<textarea name='about' for='nieuwteam' rows='4' class='textarea'></textarea>
                    <br>
                    <input type="submit" value="voeg toe" class="formsubmit"  for='nieuwteam'>
                    </form>
                    <br>
                    <form action="teams.php" method="post" class="form" id='cancel'>
                    <input type='hidden' name='changeformback' for='cancel'>
                    <button onclick="teams.php" class="formsubmit" for='cancel'>annuleren</button>
                    </form>
                    </div>
                    </div>

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