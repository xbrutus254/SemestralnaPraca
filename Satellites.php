<?php
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
<body style="background-color: black">
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.php">Interesting Space</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="OurSolarSys.php">Our Solar System <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
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

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="dataImages/voyager2.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Voyager 2</h5>
                <p> Launched by NASA on  1977, still active. On 2018, at distance of 1.83x10^10 km from the Sun, left the heliosphere and entered the interstellar medium.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="dataImages/parker.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Parker Solar Probe</h5>
                <p> Is a NASA Space Probe launched in 2018 with the mission of making observations of the outer corona of the Sun. It will approach to within 9.86 solar radii (6.9 million km) from the center of the Sun, and by 2025 will travel, at closest approach, as fast as 690,000 km/h, or 0.064% the speed of light.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="dataImages/insight.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>InSight</h5>
                <p> Is a robotic lander designed to study the deep interior of the planet Mars.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


</body>
</html>