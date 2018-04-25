
<?php
	if (empty($_POST['name']) || empty($_POST['password'])) {
		header("Location: login.php?msg=4");
	}
	else {
		require_once("dbconnect.php");
		$name=$_POST['name'];
		$password=md5($_POST['password']);
        echo "<p> $password </p>";
		
		$sql = "SELECT * FROM Player WHERE Password='".$password."' AND Name='".$name."'";
		$result = $conn->query($sql);
		if ($result->num_rows == 1) {
			session_start();
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
