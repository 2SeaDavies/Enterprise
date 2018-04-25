
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
require_once("session.php");
include('dbconnect.php');

$order = $_GET["Buy"];
$name = $_SESSION["name"];

$sql = "SELECT * FROM Player WHERE Name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $available = $row["Money"];
    }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM Player_Units WHERE Name = '$name' AND Unit_ID =1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $num = $row["Num"];
    }
} else {
    echo "0 results";
}


$getunits = "SELECT * FROM Unit WHERE Unit_ID = 1";

$result = $conn->query($getunits);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cost = $row['Cost'];


    }

} else {
    echo "0 results";
}
$num += $order;
$cost *= $order;

if ($available >= $cost) {
    $available -= $cost;
    $sql = "UPDATE Player SET Money='$available' WHERE Name='$name'";



    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $sql = "UPDATE Player_Units SET Num='$num' WHERE Name='$name' and Unit_ID =1 ";


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
                    <li><a href="/Soldier.php">Buy Units</a></li>
                    <li><a href="/territories.php">Territories</a></li>
                    <li><a href="/resources">Players</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">

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
    </nav>        </div>

<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Recruit Soldiers</h3></div><div class='panel-body'>

            <form method="Get" action="Soldier.php" accept-charset="UTF-8">

                <input name="Buy" type="hidden" value="1">


                <div class='col-sm-6'>
                    <h2>Cash Available: <?php echo $available ?></h2>

                    <img src="Soldier.jpg">

                  <br>
                    <div class="form-group">
                        <input class="form-control" type="submit"  value="Hire one">
                    </div>
                </div>







                <div class='col-sm-6'>
                    <h4>Stats</h4>



                    <?php
                    include('dbconnect.php');


                    $getunits = "SELECT * FROM Unit WHERE Unit_ID = 1";

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


                    $cost = 0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['HP'] . "</td>";
                        echo "<td>" . $row['Attack'] . "</td>";
                        echo "<td>" . $row['Acc'] . "</td>";
                        echo "<td>" . $row['Ran'] . "</td>";
                        echo "<td>" . $row['Cost'] . "</td>";

                        echo "</tr>";
                    }


                    echo "</table>";

                    ?>

                    <h4>Equipment</h4>
                    <ul>
                        <li>Primary Weapon: <strong>DP 28 Machine Gun</strong></li>
                        <li>Secondary Weapon: <strong>Nagant M1895</strong></li>
                        <li>Armour: <strong>Das Kapital in left inside breast pocket</strong></li>

                    </ul>


                   <p>At the end of the day every army is made of men and this man is one of the finest.
                       He's not well equipped but he'll serve you until death if it comes to that.
                   Just promise him three hearty meals a day and that his glory will be recognised when it's earned.</p>
                </div>



            </form>

        </div></div>
</div>

</body>
</html>