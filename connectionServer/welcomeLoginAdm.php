<?php
    // Initialize the session
    session_start();
    //require_once('Connection.php');
    require "adminFunc.php";
    if (!isset($my_Db)) $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: LoginPage.php");
        exit;
    }
    $sthandler = $my_Db_Connection->prepare("SELECT username FROM appusers");
    $sthandler->execute();
    $result = $sthandler->fetchAll();
    $sthandlerP = $my_Db_Connection->prepare("SELECT id_product FROM product");
    $sthandlerP->execute();
    $count = $sthandlerP->rowCount();

    $_SESSION["iteration"] = 0;
    $dom = new DOMDocument('1.0', 'utf-8');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OuterSpace</title>
    <link rel="icon" href="../dataImages/icon.png">
    <link rel="stylesheet" href="welcomeLaStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
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
                echo "<a class='nav-link' href='welcomeLoginAdm.php'>" . $_SESSION["name"] . "</a>";
                ?>
            </li>
        </ul>
    </div>
</nav>
<div class="page-header">
    <a href="resetPass.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logoutLogin.php" class="btn btn-danger">Sign Out of Your Account</a>
</div>

<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="javascript:void(0)" onclick="showUsers()">Users</a>
        <a href="javascript:void(0)" onclick="showProducts()">Show Products</a>
        <a href="javascript:void(0)" onclick="addProducts()">Add Products</a>
        <a href="#">Contact</a>
    </div>
</div>
<div class="row" id="leftN">
    <div class="col-sm-4">
        <h1> Info:</h1>
        <hr>
        <h2> Here you can modify users accounts, add new product and allocate product to user.</h2>
        <hr>
        <h2> Users can be added to the blacklist only for binding reasons.</h2>
    </div>
    <div class="col-sm-8">

        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
        <hr>
        <h2 id="idTitle">Users:</h2>

        <div id="idContextUsers">
            <style>
                input[type=text]{
                    position: relative;
                    left: 40%;
                    width: 25%;
                    border: 2px solid #ff0808;
                }
            </style>
            <input type="text" id="moneyInput" class="form-control" placeholder="money">
            <?php foreach ($result as $row) {
                $name = $row['username'];?>

                <style>
                    h3 {
                        position: relative;
                        top: 20%;
                    }
                </style>
                <hr>

                <h3><?php echo $name ?>
                    <a href="welcomeLoginAdm.php?fn=deleteUser&param=<?=$name ?>" class="btn btn-danger">delete user</a>
                    <button type="button" class="btn btn-success" onclick="addmoney('<?=$name ?>')">add</button>
                </h3>

            <?php } ?>
        </div>

        <div id="idContextProducts" style="display: none">
            <hr>
            <div onclick="clickArr(-1)">
            <i class="fa fa-chevron-circle-left" style="font-size:48px;color:greenyellow"></i>
                <p id="txtHint"></p>
            </div>
            <div onclick="clickArr(1)">
            <i class="fa fa-chevron-circle-right" style="font-size:48px;color:greenyellow"></i>
            </div>
            <hr>
        </div>

        <div id="idContextProductsAdd" style="display: none">
            <hr>
            <div>
                <h5><label for="fname">Name of product:</label>
                <input type="text" id="fname" name="name" value="name.."></h5>
            </div>
            <hr>
            <div>
                <h5><label for="feye">Seen by eye:</label>
                <select id="feye" name="seenbyeye">
                    <option value="1">yes</option>
                    <option value="0">no</option>
                </select></h5>
            </div>
            <hr>
            <div>
                <h5><label for="ftype">Set type:</label>
                <select id="ftype" name="type">
                    <option value="star">Star</option>
                    <option value="comet">Comet</option>
                    <option value="moon">Moon</option>
                    <option value="nebula">Nebula</option>
                </select></h5>
            </div>
            <hr>
            <div>
                <h5><label for="fprice">Set price:</label>
                <input type="text" id="fprice" name="setprice" value="price.."></h5>
            </div>
            <hr>
            <div>
                <h4><input type="submit" onclick="addProdFunc()" value="Submit"></h4>
            </div>
            <p id="txtHint2"></p>
        </div>

    </div>
</div>


<script>
    function openNav() {
        document.getElementById("myNav").style.width = "20%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }

    function showUsers() {
        document.getElementById("idTitle").innerHTML = "users";
        document.getElementById("idContextProducts").style.display = "none";
        document.getElementById("idContextUsers").style.display = "initial";
        document.getElementById("idContextProductsAdd").style.display = "none";
        closeNav();
    }

    function showProducts() {
        sessionStorage.setItem("iteration", "0");
        document.getElementById("idTitle").innerHTML = "products";
        document.getElementById("idContextUsers").style.display = "none";
        document.getElementById("idContextProducts").style.display = "initial";
        document.getElementById("idContextProductsAdd").style.display = "none";
        clickArr(0);
        closeNav();
    }

    function addProducts() {
        document.getElementById("idTitle").innerHTML = "add product";
        document.getElementById("idContextProducts").style.display = "none";
        document.getElementById("idContextUsers").style.display = "none";
        document.getElementById("idContextProductsAdd").style.display = "initial";
        closeNav();
    }

    function addmoney(name) {
        var money = document.getElementById("moneyInput").value;


        var xmlhttp = new XMLHttpRequest();


        xmlhttp.open("GET", "ajaxAdminFunc.php?n=" + name + "&p=" + money, true);
        xmlhttp.send();
    }

    /*********************************************************************************/
    function clickArr(param) {
        var i = Number(sessionStorage.getItem("iteration"));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        if ((i+Number(param)) < 0) i=0;
        var temp_var = Number(<?php echo json_encode($count); ?>);
        if ((temp_var) <= (i+Number(param))) i--;
        sessionStorage.setItem("iteration", (i + param));
        xmlhttp.open("GET", "../additionalFunctions/getProduct.php?q=" + (i+Number(param)), true);
        xmlhttp.send();
    }
    /**********************************************************************************/
    function addProdFunc() {
        var name = document.getElementById("fname").value;
        var price = document.getElementById("fprice").value;
        var type = document.getElementById("ftype").value;
        var sbe = document.getElementById("feye").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../additionalFunctions/addProduct.php?n=" + name + "&p=" + price + "&t=" + type + "&s=" + sbe, true);
        xmlhttp.send();
    }
</script>
</body>
</html>
