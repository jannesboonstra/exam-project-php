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
        <title>Ledenlijst</title>
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

    $displayStyle = "style='display:none'";
    

    if (isset($_POST['voegtoe'])){
        $displayStyle = "style='display:default'";
        $displayStyle2 = "id='blur'";
    }

    echo <<<_END

    <link rel='stylesheet' type='text/css' href='css/style.css' />

    <div class="leden" $displayStyle2>
    <h2>Leden&colon;</h2>

    _END;

        require_once 'login.php';
        if ($conn->connect_error) {
            die("Fatal connection");
        }

        $query = "SELECT * FROM lid";
        $result = $conn->query($query);
        if (!$result) {
            die('Fatal Database error');
        }

        $rows = $result->num_rows;

        echo "<pre> <table><tr> <th>Lidnummer</th> <th>Voornaam</th> <th>Achternaam</th> <th>Postcode</th> <th>Straat</th> <th>Huisnummer</th> <th>Woonplaats</th> <th>Telefoonnummer</th> <th>E&dash;mail</th> <th>Bewerken</th> <th>Verwijderen</th>";

        for ($j = 0; $j < $rows; ++$j) {
            echo "<tr>";

            $row = $result->fetch_array(MYSQLI_NUM);
            echo "<td>" . htmlspecialchars($row[0]) . "</td>";
            echo "<td>" . htmlspecialchars($row[2]) . "</td>";
            echo "<td>" . htmlspecialchars($row[1]) . "</td>";
            echo "<td>" . htmlspecialchars($row[3]) . "</td>";

            $queryPostcode = "Select * FROM postcode WHERE postcode='$row[3]'";
            $resultPostcode = $conn->query($queryPostcode);
            if (!$resultPostcode) {
                die("postcode error");
            }

            $rowPostcode = $resultPostcode->fetch_array(MYSQLI_NUM);
            echo "<td>" . htmlspecialchars($rowPostcode[1]) . "</td>";
            echo "<td>" . htmlspecialchars($row[4]) . "</td>";
            echo "<td>" . htmlspecialchars($rowPostcode[2]) . "</td>";

            $queryTel = "Select * FROM telefoonnummers WHERE lidnummer='$row[0]'";
            $resultTel = $conn->query($queryTel);
            if (!$resultTel) {
                die("mail error");
            }

            $rowsTel = $resultTel->num_rows;

            echo "<td>";
            for ($l = 0; $l < $rowsTel; ++$l){

                $rowTel = $resultTel->fetch_array(MYSQLI_ASSOC);
                echo htmlspecialchars($rowTel['telefoonnummer']) . "<br>";
             }
             echo "</td>";

            $queryMail = "Select * FROM email WHERE lidnummer='$row[0]'";
            $resultMail = $conn->query($queryMail);
            if (!$resultMail) {
                die("mail error");
            } 

            $rowsMail = $resultMail->num_rows;

            echo "<td>";
            for ($l = 0; $l < $rowsMail; ++$l){

                $rowMail = $resultMail->fetch_array(MYSQLI_ASSOC);
                echo htmlspecialchars($rowMail['email']) . "<br>";
             }
             echo "</td>";

            $lidnummer  = htmlspecialchars($row[0]);

            echo <<<_END

            <td>
            <form action="update.php" method="post" class="form">
            <input type='hidden' name='changeForm' value="$lidnummer">
            <input type='submit' value='&#9997;' class="edit">
            </form>
            </td>

            <td>
            <form action="verwijderen.php" method="post" class="form">
            <input type='hidden' name='deleteLid' value="$lidnummer">
            <input type='submit' value='X' class="delete">
            </form>
            </td>

            </tr>

            _END;

        }

            echo <<<_END

                    <tr>
                    <td colspan="11">
                    <form action="leden.php" method="post" class="form" >
                    <input type="submit" value="voeg een lid toe" name="voegtoe" class="formsubmit" id="voegen">
                    </form>
                    </td>
                    </tr>
                    </table></pre>
                    </div>

                    <div class="aanpassen" id="center">

                    <div class="toevoegen" id="toevoegen" $displayStyle>        
                    <h2>Toevoegen&colon;</h2>
                    <small>Voeg een lid toe</small>
                    <br><br>
                    <form action="toevoegen.php" method="post" class="form">
                    <label for="voornaam">Voornaam &#42;</label><input type="text" name="voornaam" pattern="[A-Za-z0-9._%+- ]" required>
                    <label for="achternaam">Achternaam &#42;</label><input type="text" name="achternaam" pattern="[A-Za-z0-9._%+- ]" required>
                    <label for="adres">straatnaam &#42;</label><input type="text" name="adres" pattern="[A-Za-z0-9._%+- ]" required>
                    <label for="huisnummer">huisnummer &#42;</label><input type="text" name="huisnummer" pattern="[A-Za-z0-9._%+- ]" required>
                    <label for="postcode">postcode &#42;</label><input type="text" name="postcode" pattern="[A-Za-z0-9._%+- ]{6,7}" required>
                    <label for="woonplaats">woonplaats &#42;</label><input type="text" name="woonplaats" pattern="[A-Za-z0-9._%+- ]" required>
                    <label for="email">e&dash;mail</label><input type="text" name="email" pattern="[A-Za-z0-9@._%+- ]">
                    <label for="telefoon">telefoon</label><input type="text" name="telefoon" pattern="[A-Za-z0-9._- ]">
                    <br>
                    <input type="submit" value="voeg toe" class="formsubmit">
                    </form>
                    <br>
                    <form action="leden.php" method="post" class="form" id="edit">
                    <input type='hidden' name='changeformback'>
                    <button onclick="leden.php" class="formsubmit">annuleren</button>
                    </form>
                    </div>

                    _END;

            $result->close();
            $conn->close();

            function get_post($conn, $var)
            {
                return $conn->real_escape_string($_POST[$var]);
            }

        }
        else {
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