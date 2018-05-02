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
//get the session details
require_once("session.php");
//this page is not on github for obvious reasons, but you know what a dbconnect page looks like.
include('dbconnect.php');
//get how many units are being bought and the player name
$order = $_GET["Buy"];
$name = $_SESSION["name"];
//get the player details
$sql = "SELECT * FROM Player WHERE Name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //getting the player's available cash
        $available = $row["Money"];
    }
} else {
    echo "0 results";
}
//get the details of the player's army
$sql = "SELECT * FROM Player_Units WHERE Name = '$name' AND Unit_ID =2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $num = $row["Num"];
    }
} else {
    echo "0 results";
}

//get the details of the units in the player's army
$getunits = "SELECT * FROM Unit WHERE Unit_ID = 2";

$result = $conn->query($getunits);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cost = $row['Cost'];


    }

} else {
    echo "0 results";
}
//working out the maximum number that can be bought
$max = $available / $cost;
$max = floor($max);
//working out the new purchased number
$num += $order;
//working out the cost of the order
$cost *= $order;

$max -= $order;

//setting the player's cash
if ($available >= $cost) {
    $available -= $cost;
    $sql = "UPDATE Player SET Money='$available' WHERE Name='$name'";



    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating record: " . $conn->error;
    }
    //getting the player's new units
    $sql = "UPDATE Player_Units SET Num='$num' WHERE Name='$name' and Unit_ID =2 ";


    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating record: " . $conn->error;
    }
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

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Recruit Heavy Tanks</h3></div><div class='panel-body'>

            <form method="Get" action="Heavy.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="1">
                <!-- Displaying the available cash -->
                <div class='col-sm-6'>
                    <h2>Cash Available: <?php echo $available ?></h2>

                    <img src="Heavy.jpg">

                    <br>
                    <div class="form-group">
                        <input class="form-control" type="submit"  value="Hire one">

                    </div>
            </form>
            <form method="Get" action="Heavy.php" accept-charset="UTF-8">
                <!-- Prepping the maximum button and displaying the max a player can buy-->
                <input name="Buy" type="hidden" value="<?php echo $max ?>">
                <div class="form-group">
                    <input class="form-control" type="submit"  value="Hire the maximum <?php echo $max ?> ">

                </div>
            </form>




        </div>

                <div class='col-sm-6'>
                    <h4>Stats</h4>



                    <?php
                    include('dbconnect.php');

                    // getting the heavy tank details
                    $getunits = "SELECT * FROM Unit WHERE Unit_ID = 2";

                    $result = $conn->query($getunits);




                    echo "<table class=\"table table-striped task-table\">
<tr>
<th>Name</th>
<th>HP</th>
<th>Attack</th>
<th>Accuracy</th>
<th>Range</th>
<th>Cost</th>

</tr>";

                    //displaying the heavy tank details
                    $cost = 0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['UName'] . "</td>";
                        echo "<td>" . $row['HP'] . "</td>";
                        echo "<td>" . $row['Attack'] . "</td>";
                        echo "<td>" . $row['Acc'] . "</td>";
                        echo "<td>" . $row['Ran'] . "</td>";
                        echo "<td>" . $row['Cost'] . "</td>";

                        echo "</tr>";
                    }


                    echo "</table>";

                    ?>
                    <!-- Flavour Text -->

                    <h4>Equipment</h4>
                    <ul>
                        <li>Primary Weapon: <strong>12.8 cm Pak 44 L/55</strong></li>
                        <li>Secondary Weapon: <strong>7.92 mm MG 34 machine gun</strong></li>
                        <li>Armour: <strong>150mm Rear <br> 220m Front</strong></li>

                    </ul>


                    <p>In the real world this tank was never completed, but as you can see it's here and it's big enough to hold a strip club...</p>
                </div>



            </form>

        </div></div>
</div>

</body>
</html>