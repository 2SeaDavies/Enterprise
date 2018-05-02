
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
// get session details
require_once("session.php");
//db connect does not exist here because it contains passwords :O :O
include('dbconnect.php');
// get the number of units being bought if any
$order = $_GET["Buy"];

// get the player name
$name = $_SESSION["name"];
// get the player details
$sql = "SELECT * FROM Player WHERE Name = '$name'";
$result = $conn->query($sql);
// get the player's money
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $available = $row["Money"];
    }
} else {
    echo "0 results";
}
// get the number of light tanks in the player's army
$sql = "SELECT * FROM Player_Units WHERE Name = '$name' AND Unit_ID =5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $num = $row["Num"];
    }
} else {
    echo "0 results";
}

// get the details of the light tank
$getunits = "SELECT * FROM Unit WHERE Unit_ID = 5";

$result = $conn->query($getunits);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cost = $row['Cost'];


    }

} else {
    echo "0 results";
}

// get the maximum number that the player can buy
$max = $available / $cost;
$max = floor($max);
// get how many light tanks they'll have now
$num += $order;
// get the cost of those light tanks
$cost *= $order;
// update max so it doesn't go wrong
$max -= $order;
// update the player cash
if ($available >= $cost) {
    $available -= $cost;
    $sql = "UPDATE Player SET Money='$available' WHERE Name='$name'";



    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating record: " . $conn->error;
    }
    // give the player their new tanks

    $sql = "UPDATE Player_Units SET Num='$num' WHERE Name='$name' and Unit_ID =5 ";


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

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Recruit Light Tanks</h3></div><div class='panel-body'>

            <form method="Get" action="Light.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="1">


                <div class='col-sm-6'>
                    <h2>Cash Available: <?php echo $available ?></h2>

                    <img src="Light.jpg">

                    <br>
                    <div class="form-group">
                        <input class="form-control" type="submit"  value="Hire one">

                    </div>
            </form>
            <form method="Get" action="Light.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="<?php echo $max ?>">
                <div class="form-group">
                    <input class="form-control" type="submit"  value="Hire the maximum <?php echo $max ?> ">

                </div>
            </form>




        </div>







        <div class='col-sm-6'>
                    <h4>Stats</h4>



                    <?php
                    //redundant but I'm too scared to delete at the 11th hour
                    include('dbconnect.php');

                    // get all the unit details, also probably redundant
                    $getunits = "SELECT * FROM Unit WHERE Unit_ID = 5";

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

                    //display light tank details
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
                        <!-- Flavour text -->
                    <h4>Equipment</h4>
                    <ul>
                        <li>Primary Weapon: <strong>Puteaux SA 1918 37 mm gun </strong></li>
                        <li>Secondary Weapon: <strong>8 mm Hotchkiss machine gun</strong></li>
                        <li>Armour: <strong>Up to 22mm thick</strong></li>

                    </ul>


                    <p>It might not look like much, but it's a hell of a lot better than standing in the open and
                    it hits harder than you think.</p>
                </div>



            </form>

        </div></div>
</div>

</body>
</html>