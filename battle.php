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


$sql = "Select * from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$nom' and Ran in (Select min(Ran) from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Num > 0 and Player_Units.Name = '$nom')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["Name"] . " - Name: " . $row["Unit_ID"] . " " . $row["Num"] . "<br>";
        echo "<p>healthy $healthy </p>";
        $HP = $row["HP"];
        $healthy+= $row["HP"];
        $num = $row["Num"];
        $cost = $row["Cost"];

        echo "<p>healthy $healthy </p>";
        $ID = $row["Unit_ID"];

        echo "<p>healthy $healthy </p>";
        $healthy *= $row["Num"];
        echo "<p>healthy $healthy </p>";



        if ($damage2 > $healthy) {

            $sql = "UPDATE Player_Units SET Num = 0 where Unit_ID = $ID and Player_Units.Name = '$nom'";

            if ($conn->query($sql) === TRUE) {
                $damage2 -= $healthy;
                echo "<p> they died </p>";
                echo "<p> $damage2 </p>";

            } else {
                echo "Error updating record: " . $conn->error;
            }


            
        }
        else {
            echo "<p>damage before: $damage2 </p>";
            echo "<p>healthy $healthy </p>";
            $dead = $damage2 / $HP;
            echo "<p>dead $dead </p>";
            $dead = floor($dead);
            $bounty = $cost * $dead;
            echo "<p>bounty: $bounty </p>";



            $damage2 -= $dead * $HP;
            echo "<p>damage after: $damage2 </p>";

            echo "<p>dead: $dead </p>";
            $moarsql = "UPDATE Player_Units SET Num = (Num - $dead) where Name = '$nom' and Unit_ID = $ID";

            if ($conn->query($moarsql) === TRUE) {


            } else {
                echo "Error updating record: " . $conn->error;
            }



        }

    }
}
else {
    echo "0 results";
}
$healthy = 0;
$dead = 0;
$sql = "Select * from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Player_Units.Name = '$attack' and Ran in (Select min(Ran) from Unit,Player_Units where Unit.Unit_ID = Player_Units.Unit_ID and Num > 0 and Player_Units.Name = '$attack')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["Name"] . " - Name: " . $row["Unit_ID"] . " " . $row["Num"] . "<br>";
        echo "<p>healthy $healthy </p>";
        $healthy+= $row["HP"];
        echo "<p>healthy $healthy </p>";
        $ID = $row["Unit_ID"];

        echo "<p>healthy $healthy </p>";
        $healthy *= $row["Num"];
        echo "<p>healthy $healthy </p>";
        echo "<p>damage $damage </p>";


        if ($damage > $healthy) {

            $sql = "UPDATE Player_Units SET Num = 0 where Unit_ID = $ID and Player_Units.Name = '$attack'";

            if ($conn->query($sql) === TRUE) {
                echo "<p> they died </p>";
            } else {
                echo "Error updating record: " . $conn->error;
            }



        }

        else {
            echo "<p>damage before: $damage </p>";
            echo "<p>healthy $healthy </p>";
            if ($damage > 0) {
                $dead = $damage / $HP;
            }

            echo "<p>dead $dead </p>";
            $dead = floor($dead);

            $damage -= $dead * $HP;
            echo "<p>damage after: $damage </p>";

            echo "<p>dead: $dead </p>";
            $moarsql = "UPDATE Player_Units SET Num = (Num - $dead) where Name = '$attack' and Unit_ID = $ID";

            if ($conn->query($moarsql) === TRUE) {


            } else {
                echo "Error updating record: " . $conn->error;
            }



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