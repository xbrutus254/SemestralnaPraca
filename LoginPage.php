<?php
    session_start();
    require_once('connectionServer/Connection.php');

    if (!isset($my_Db)) $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if ("admin" === $_SESSION["name"])
        {
            header("location: connectionServer/welcomeLoginAdm.php");
        } else {
            header("location: connectionServer/welcomeLogin.php");
        }
        exit;
    }

    $username = $password = "";
    $username_err = $password_err = "";
    $usr_checker = "";
    $pass_checker = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if username is empty
        if(empty(trim($_POST["username"]))) {
            $usr_checker = trim($_POST["username"]);
            $username_err = "Please enter a username.";
        } else{
            $username = trim($_POST["username"]);
        }
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $pass_checker = trim($_POST["password"]);
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
            $sthandler = $my_Db_Connection->prepare("SELECT username, password FROM appusers WHERE username = :name");
            $sthandler->bindParam(':name', $username);
            $sthandler->execute();
            if($sthandler->rowCount() > 0) {
                $row = $sthandler->fetch();
                $origin_name = $row['username'];
                $origin_psw = $row['password'];
                //echo " pass_checker : " . $_POST["password"];
                //echo " password : " . $password;
                if($origin_name == $username && password_verify($password, $origin_psw)) {

                    session_start();
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["name"] = $username;

                    // Redirect user to welcome page
                    if ("admin" === $username)
                    {
                        header("location: connectionServer/welcomeLoginAdm.php");
                    } else {
                        header("location: connectionServer/welcomeLogin.php");
                    }
                } else {
                    $password_err = "The password you entered was not valid.";
                }
            } else {
                $username_err = "No account found with that username.";
            }}
        }

?><head>
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
                <a class="nav-link" href="LoginPage.php">Log in</a>
                <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                    echo "<a>" . $_SESSION["name"] . "</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>


<div class="container-fluid">
    <div class="col-sm-12">
        <div class="transboxLog">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Don't have an account? <a href="connectionServer/registLogin.php">Sign up now</a>.</p>
            </form>
        </div>
    </div>
</div>


</body>

</html>