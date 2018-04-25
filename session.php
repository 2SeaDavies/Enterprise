
<?php 
	require_once("dbconnect.php");
	
	session_start();
	$user_check = $_SESSION["name"];
	
	$sql = "SELECT Name FROM Player WHERE Name= '".$user_check."'";
	$result = mysqli_query($conn, $sql);
	
	while($row = mysqli_fetch_assoc($result)) {
		$user = $row["Name"];
	}	
	
	if(!isset($user)){
		mysqli_close($conn);
		header('Location: signup.php');
	}
?>
