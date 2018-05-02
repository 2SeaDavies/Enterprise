
<?php
//getting the session
require_once("session.php"); ?>
<!DOCTYPE html>
<html>
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

        <title>Home</title>

	<body>
    <?php
    //getting the logged in player's name
    $name = $_SESSION['name'];
    //getting the player's income
    $sql = "select SUM(Value) as total from Territory,Player_Territory,Player where Player.Name = Player_Territory.Name and Player_Territory.Terr_ID = Territory.Terr_ID and Player.name = '$name'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $total = $row["total"];
        $total += 250;

    }
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
                        <li><a href="/index.php">Buy Units</a></li>
                        <li><a href="/territories.php">View Territories</a></li>
                        <li><a href="/playas.php">Players</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="logout.php" method="POST" style="display: none;"><input type="hidden"></form></li>


                    </ul>





                        </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>        </div>


    <div class="container">

        <div class='panel panel-primary'><div class='panel-heading'><h2 class='panel-title'>Home</h2></div><div class='panel-body'>


                    <?php
                    //displaying the welcome message with the player's name and income
                    echo "<p>Welcome ".$_SESSION['name']."  your daily income is $total</p>";

                        //getting the player's available cash
                        $sql = "SELECT Money from Player where Name = '$name'";

                            $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                           $Money = $row["Money"];
                        }

                    echo "<table class=\"table table-striped task-table\">
<tr>
<th></th>
<th>Name</th>
<th> Power!</th>
<th>In Your Army</th>
<th>Cost</th>
<th> Available Cash: $Money</th>

</tr>";
                    //getting the player's units
                    $sql = "SELECT Unit.*, Player_Units.Num FROM Unit, Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$name'";
                    $result = $conn->query($sql);


                        while ($row = $result->fetch_assoc()) {
                            $name = $row['UName'];

                            $Attack = $row['Attack'] ;
                            $HP = $row['HP'];
                            $Acc = $row['Acc'];
                            $Power =($Attack + $HP + $Acc)/3;
                            $Power = round($Power);
                            echo "<tr>";
                            echo "<td> <img src=".$row['UName'].".jpg width ='50px' </td>";
                            echo "<td>" . $row['UName'] . "</td>";
                            echo "<td>" . $Power . "</td>";
                            echo "<td>" . $row['Num'] . "</td>";
                            echo "<td>" . $row['Cost'] . "</td>";
                            echo "<td> <a class='btn btn-md btn-primary' href='$name.php'>Get Moar!</a> </td>";

                            echo "</tr>";

                    }

                    echo "</table>";

                    ?>




















                    </div>



                </form>

            </div></div>
    </div>

	</body>
</html>
