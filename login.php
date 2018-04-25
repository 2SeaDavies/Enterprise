
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

        <title>Login</title>
		<?php include("style.php"); ?>
		
		<?php
			if(isset($_GET["msg"])) {
				switch ($_GET["msg"]) {
					case 1:
					echo '<script>alert("Signup complete, Login to continue.");</script>';
					break;
					
					case 2:
					echo '<script>alert("Invalid username/password!");</script>';
					break;
					
					case 3:
                        echo "Error updating record: " . $conn->error;
					echo '<script>alert("Unknown error occured, try again.");</script>';
					break;
					
					case 4:
					echo '<script>alert("Either the username or password was empty, please try again.");</script>';
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

        <div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Login</h3></div><div class='panel-body'>

                <h1>Login</h1>
                <form id="login" action="login_handler.php" method="post">
                    <input type="text" placeholder="name" id="name" name="name" required><br><br>
                    <input type="password" placeholder="Password" id="password" name="password" required><br><br>
                    <button onclick="document.getElementById('login').submit();">Login</button>
                </form>

                <p>Not a user? <a href="signup.php">Click Here</a> to signup.</p>

            </div></div>
    </div>







                    </ul>
                </div>
            </div>
        </nav>        </div>

	</body>
	</html>	
