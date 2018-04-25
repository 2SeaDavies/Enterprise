
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">

    <!-- Personal CSS -->
    <link href="css/personal.css" rel="stylesheet">

</head>


<body>


<?php


include('dbconnect.php');

$getone = "SELECT * FROM Player_Units WHERE Player_ID =1";

$result = $conn->query($getone);


$units = array();
$numbers = array();

while($row = $result->fetch_assoc()) {
    array_push($units, $row["Unit_ID"]);
    array_push($numbers, $row["Num"]);

}


echo"<p>" .$units[1]. "</p>";
echo "<br>";


$ids = join("','",$units);
$getunits = "SELECT * FROM Unit,Player_Units WHERE Player_Units.Player_ID = 1 and Player_Units.Unit_ID = Unit.Unit_ID";


$result = $conn->query($getunits);




echo "<table class=\"table table-striped task-table\">
<tr>
<th>Name</th>

<th>Attack</th>
<th>HP</th>
<th>Number</th>
</tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Attack'] . "</td>";
    echo "<td>" . $row['HP'] . "</td>";
    echo "<td>" . $row['Num'] . "</td>";
    echo "</tr>";
}


echo "</table>";
echo "<p> test 7</p>";






?>


</body>
