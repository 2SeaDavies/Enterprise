
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>The Turing Test</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="narrow-jumbotron.css" rel="stylesheet">
</head>

<body>


<form id="user" action="quiz.php" method="get" target="_blank" style="position: absolute">
</form>

<div class="container">

    <div class="jumbotron">
        <h1 class="display-3">The Turing Test</h1>
        <p class="lead">The Turing Test is a test of whether an AI can pass as a human.
        Each of the tests below is a form of Turing Test.
        The test on the left will show you a song and you have to guess whether it was written by an AI or a human.
        The test on the right will show you two songs and you have to guess which is which.
        </p>
    </div>

    <div class="row marketing">
        <div class="col-lg-6">
            <h4>Human or Bot?</h4>
            <p>Guess whether the songs were written by a human or a machine.</p>
            <div class="col-md-12 text-center">
                <a class="btn btn-md btn-success" href="botornot.php?increment=0&right=0&guess=0">Take the Test</a>
            </div>
        </div>

        <div class="col-lg-6">
            <h4>Which is which?</h4>
            <p>Guess which song was written by a machine.</p>
            <div class="col-md-12 text-center">
                <a class="btn btn-md btn-success" href="AiTest2.php?increment=0&right=0&guess=0"">Take the Test</a>
            </div>
        </div>
    </div>

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
