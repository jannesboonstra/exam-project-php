
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
        <title>Update lid</title>
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

    <h2>Bewerk lid</h2>

    _END;

    require_once 'login.php';
    if ($conn->connect_error) {
        die("Fatal connection");
    }

        if (!empty($_POST['changeForm'])) {
            $selectLid    = $_POST['changeForm'];

            $query = "SELECT * FROM lid WHERE lidnummer='$selectLid'";
            $result = $conn->query($query);
            if (!$result) {
                die('Fatal Database error');
            }
    
            $rows = $result->num_rows;

            for ($j = 0; $j < $rows; ++$j) {
    
                $row = $result->fetch_array(MYSQLI_NUM);

                $queryPostcode = "Select * FROM postcode WHERE postcode='$row[3]'";

                $resultPostcode = $conn->query($queryPostcode);
                if (!$resultPostcode) {
                    die("postcode error");
                }

                $rowPostcode = $resultPostcode->fetch_array(MYSQLI_ASSOC);


                $queryTel = "Select * FROM telefoonnummers WHERE lidnummer='$row[0]'";
                $resultTel = $conn->query($queryTel);
                if (!$resultTel) {
                    die("mail error");
                }

                $rowsTel = $resultTel->num_rows;

                for ($l = 0; $l < $rowsTel; ++$l){

                    $rowTel = $resultTel->fetch_array(MYSQLI_ASSOC);
                }

                $queryMail = "Select * FROM email WHERE lidnummer='$row[0]'";
                $resultMail = $conn->query($queryMail);
                if (!$resultMail) {
                    die("mail error");
                } 

                $rowsMail = $resultMail->num_rows;

                for ($l = 0; $l < $rowsMail; ++$l){

                    $rowMail = $resultMail->fetch_array(MYSQLI_ASSOC);
                }
            }


        }

        $valueId = $_POST['changeForm'];

            echo <<<_END
                <div class="aanpassen">
                <div class="extratwee">
                <h2>lid&colon;</h2>
                <div class="formdiv">
                <form action="wijzig.php" method="post" class="form" id='wijzigadresform'>
                lidnummer&colon; $valueId <br>
                _END;

                $huidigquery = "SELECT * FROM lid WHERE lidnummer='$valueId'";
                $huidigresult = $conn->query($huidigquery);
                if (!$huidigresult) {
                    die('Fatal Database error');
                }
        
                $huidigrows = $huidigresult->num_rows;
    
                for ($q = 0; $q < $huidigrows; ++$q) {
        
                    $huidigrow = $huidigresult->fetch_array(MYSQLI_NUM);
    
                    $huidigqueryPostcode = "Select * FROM postcode WHERE postcode='$huidigrow[3]'";
    
                    $huidigresultPostcode = $conn->query($huidigqueryPostcode);
                    if (!$huidigresultPostcode) {
                        die("postcode error");
                    }
    
                    $huidigrowPostcode = $huidigresultPostcode->fetch_array(MYSQLI_NUM);
                    echo  "naam&colon; " . htmlspecialchars($row[2]) . " " . htmlspecialchars($row[1]);
                    echo "<h3>Adresgegevens</h3>";
                    echo "straatnaam <input type='text' name='wijzigAdres' value='" . htmlspecialchars($huidigrowPostcode[1]) . "' pattern='[A-Za-z0-9._%+- ]' for='wijzigadresform' required>";
                    echo "huisnummer <input type='text' name='wijzigHuisnummer' value='"  . htmlspecialchars($huidigrow[4]) . "' pattern='[A-Za-z0-9._%+- ]' for='wijzigadresform' required>";
                    echo  "postcode <input type='text' name='wijzigPostcode' value='" . htmlspecialchars($row[3]) . "' pattern='[A-Za-z0-9._%+- ]{6,7}' for='wijzigadresform' required>";
                    echo "woonplaats <input type='text' name='wijzigWoonplaats' value='" . htmlspecialchars($huidigrowPostcode[2]) . "' pattern='[A-Za-z0-9._%+- ]' for='wijzigadresform' required>";
                    echo "<input type='hidden' name='wijzigLid' value='$valueId'>";
    
                }

                echo <<<_END

                <br>
                <input type="submit" value="wijzig" class="formsubmit" for='wijzigadresform'>
                </form>  
                </div>
                <br>
                <div class="formdiv">
                E&dash;mail
                
                _END;
                $selectlidfrom = $_POST['changeform'];

                $wijzigmailquery = "SELECT * FROM lid WHERE lidnummer='$valueId'";
                $wijzigmailresult = $conn->query($wijzigmailquery);
                if (!$wijzigmailresult) {
                die('Fatal Database error');
                }
    
                $wijzigmailrows = $wijzigmailresult->num_rows;

                for ($r = 0; $r < $wijzigmailrows; ++$r) {

                    $querywijzigMail = "SELECT * FROM email WHERE lidnummer='$valueId'";
                    $resultwijzigMail = $conn->query($querywijzigMail);
                    if (!$resultwijzigMail) {
                        die("mail error");
                    } 
    
                    $rowswijzigMail = $resultwijzigMail->num_rows;
    
                    for ($s = 0; $s < $rowswijzigMail; ++$s){
    
                        $rowwijzigMail = $resultwijzigMail->fetch_array(MYSQLI_ASSOC);
                        $selectrowwijzigmail = htmlspecialchars($rowwijzigMail['email']);
                        echo "<form action='wijzig.php' method='post' class='form' id='$selectrowwijzigmail'>";
                        echo "<input type='hidden' name=oldMail value='" . $selectrowwijzigmail . "' for='$selectrowwijzigmail'>";
                        echo "<input type='text' name='changedMail' value='" . $selectrowwijzigmail . "' for='$selectrowwijzigmail' pattern='[A-Za-z0-9._@%+- ]' required>";
                        echo "<br>";
                        echo "<input type='hidden' value='$selectlidfrom' name='lidnummer' for='$selectrowwijzigmail'>";
                        echo "<input type='submit' value='wijzig' class='formsubmit' for='$selectrowwijzigmail'>";
                        echo "<br>";
                        echo "</form>"; 
                    }

                }

                echo <<<_END
                </div>
                <div class="formdiv">
                Telefoonnummer
                _END;

                $wijzigtelquery = "SELECT * FROM lid WHERE lidnummer='$valueId'";
                $wijzigtelresult = $conn->query($wijzigtelquery);
                if (!$wijzigtelresult) {
                die('Fatal Database error');
                }
    
                $wijzigtelrows = $wijzigtelresult->num_rows;

                for ($t = 0; $t < $wijzigtelrows; ++$t) {

                    $querywijzigTel = "SELECT * FROM telefoonnummers WHERE lidnummer='$valueId'";
                    $resultwijzigTel = $conn->query($querywijzigTel);
                    if (!$resultwijzigTel) {
                        die("telefoonnummer error");
                    } 
    
                    $rowswijzigTel = $resultwijzigTel->num_rows;
    
                    for ($u = 0; $u < $rowswijzigTel; ++$u){
    
                        $rowwijzigtel = $resultwijzigTel->fetch_array(MYSQLI_ASSOC);
                        $selectrowwijzigTel = htmlspecialchars($rowwijzigtel['telefoonnummer']);
                        echo "<form action='wijzig.php' method='post' class='form' id='$selectrowwijzigTel'>";
                        echo "<input type='hidden' name='oldTel' value='" . $selectrowwijzigTel . "' for='$selectrowwijzigTel'>";
                        echo "<input type='text' name='changedTel' value='" . $selectrowwijzigTel . "' for='$selectrowwijzigTel' pattern='[A-Za-z0-9._@%+- ]' required>";
                        echo "<br>";
                        echo "<input type='hidden' value='$selectlidfrom' name='lidnummer' for='$selectrowwijzigTel'>";
                        echo "<input type='submit' value='wijzig' class='formsubmit' for='$selectrowwijzigTel'>";
                        echo "<br>";
                        echo "</form>";
                    }

                }

                echo <<<_END
                </div>
                <div class="formdiv">
                <form action="toevoegen.php" method="post" class="form" id="toevoegen">
                <input type="hidden" name="extraLid" value="$valueId">
                extra E&dash;mail <input type="text" name="extraMail" pattern="[A-Za-z0-9@._%+- ]" for="toevoegen">
                extra Telefoon <input type="text" name="extraTel" pattern="[A-Za-z0-9._- ]" for="toevoegen">
                <br>
                <input type="submit" value="voeg toe" class='formsubmit' for="toevoegen">                
                </form>
                </div>
                <div class="formdiv">
                <form action="verwijderen.php" method="post" class="form" id="selectform">
                verwijder E&dash;mail<select name="delMail" size="1" for="selectform">
                <option></option>
                _END;

                $delmailquery = "SELECT * FROM lid WHERE lidnummer='$valueId'";
                $delmailresult = $conn->query($delmailquery);
                if (!$delmailresult) {
                die('Fatal Database error');
                }
    
                $delmailrows = $delmailresult->num_rows;

                for ($m = 0; $m < $delmailrows; ++$m) {

                    $querydelMail = "SELECT * FROM email WHERE lidnummer='$valueId'";
                    $resultdelMail = $conn->query($querydelMail);
                    if (!$resultdelMail) {
                        die("mail error");
                    } 
    
                    $rowsdelMail = $resultdelMail->num_rows;
    
                    for ($n = 0; $n < $rowsdelMail; ++$n){
    
                        $rowdelMail = $resultdelMail->fetch_array(MYSQLI_ASSOC);
                        $selectrowdelmail = htmlspecialchars($rowdelMail['email']);
                        echo "<option value='" . $selectrowdelmail . "'for='selectform'>" . $selectrowdelmail . "</option>";
                    }

                }

                echo <<<_END
                </select>
                verwijder Telefoonnummer<select name="delTel" size="1" for="selectform">
                <option></option>
                _END;

                $deltelquery = "SELECT * FROM lid WHERE lidnummer='$valueId'";
                $deltelresult = $conn->query($deltelquery);
                if (!$deltelresult) {
                die('Fatal Database error');
                }
    
                $deltelrows = $deltelresult->num_rows;

                for ($o = 0; $o < $deltelrows; ++$o) {

                    $querydelTel = "SELECT * FROM telefoonnummers WHERE lidnummer='$valueId'";
                    $resultdelTel = $conn->query($querydelTel);
                    if (!$resultdelTel) {
                        die("telefoonnummer error");
                    } 
    
                    $rowsdelTel = $resultdelTel->num_rows;
    
                    for ($p = 0; $p < $rowsdelTel; ++$p){
    
                        $rowdeltel = $resultdelTel->fetch_array(MYSQLI_ASSOC);
                        $selectrowdelTel = htmlspecialchars($rowdeltel['telefoonnummer']);
                        echo "<option value='" . $selectrowdelTel . "'for='selectform'>" . $selectrowdelTel . "</option>";
                    }

                }

                echo <<<_END
                </select>
                <br>
                <input type="submit" value="verwijderen" class="formsubmit" for="selectform">
                </form>  
                </div>
                <div>
                <br><br>
                <form action="leden.php" method="post" class="form" id="edit">
                <input type='hidden' name='changeformback'>
                <button onclick="leden.php" class="formsubmit"> <h2>annuleren<h2> </button>
                </form>
                </div>
    
                </div>
                
            </div>
            </div>
            
            <br><br>



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