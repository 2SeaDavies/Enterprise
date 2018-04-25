<?php
include('dbconnect.php');
require_once("session.php");


$attack = $_GET["attack"];
$nom = $_SESSION['name'];
echo "<p>$name</p>";
$sql = "SELECT * FROM Unit,Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Num >0 and Player_Units.Name = '$nom'";
$result = $conn->query($sql);
$strength =0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Name"]. " - Name: " . $row["Unit_ID"]. " " . $row["Num"]. "<br>";
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
    echo "0 results";
}
$strength /=3;
$strength = round($strength);
echo "<p>$strength</p>";
echo "<p> $attack </p>";




$sql = "SELECT * FROM Unit,Player_Units WHERE Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Num >0 and Player_Units.Name = '$attack'";
$result = $conn->query($sql);
$strength2 =0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Name"]. " - Name: " . $row["Unit_ID"]. " " . $row["Num"]. "<br>";
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
    echo "0 results";
}
$strength2 /=3;
$strength2 = round($strength2);
echo "<p>$strength2</p>";
$damage2 = $strength2;
$damage = $strength;


$sql = "Select * from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = 'Creg' and Ran in (Select min(Ran) from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Num > 0 and Player_Units.Name = '$nom')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["Name"] . " - Name: " . $row["Unit_ID"] . " " . $row["Num"] . "<br>";
        $healthy+= $row["HP"];


        $healthy *= $row["Num"];


        if ($damage2 > $healthy) {

            
        }

    }
}
else {
    echo "0 results";
}



if ($strength > $strength2) {
    echo "<p>$name has won the battle and the territory</p>";
}
else {
    echo "<p>$attack has won the battle and the territory</p>";
}


//Header("Location:index.php?increment=$strength");
?>