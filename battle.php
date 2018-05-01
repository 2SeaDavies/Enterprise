<?php
include('dbconnect.php');
require_once("session.php");
//getting the player and territory that will be attacked
$terr = $_GET["terr"];
$attack = $_GET["attack"];
$nom = $_SESSION['name'];
//calculating the strength and damage of the attacking units
$sql = "SELECT * FROM Unit,Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Num >0 and Player_Units.Name = '$nom'";
$result = $conn->query($sql);
$strength =0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //the damage formula!
        $name = $row["Name"];
        $unitattack = $row["Attack"];
        $unitattack *= $row["Num"];
        $acc = $row["Acc"];
        $acc = rand($acc,100);
        $unitattack*=$acc;
        $unitattack/=30;
        $strength += $unitattack;

    }
} else {

}
//strength is divided and rounded
$strength /=3;
$strength = round($strength);


//calculating the strength and damage of the team being attacked
$sql = "SELECT * FROM Unit,Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Num >0 and Player_Units.Name = '$attack'";
$result = $conn->query($sql);
$strength2 =0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row["Name"];
        $unitattack = $row["Attack"];
        $unitattack *= $row["Num"];
        $acc = $row["Acc"];
        $acc = rand($acc,100);
        $unitattack*=$acc;
        $unitattack /=30;
        $strength2 += $unitattack;

    }
} else {

}
//dividing and rounding the strength for the player being attacked
$strength2 /=3;
$strength2 = round($strength2);
//setting the damage placeholders
$damage2 = $strength2;
$damage = $strength;
$count = 0;


//making sure battles happen 6 times
while ($count < 6) {
    $count += 1;
    //calculating the unit that gets hit first
    $sql = "Select * from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$nom' and Ran in (Select min(Ran) from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Num > 0 and Player_Units.Name = '$nom')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //getting the stats of that unit and initialising the death process...
            $healthy = 0;
            $dead = 0;
            $HP = $row["HP"];
            $healthy += $row["HP"];
            $num = $row["Num"];
            $cost = $row["Cost"];
            $corpse = $row["UName"];

            $ID = $row["Unit_ID"];
            $healthy *= $row["Num"];


                //what happens if all of a type of units die!
            if ($damage2 > $healthy) {

                $sql = "UPDATE Player_Units SET Num = 0 where Unit_ID = $ID and Player_Units.Name = '$nom'";

                if ($conn->query($sql) === TRUE) {
                    $damage2 -= $healthy;
                    //letting people know if all of a type of unit died
                    $message = "You lost all your $corpse"."s";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }


            } else {
                    //what happens if not every unit dies
                $dead = $damage2 / $HP;
                $dead = floor($dead);
                //bounty!
                $bounty = $cost * $dead;
                $bounty /= 2;
                $bounty = floor($bounty);
                //letting people know if units died
                if ($dead >0) {
                    $message = "You lost $dead $corpse" . "s";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }

//making sure the damage gets reduced
                $damage2 -= $dead * $HP;

                $moarsql = "UPDATE Player_Units SET Num = (Num - $dead) where Name = '$nom' and Unit_ID = $ID";

                if ($conn->query($moarsql) === TRUE) {


                } else {
                    echo "Error updating record: " . $conn->error;
                }
                //look a bounty!
                $bountysql = "UPDATE Player SET Money = (Money + $bounty) where Name = '$attack'";
                if ($conn->query($bountysql) === TRUE) {


                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
    } else {

    }
    //doing it all again for the player being attacked
    $healthy = 0;
    $dead = 0;
    //getting the unit with the lowest range
    $sql = "Select * from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$attack' and Ran in (Select min(Ran) from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Num > 0 and Player_Units.Name = '$attack')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //getting the units details
            $healthy += $row["HP"];
            $HP = $row["HP"];

            $ID = $row["Unit_ID"];

            $healthy *= $row["Num"];
            $cost = $row["Cost"];

            //checking what happens if all of that unit will die
            if ($damage > $healthy) {

                $sql = "UPDATE Player_Units SET Num = 0 where Unit_ID = $ID and Player_Units.Name = '$attack'";

                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                $damage -= $healthy;

            } else {
//otherwise assigning damage to some of the units
                $dead = 0;
                if ($damage > 0) {
                    $dead = $damage / $HP;
                }
                $dead = floor($dead);
//more bounty!
                $bounty2 = $cost * $dead;
                $bounty2 /= 2;
                $bounty2 = floor($bounty2);
                $totalbounty += $bounty2;

                $damage -= $dead * $HP;
//updating the unit count
                $moarsql = "UPDATE Player_Units SET Num = (Num - $dead) where Name = '$attack' and Unit_ID = $ID";

                if ($conn->query($moarsql) === TRUE) {


                } else {
                    echo "Error updating record: " . $conn->error;
                }
//assigning the bounty
                $bountysql = "UPDATE Player SET Money = (Money + $bounty2) where Name = '$nom'";
                if ($conn->query($bountysql) === TRUE) {


                } else {
                    echo "Error updating record: " . $conn->error;
                }

            }

        }
    } else {

    }
}
//checking for a winner

if ($strength > $strength2) {
    $msg = "you have won the battle and the territory";
    $winner = $nom;
}
else {
    $msg = "you were defeated";
    $winner = $attack;
}
//alerting the bounty and the winner
echo "<script type='text/javascript'>alert('$msg');</script>";

If ($totalbounty> 0)
{$winrar = "You made $totalbounty for killing enemy units";
    echo "<script type='text/javascript'>alert('$winrar');</script>";
}

//giving the winner the territory

$sql = "UPDATE Player_Territory SET Name = '$winner' Where Terr_ID = '$terr'";

if ($conn->query($sql) === TRUE) {


} else {
    echo "Error updating record: " . $conn->error;
}

?>


<?php require_once("session.php"); ?>
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

</head>

<body>
<?php
//getting the session details for the home page
$name = $_SESSION['name'];
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


            <?php echo "<p>Welcome ".$_SESSION['name']."  your daily income is $total</p>";
            $name = $_SESSION['name'];
//getting the available cash
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

            $sql = "SELECT Unit.*, Player_Units.Num FROM Unit, Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$name'";
            $result = $conn->query($sql);

//displaying the unit details for the logged in player
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

