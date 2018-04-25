<?php
/*
*	https://github.com/knitein/PHP-Signup-Login
*	Simplest fully featured user management with Signup and Login, made with PHP.
*/
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
    <?php include("style.php"); ?>
</head>

<body>


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
                    <li><a href="/territories.php">View Territories</a></li>
                    <li><a href="/playas.php">Players</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <button onclick='location.href = "logout.php";'>Logout</button>







                    </li>
                </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>        </div>


<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h2 class='panel-title'>Home</h2></div><div class='panel-body'>


            <?php echo "<p>Welcome ".$_SESSION['name']."</p>";
            $name = $_SESSION['name'];

            $sql = "SELECT Money from Player where Name = '$name'";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                $Money = $row["Money"];
            }

            echo "<table class=\"table table-striped task-table\">
<tr>
<th>Name</th>
<th> Power!</th>


</tr>";

            $sql = "SELECT Name FROM Player";
            $result = $conn->query($sql);


            while ($row = $result->fetch_assoc()) {
                $name = $row['Name'];
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                $Power = 0;
                $moarSQL = "SELECT Unit.*,Player_Units.Num FROM Unit, Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$name'";
                $result2 = $conn->query($moarSQL);
                while ($row = $result2->fetch_assoc())  {
                    $Attack = $row['Attack'];
                    $HP = $row['HP'];
                    $Acc = $row['Acc'];
                    $Num = $row['Num'];
                    $Power += ((($Attack + $HP + $Acc) * $Num) / 3);
                    $Power = round($Power);





                }
                echo "<td>" . $Power . "</td>";

            }

            echo "</table>";

            ?>

        </div>



        </form>

    </div></div>
</div>

</body>
</html>
