<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: LoginPage.php");
        exit;
    }

    require_once('../connectionServer/Connection.php');

    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();
    $sthandler = $my_Db_Connection->prepare("SELECT money FROM appusers WHERE username = :name");
    $sthandler->bindParam(':name', $_SESSION["name"]);
    $sthandler->execute();
    $row = $sthandler->fetch();
    if($sthandler->rowCount() > 0) {
        $money = (int)$row['money'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OuterSpace</title>
    <link rel="icon" href="../dataImages/icon.png">
    <link rel="stylesheet" href="../rules.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .page-header{ width: 3500px; margin: auto}
    </style>
</head>
<body>

<body style="background-color: white">

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="../index.html">Interesting Space</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../OurSolarSys.php">Our Solar System <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Satellites.html">Satellites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../buystar.php">Buy Star</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <?php
                echo "<a class='nav-link' href='connectionServer/welcomeLogin.php'>" . $_SESSION["name"] . "</a>";
                ?>
            </li>
        </ul>
    </div>
</nav>



    <div class="col-sm-8 text-right">

        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Here you can change your password or delete account.</h1>

        <style>
            p{
                float: top;
                left: 40%;
            }
        </style>
        <p>
            <a href="resetPass.php" class="btn btn-warning">Reset Your Password</a>
            <a href="logoutLogin.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>

    </div>
    <div class="col-sm-4 text-right">
        <h1>Your amouth is  <b><?php echo htmlspecialchars($money); ?></b> €</h1>
    </div>
</div>

</html>
