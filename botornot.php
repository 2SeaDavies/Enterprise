
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:image" content="https://ei.marketwatch.com/Multimedia/2018/02/13/Photos/ZH/MW-GD647_skynet_20180213113524_ZH.jpg?uuid=e41f2218-10db-11e8-b127-9c8e992d421e"/>
    <link rel="icon" href="../../favicon.ico">

    <title>Ai or not?</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">



    <?php
    include('dbconnect.php');
    include 'Songs.php';
    $guess = $_GET["guess"];
    $increment = $_GET["increment"];
    $text  = $songs[$increment][0];
    $correct = $songs[$increment-1][1];
    $right = $_GET["right"];
    $turing = 0;
    if( $increment > 11) {
        Header("Location:thanks.php?increment=$increment&right=$right&guess=$guess");
    }

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





                <a class="btn btn-md btn-success" href="botornot.php?increment=<?php echo $increment+1;?>&guess=human&right=<?php echo $right;?>&turing=<?php echo $turing;?>"> Human</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-md-12 text-center">
                <a class="btn btn-md btn-success" href="botornot.php?increment=<?php echo $increment+1;?>&guess=bot&right=<?php echo $right;?>&guess=bot&turing=<?php echo $turing;?>"> Bot</a>
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
        <p> You've got $right out of $increment right so far</p>
    </div>
</div>


";

        } else {
            echo "<div class='containerBox'>

    <div class='text-box'>
        <p>That was incorrect</p>
        <p> You've got $right out of $increment right so far!</p>
    </div>
</div>
";
        }
    }


    $sql = "INSERT INTO Honours(Turing,Guess,Increment,Correct)
VALUES ('$turing', '$guess', '$increment', '$correct')";

    if (mysqli_query($conn, $sql)) {

    } else {
    }

    ?>

    <footer class="footer">

        <br>
        <br>
    </footer>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
