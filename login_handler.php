
<?php
//checks to see if login details are filled
	if (empty($_POST['name']) || empty($_POST['password'])) {
		header("Location: login.php?msg=4");
	}
	else {
		// require db connect that does not exist
		require_once("dbconnect.php");
		// sets the name and password hashed with md5 wow, so secure!
		$name=$_POST['name'];
		$password=md5($_POST['password']);
		// create the sql to get the user details
		
		$sql = "SELECT * FROM Player WHERE Password='".$password."' AND Name='".$name."'";
		$result = $conn->query($sql);
		if ($result->num_rows == 1) {
		    // starts the session!
			session_start();
			// one of these is redundant... But they set the session name to the player name
            // I can't remember which one worked...
            // I'm pretty sure that there isn't even a player ID anymore, but I'm too scared to delete things now
			$_SESSION['name']=$name;
			while($row = $result->fetch_assoc()) {
				$_SESSION['name']=$row["Name"];
				$_SESSION['id'] = $row["Player_ID"];
			}
			header("location: index.php");
		}
		else {
			header("location: login.php?msg=2");
		}
	}
	$conn->close();
?>
