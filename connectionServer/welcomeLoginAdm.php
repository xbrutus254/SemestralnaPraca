<?php
    // Initialize the session
    session_start();
    require "Connection.php";

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: LoginPage.php");
        exit;
    }
    $sthandler = $my_Db_Connection->prepare("SELECT username FROM uzivatel");
    $sthandler->execute();
    $result = $sthandler->fetchAll();

    function deleteUser($name, $my_Db_Connection)
    {
        echo $name;
        $sthandler = $my_Db_Connection->prepare("SELECT username FROM uzivatel WHERE username = :name");
        $sthandler->bindParam(':name', $name);
        $sthandler->execute();
        if($sthandler->rowCount() > 0)
        {
            $sthandler = $my_Db_Connection->prepare("DELETE FROM uzivatel WHERE username = :name");
            $sthandler->bindParam(':name', $name);
            $sthandler->execute();
            header("location: welcomeLoginAdm.php");
            exit;
        }
    }

    if (!empty($_GET['fn'])) {
        if ($_GET['fn'] == "deleteUser")
        {
            if (!empty($_GET['param']))
            {
                if ($_GET['param'] == "admin") {
                    echo "admin can not be removed!";
                } else {
                    deleteUser($_GET['param'], $my_Db_Connection);
                }
            }
        }
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
        body{ font: 14px sans-serif; text-align: center; }
    </style>

    <style>
        body {
            background: url("../dataImages/sett.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
            text-align: center;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="../index.html">Interesting Space</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../OurSolarSys.html">Our Solar System <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Satellites.html">Satellites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../BigBang.html">Big Bang</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../LoginPage.php">Log in</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="page-header">
    <a href="resetPass.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logoutLogin.php" class="btn btn-danger">Sign Out of Your Account</a>
</div>
<p>
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Here you can manage accounts.</h1>

</p>
<div class="row">
    <style>
        .column {
            float: left;
            width: 20%;
            padding: 10px;
            height: auto; /* Should be removed. Only for demonstration */
        }
    </style>
    <div class="column" style="background-color:#aaa;">
        <h2>Users:</h2>
        <?php foreach ($result as $row) {
            $name = $row['username'];?>
            <div>
                <style>
                    h3 {
                        float: right;
                    }
                </style>
                <h3><?php echo $name ?>
                <a href="welcomeLoginAdm.php?fn=deleteUser&param=<?=$name ?>" class="btn btn-danger">delete user</a></h3>
            </div>
        <?php } ?>
    </div>
    <div class="column"></div>
</div>
</body>
</html>
