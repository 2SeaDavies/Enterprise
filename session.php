
<?php
// the usual
	require_once("dbconnect.php");
	// start the session
	session_start();
	$user_check = $_SESSION["name"];
	//get the player details
	$sql = "SELECT Name FROM Player WHERE Name= '".$user_check."'";
	$result = mysqli_query($conn, $sql);
	
	while($row = mysqli_fetch_assoc($result)) {
		$user = $row["Name"];
	}	
	// if they don't have a session, dump them to the sign up page
	if(!isset($user)){
		mysqli_close($conn);
		header('Location: signup.php');
	}
?>
