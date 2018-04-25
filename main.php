
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
                    <li><a href="/soldier.php">Buy Units</a></li>
                    <li><a href="/missions">Place</a></li>
                    <li><a href="/resources">Holder</a></li>
                    <li><a href="/base">Under</a></li>
                    <li><a href="/reports">Construction</a></li>
                    <li><a href="/players">Players</a></li>
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
                            creg <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/players/418">Profile</a></li>
                            <li><a href="/profile">Edit Profile</a></li>
                            <li><a href="/password">Change Password</a></li>
                            <li>
                                <a href="http://www.seapowers.com/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="http://www.seapowers.com/logout" method="POST" style="display: none;"><input type="hidden" name="_token" value="NEMpyDG8HUHLaRrwSycYIVA37lzHlrVqtG3ASMGD"></form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>        </div>

<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Available Units</h3></div><div class='panel-body'>

            </form>

            <?php


include('dbconnect.php');



$getunits = "SELECT * FROM Unit";


$result = $conn->query($getunits);




echo "<table class=\"table table-striped task-table\">
<tr>
<th>Name</th>
<th>HP</th>
<th>Attack</th>
<th>Accuracy</th>
<th>Range</th>
<th>Cost</th>
<th>Buy how many?</th>

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
    echo "<td>" . $row['Cost'] . "</td>";
   echo "</tr>";
}


echo "</table>";

?>


        </div></div>
</div>

</body>
</html>