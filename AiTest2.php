
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:image" content="https://ei.marketwatch.com/Multimedia/2018/02/13/Photos/ZH/MW-GD647_skynet_20180213113524_ZH.jpg?uuid=e41f2218-10db-11e8-b127-9c8e992d421e"/>
    <link rel="icon" href="../../favicon.ico">

    <title>The Advanced Turing Test</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">




    <?php
    include('dbconnect.php');
    include 'Songs2.php';
    $guess = $_GET["guess"];
    $increment = $_GET["increment"];
    $textleft  = $leftsongs[$increment];
    $textright = $rightsongs[$increment];
    $right = $_GET["right"];
    $correct = $answers[$increment-1];
    $turing = 0;
    if($increment > 5) {
        Header("Location:thanks2.php?increment=$increment&right=$right&guess=$guess");
    }

    if ($guess == $correct) {
        $right += 1;
    }








    ?>
</head>

<body>


<form id="user" action="quiz.php" method="get" target="_blank" style="position: absolute">
</form>

<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">Advanced Turing Test</h1>
        <p class="lead">One of these song excerpts was written by a bot and one by a human, can you guess which one was written by the bot?
        </p>
    </div>

    <div class="row marketing">
        <div class="col-lg-6">
            <p><?php echo $textleft; ?></p>
            <a class="btn btn-md btn-success" href="AiTest2.php?increment=<?php echo $increment+1;?>&guess=left&right=<?php echo $right;?>&turing=<?php echo $turing;?>"">This one is the bot</a>

        </div>

        <div class="col-lg-6">
            <p><?php echo $textright; ?></p>
            <a class="btn btn-md btn-success" href="AiTest2.php?increment=<?php echo $increment+1;?>&guess=right&right=<?php echo $right;?>&turing=<?php echo $turing;?>">This one is the bot</a>

        </div>
    </div>


    <?php

    if ($increment > 0) {

        if ($guess == "left" and $correct == "right") {
            $turing = 1;

        }
        if ($guess == "right" and $correct == "left") {
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


 if ($increment >0) {
    $sql = "INSERT INTO Honours2(Turing,Guess,Increment,Correct)
VALUES ('$turing', '$guess', '$increment', '$correct')";

    if (mysqli_query($conn, $sql)) {

    } else {
    }
    }

    ?>

    <footer class="footer">
    </footer>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
