<?php
include('dbconnect.php');

$sql = "SELECT * FROM Player_Units";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Player_ID"]. " - Name: " . $row["Unit_ID"]. " " . $row["Num"]. "<br>";
    }
} else {
    echo "0 results";
}

$getone = "SELECT * FROM Player_Units WHERE Player_ID =1";

$result = $conn->query($getone);


while($row = $result->fetch_assoc()) {
    echo "id: " . $row["Player_ID"]. " - Name: " . $row["Unit_ID"]. " " . $row["Num"]. "<br>";
    $id = $row["Unit_ID"];
    $num = $row["Num"];
}



$getunits = "SELECT * FROM Unit WHERE Unit.Unit_ID = $id";

$result = $conn->query($getunits);

$attack = 0;
while($row = $result->fetch_assoc()) {
    echo "attack: " . $row["Attack"]. " - ID: " . $row["Unit_ID"]. " " .  "health:". $row["HP"]."<br>";
    $attack += $row["Attack"];
    $acc = $row["Acc"];
    $hp = $row["HP"];
}

echo "<p>$num </p>";

$str = rand($acc,$acc*2);

$attack *= $str;

$attack *= $num;
echo "<p>$attack</p>";


$attack/=100;


echo "<p>$attack</p>";


$get2 = "SELECT * FROM Player_Units WHERE Player_ID =2";

$result2 = $conn->query($get2);


while($row = $result2->fetch_assoc()) {
    echo "id: " . $row["Player_ID"]. " - Name: " . $row["Unit_ID"]. " " . $row["Num"]. "<br>";
    $id2 = $row["Unit_ID"];
    $num2 = $row["Num"];
}
echo "player 1 has $num units and player 2 has $num2 units". "<br>";


$getunits2 = "SELECT * FROM Unit WHERE Unit.Unit_ID = $id2";

$result = $conn->query($getunits2);

$attack2 = 0;
while($row = $result->fetch_assoc()) {
    echo "id: " . $row["Attack"]. " - Name: " . $row["Unit_ID"]. " " . "health:". $row["HP"]. "<br>";
    $attack2 += $row["Attack"];
    $acc2 = $row["Acc"];
    $hp2 = $row["HP"];
}

echo "<p>$num2 </p>";

$str2 = rand($acc2,$acc2*2);

$attack2 *= $str2;

$attack2 *= $num2;
echo "<p>$attack2</p>";


$attack2/=100;

$attack = (int)$attack;
$attack2 = (int)$attack2;

echo "<p>$attack</p>";

echo "<p>$attack2 </p>";

$unitslost1 = 0;
$unitslost2 = 0;

$unitslost1 = (int)($attack2/$hp);
$unitslost2 = (int)($attack/$hp2);


echo "<p>$unitslost1</p>";
echo "<p>$unitslost2</p>";
$num-= $unitslost1;

$num2-=$unitslost2;

echo "<p>$num</p>";
echo "<p>$num2</p>";

$sql = "UPDATE Player_Units SET Num='$num' WHERE Player_ID=1";


if ($conn->query($sql) === TRUE) {
} else {
    echo "Error updating record: " . $conn->error;
}

$sql = "UPDATE Player_Units SET Num='$num2' WHERE Player_ID=2";


if ($conn->query($sql) === TRUE) {
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>