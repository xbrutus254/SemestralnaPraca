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

    <style>
        body {
            background: url("dataImages/space.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
            text-align: center;
        }
    </style>
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
    <div class="col-sm-12">
        <div class="transbox">
            <h4>WHAT IS SPACE?</h4>
            <p>Space is the boundless three-dimensional extent in which objects and events have relative position and direction.Physical space is often conceived in three linear dimensions, although modern physicists usually consider it, with time, to be part of a boundless four-dimensional continuum known as spacetime. The concept of space is considered to be of fundamental importance to an understanding of the physical universe. However, disagreement continues between philosophers over whether it is itself an entity, a relationship between entities, or part of a conceptual framework.</p>
        </div>
        <div class="transbox2">
            <h4>IN BOOKS..</h4>
            <p>Debates concerning the nature, essence and the mode of existence of space date back to antiquity; namely, to treatises like the Timaeus of Plato, or Socrates in his reflections on what the Greeks called khôra, or in the Physics of Aristotle in the definition of topos, or in the later "geometrical conception of place" as "space qua extension" in the Discourse on Place of the 11th-century. Many of these classical philosophical questions were discussed in the Renaissance and then reformulated in the 17th century, particularly during the early development of classical mechanics</p>
        </div>
        <div class="transbox3">
            <h4>IN PHYSICS..</h4>
            <p>Space is one of the few fundamental quantities in physics, meaning that it cannot be defined via other quantities because nothing more fundamental is known at the present. On the other hand, it can be related to other fundamental quantities. Thus, similar to other fundamental quantities (like time and mass), space can be explored via measurement and experiment. Today, our three-dimensional space is viewed as embedded in a four-dimensional spacetime, called Minkowski space. The idea behind space-time is that time is hyperbolic-orthogonal to each of the three spatial dimensions.</p>
        </div>
    </div>
</div>
</body>
</html>