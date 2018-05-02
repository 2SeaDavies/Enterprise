
<?php
// the usual
	require_once("dbconnect.php");
	// get the name and password
	$name = $_POST["name"];
	$password = $_POST["password"];
		//hash the password with md5!!! So Secure!!!
	$password = md5($password);
	//get the player details
	$un_sql = "SELECT Name FROM Player WHERE Name='".$name."'";
	$un_res = $conn->query($un_sql);
	//dump them to error page if it went wrong
	if ($un_res->num_rows == 1) {
		header("Location: signup.php?msg=2");
	} 
	else {
		//insert the player into the player table
		$sql = "INSERT INTO Player (Name, Password)
		VALUES ('".$name."','".$password."')";
		
		if ($conn->query($sql) === TRUE) {
			//give the player no units but set their army anyway
			$sql = "INSERT INTO Player_Units(Name,Unit_ID,Num)
				VALUES('$name','1','0'),('$name','2','0'),('$name','3','0'),('$name','4','0'),('$name','5','0'),('$name','6','0')";
            if ($conn->query($sql) === TRUE) {}
            //make a new territory
            $sql = "INSERT INTO Territory(Value)
				VALUES('250')";
            if ($conn->query($sql) === TRUE) {}
            // give the new territory to the new player!
            $sql = "INSERT INTO Player_Territory(Name )
				VALUES('$name')";
            if ($conn->query($sql) === TRUE) {}
            //put them to the login screen

                header("Location: login.php?msg=1");
			} else {
			// or display an error
            echo "Error updating record: " . $conn->error;
			header("Location: signup.php?msg=1");
		}
	}
?>
