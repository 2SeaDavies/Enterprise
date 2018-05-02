
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commander!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">

    <!-- Personal CSS -->
    <link href="css/personal.css" rel="stylesheet">


    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
<?php
// get db and session

include('dbconnect.php');
require_once("session.php");
// I think this one is redundant, but I'm not going to delete it now
$attack = $_GET["attack"];
// get the player name
$nom = $_SESSION['name'];






?>

<!-- Display -->

<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Commander!</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="/index.php">Buy Units</a></li>
                    <li><a href="/territories.php">Territories</a></li>
                    <li><a href="/playas.php">Players</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="logout.php" method="POST" style="display: none;"><input type="hidden"></form></li>


                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div> <!-- Container -->


<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'> Territories you can attack</h3></div><div class='panel-body'>

            <form method="Get" action="Soldier.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="1">


                <div class='col-sm-6'>

                    <?php
                    //definitely redundant, still too scared to delete
                    include('dbconnect.php');

                    // get the details of the territories that aren't the player's
                    $getTerr = "SELECT * FROM Territory, Player_Territory,Player where Player_Territory.Terr_ID = Territory.Terr_ID and Player_Territory.Name = Player.Name and Player.Name !='$nom' Order by Territory.Value desc";

                    $result = $conn->query($getTerr);



                    // display those territories
                    echo "<table class=\"table table-striped task-table\">
<tr>
<th>Owner</th>
<th>Value</th>

</tr>";


                    $cost = 0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Value'] . "</td>";
                       echo "<td> <a class='btn btn-md btn-primary' href='battle.php?attack=".$row['Name']."&terr=".$row['Terr_ID']."'>Attack this territory</a> </td>";


                        echo "</tr>";
                    }


                    echo "</table>";

                    ?>

                    <?php

                    ?>



                    <br>
                    <div class="form-group">

                    </div>
                </div>







                <div class='col-sm-6'>

                </div>



            </form>

        </div></div>
</div> <!-- Container -->

</body>
</html>