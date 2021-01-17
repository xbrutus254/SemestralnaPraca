<?php
// Initialize the session
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OuterSpace</title>
    <link rel="icon" href="dataImages/icon.png">
    <link rel="stylesheet" href="rules.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.php">Interesting Space</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="OurSolarSys.php">Our Solar System <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Satellites.php">Satellites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="buystar.php">Buy Star</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                    if ($_SESSION["name"] != "admin")
                        echo "<a class='nav-link' href='connectionServer/welcomeLogin.php'>" . $_SESSION["name"] . "</a>";
                    else
                        echo "<a class='nav-link' href='connectionServer/welcomeLoginAdm.php'>" . $_SESSION["name"] . "</a>";
                } else {
                    echo "<a class='nav-link' href='LoginPage.php'>Log in</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <script>
                function change(param) {
                    var reader  = new XMLHttpRequest();
                    var allText;
                    reader.open("GET", param.concat(".txt"), true);
                    reader.onreadystatechange = function ()
                    {
                        allText = reader.responseText;
                        document.getElementById("pText").innerHTML =  allText;
                    }
                    reader.send(null);
                    var reader2  = new XMLHttpRequest();
                    var allText2;
                    reader2.open("GET", (param.concat("2")).concat(".txt"), true);
                    reader2.onreadystatechange = function ()
                    {
                        allText2 = reader2.responseText;
                        document.getElementById("pText2").innerHTML =  allText2;
                    }
                    reader2.send(null);
                }
            </script>
            <button type="button" onclick="change('files/sun')" style="width: 91%" class="btn btn-default">Sun</button>
            <button type="button" onclick="change('files/mercury')" style="width: 91%" class="btn btn-default">Mercury</button>
            <button type="button" onclick="change('files/venus')" style="width: 91%" class="btn btn-default">Venus</button>
            <button type="button" onclick="change('files/earth')" style="width: 91%" class="btn btn-default">Earth</button>
            <button type="button" onclick="change('files/mars')" style="width: 91%" class="btn btn-default">Mars</button>
            <button type="button" onclick="change('files/jupiter')" style="width: 91%" class="btn btn-default">Jupiter</button>
            <button type="button" onclick="change('files/saturn')" style="width: 91%" class="btn btn-default">Saturn</button>
            <button type="button" onclick="change('files/uran')" style="width: 91%" class="btn btn-default">Uranus</button>
            <button type="button" onclick="change('files/neptun')" style="width: 91%" class="btn btn-default">Neptune</button>
        </div>
        <div class="col-sm-8 text-left">
            <style>
                p {
                    color: #0e1011;
                }
                h1, h3 {
                    text-shadow: 2px 2px 5px red;
                }
            </style>
            <h1>Do you know..?</h1>
            <p id="pText"><?php include('files/sun.txt'); ?></p>
            <hr>
            <h3>However..</h3>
            <p id="pText2"><?php include('files/sun2.txt'); ?></p>
        </div>
        <div class="col-sm-2 sidenav">
            <div class="well">
                <img src="dataImages/sun.jpg" class="img-fluid" alt="Chania">
                <img src="dataImages/mercury.jpg" class="img-fluid" alt="Chania">
                <img src="dataImages/venus.jpg" class="img-fluid" alt="Chania">
                <img src="dataImages/earth.jpg" class="img-fluid" alt="Chania">
            </div>
        </div>

    </div>
</div>
</body>
</html>