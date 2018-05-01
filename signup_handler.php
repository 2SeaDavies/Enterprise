
<?php
	require_once("dbconnect.php");
	
	$name = $_POST["name"];
	$password = $_POST["password"];
	$password = md5($password);
	echo "<p> $password </p>";
	
	$un_sql = "SELECT Name FROM Player WHERE Name='".$name."'";
	$un_res = $conn->query($un_sql);
	if ($un_res->num_rows == 1) {
		header("Location: signup.php?msg=2");
	} 
	else {
		$sql = "INSERT INTO Player (Name, Password)
		VALUES ('".$name."','".$password."')";
		
		if ($conn->query($sql) === TRUE) {
			$sql = "INSERT INTO Player_Units(Name,Unit_ID,Num)
				VALUES('$name','1','0'),('$name','2','0'),('$name','3','0'),('$name','4','0'),('$name','5','0'),('$name','6','0')";
            if ($conn->query($sql) === TRUE) {}
            $sql = "INSERT INTO Territory(Value)
				VALUES('250')";
            if ($conn->query($sql) === TRUE) {}
            $sql = "INSERT INTO Player_Territory(Name )
				VALUES('$name')";
            if ($conn->query($sql) === TRUE) {}

                header("Location: login.php?msg=1");
			} else {
            echo "Error updating record: " . $conn->error;
			header("Location: signup.php?msg=1");
		}
	}
?>
