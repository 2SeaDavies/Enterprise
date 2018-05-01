
<?php
	session_start();
	if(isset($_SESSION["name"])) { header('location: index.php'); }
?>
<!DOCTYPE html>
<html>
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Commander!</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/portfolio-item.css" rel="stylesheet">

        <!-- Personal CSS -->
        <link href="css/personal.css" rel="stylesheet">


        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <title>Signup</title>
		<?php include("style.php"); ?> 
		
		<?php
			if(isset($_GET["msg"])) {
				switch ($_GET["msg"]) {
					case 1:
					echo '<script>alert("Unknown error occured, try again.");</script>';
					break;
					
					case 2:
					echo '<script>alert("Username already exists, use another username.");</script>';
					break;
				}
			}
		?>
		
	</head>


<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Commander!</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/login.php">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>        </div>

<div class="container">

    <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Register</h3></div><div class='panel-body'>

            <form id="signup" action="signup_handler.php" method="post">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" name="name" type="text" id="name">
                </div>


                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" name="password" type="password" value="" id="password">
                </div>


                <div class="form-group">
                    <button onclick="document.getElementById('signup').submit();">Signup</button>
                </div>
                <p>Already have an account? <a href="login.php">Click Here</a> to login.</p>

            </form>

        </div></div>
</div>

</body>
</html>
