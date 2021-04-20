<?php

require_once('php/login.php');

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
<nav>
    <ul>
    <li><a href='authenticate.php' class='link'>Log in</a></li>
    </ul>
</nav>
<main style='text-align: center;'>
<h2>Huidige indelingen Pubquiz&colon;</h2>
<p> 
Welkom bij de nieuwe pubquiz&#33;<br><br>
Volgende week is het zover en daarom maken we hieronder bekend welke teams zich aangemeld hebben&period;<br>
Sta je er niet bij en heb je je wel aangemeld, stuur dan gelijk een mail naar jouw contactpersoon van de organisatie&period;<br><br><br>
</p>

<h3>Aangemelde teams&colon;</h3>
<br>
<div class="leden" id="teams">
_END;

require_once 'php/login.php';
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
    echo "</table></div>";
    
    
}

echo "</div>";

?>
</body>
</html>