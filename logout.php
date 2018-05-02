
<?php
	session_start();
	//logs the player out by destroying the session
	if(session_destroy())
	{
		header("Location: login.php");
	}
?>
