
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

include('dbconnect.php');

$attack = $_GET["attack"];






?>



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
                    <li><a href="/Soldier.php">Buy Units</a></li>
                    <li><a href="/territories.php">Territories</a></li>
                    <li><a href="/playas.php">Players</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/forum">Forums</a></li>

                    <!--<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="/forum">Forums</a></li>
            <li><a href="/chat">Chat</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
      </li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo $name ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/players/418">Profile</a></li>
                            <li><a href="/profile">Edit Profile</a></li>
                            <li><a href="/password">Change Password</a></li>
                            <li>
                                <a href="logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="logout.php" method="POST" style="display: none;"><input type="hidden"></form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div> <!-- Container -->


<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Recruit Soldiers</h3></div><div class='panel-body'>

            <form method="Get" action="Soldier.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="1">


                <div class='col-sm-6'>

                    <?php
                    include('dbconnect.php');


                    $getunits = "SELECT * FROM Territory, Player_Territory,Player where Player_Territory.Terr_ID = Territory.Terr_ID and Player_Territory.Name = Player.Name";

                    $result = $conn->query($getunits);




                    echo "<table class=\"table table-striped task-table\">
<tr>
<th>Owner</th>
<th>Value</th>
<th>Territory Number</th>

</tr>";


                    $cost = 0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Value'] . "</td>";
                        echo "<td>" . $row['Terr_ID'] . "</td>";
                       echo "<td> <a class='btn btn-md btn-primary' href='battle.php?attack=".$row['Name']."'>Attack this territory</a> </td>";


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