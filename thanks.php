
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ai or not?</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">



    <?php
    include('dbconnect.php');
    include 'Songs.php';
    $guess = $_GET["guess"];
    $increment = $_GET["increment"];

    $quiz  = $_GET["pic"];
    $text  = $songs[12][0];

    $correct = $songs[$increment-1][1];
    $right = $_GET["right"];
    $turing = 0;

    if ($guess == $correct) {
        $right += 1;
    }





    ?>
</head>

<body>






<form id="user" action="botornot.php.php" method="get" target="_blank" style="position: absolute">
    <input style="display: none" id="increment" name ="first_name" value="<?php echo $_GET['firet_name'] ?>"><br>
    <input style="display: none" id="right" name ="last_name"value="<?php echo $_GET['last_name'] ?>"><br>
    <input style="display: none" id="wrong" name ="last_name"value="<?php echo $_GET['last_name'] ?>"><br>

</form>




<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </nav>
    </div>

    <div class="jumbotron">
        <h1 class="display-3">The Turing Test</h1>
        <p class="lead">Guess whether the lyrics shown below where written by a human or a bot
        </p>
    </div>



    <?php
    echo "<div class='containerBox'>
                             
                                <div class='text-box'>
                                    <p class='text-center'>{$text}</p>
                                </div>
                            </div>
                            ";

    ?>

    <div class="row marketing">
        <div class="col-lg-6">
            <div class="col-md-12 text-center">





            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-md-12 text-center">

            </div>




        </div>
    </div>


    <?php

    if ($increment > 0) {

        if ($guess == "human" and $correct == "bot") {
            $turing = 1;

        }
        if ($guess == $correct) {
            echo "<div class='containerBox'>

    <div class='text-box'>
        <p>You were right!</p>
        <p> You got $right out of $increment right!</p>
    </div>
</div>


";

        } else {
            echo "<div class='containerBox'>

    <div class='text-box'>
        <p>That was incorrect</p>
        <p> You got $right out of $increment right!</p>
    </div>
</div>
";
        }
    }




    ?>

    <footer class="footer">
        <p>&copy; Company 2017</p>
    </footer>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
