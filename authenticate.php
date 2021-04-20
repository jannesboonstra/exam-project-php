<?php // authenticate.php

session_start();
session_destroy();

  require_once('php/login.php');

  if ($conn->connect_error) die("Fatal Error");

  if (isset($_SERVER['PHP_AUTH_USER']) &&
      isset($_SERVER['PHP_AUTH_PW']) && empty($_SESSION['forename']))
  {
    $un_temp = $conn->real_escape_string(stripslashes(htmlentities($_SERVER['PHP_AUTH_USER'])));
    $pw_temp = $conn->real_escape_string(stripslashes(htmlentities($_SERVER['PHP_AUTH_PW'])));
    
    $query   = "SELECT * FROM users WHERE username='$un_temp'";
    $result  = $conn->query($query);

    if (!$result) die("User not found");
    elseif ($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $result->close();

        if (password_verify($pw_temp, $row[3]))
        {   
          session_start();
          $_SESSION['forename'] = $row[0];
          $_SESSION['forename'] = $row[1];

          setcookie("gebruiker", $row[2] . " has logged in @ " . date('l jS \of F Y H:i:s'), time() + 60 * 60, "/");

            echo <<<_END
            <!DOCTYPE html>
            <html lang="nl">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="php/css/style.css">
                <title>Welkom</title>
            </head>
            <body>
            <div id="uitloggen">
            <form action="logout.php" method="post" class="form" id='uitloggen'>
            <button onclick="index.php" class="formsubmit" for='uitloggen' id="uitlogknop">Uitloggen</button>
            </form>
            </div>
            <main id='authen'>            
            <div>
            <br><br>
            <h2>Welkom $row[0] $row[1]</h2>
            <p>
            U bent ingelogd als '$row[2]'<br><br>
            Selecteer om verder te gaan&colon;
            </p>
            </div><br>
            <nav>
                <ul>
                    <li><a href="php/leden.php" class='link'>Leden</a></li>
                    <li><a href="php/teams.php" class='link'>Teams</a></li>
                </ul>
            </nav>
            
            
            
            _END;
          }
          else {
            header('WWW-Authenticate: Basic realm="Restricted Area"');
            header('HTTP/1.0 401 Unauthorized');
          die("
          <!DOCTYPE html>
            <html lang='nl'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv = 'refresh' content = '1; url = index.php' />
                <link rel='stylesheet' href='php/css/style.css'>
                <title>Welkom</title>
            </head>
            <body>
            <main id='authen'>            
            <div style='text-align:center'>
            <br><br>
            <h2>Gebruikersnaam en/of paswoord komen niet overeen</h2>
            </div>
          ");
          }
        }
        else 
        {
          header('WWW-Authenticate: Basic realm="Restricted Area"');
          header('HTTP/1.0 401 Unauthorized');
        die("
        <!DOCTYPE html>
            <html lang='nl'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv = 'refresh' content = '1; url = index.php' />
                <link rel='stylesheet' href='php/css/style.css'>
                <title>Welkom</title>
            </head>
            <body>
            <main id='authen'>            
            <div style='text-align:center'>
            <br><br>
            <h2>Gebruikersnaam en/of paswoord komen niet overeen</h2>
            </div>
        ");
      }
  }
  else
  {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die ("
    <!DOCTYPE html>
            <html lang='nl'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv = 'refresh' content = '1; url = index.php' />
                <link rel='stylesheet' href='php/css/style.css'>
                <title>Welkom</title>
            </head>
            <body>
            <main id='authen'>            
            <div style='text-align:center'>
            <br><br>
            <h2>Vul uw gebruikersnaam en wachtwoord in</h2>
            </div>
    ");
  }

  $conn->close();
  
?>
</main>
</body>
</html>

