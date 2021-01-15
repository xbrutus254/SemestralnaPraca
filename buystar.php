<?php
session_start();
require_once('connectionServer/Connection.php');

$my_Db      = new Connection();
$my_Db_Connection = $my_Db->getDBH();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../LoginPage.php");
    exit;
}
$sthandlerP = $my_Db_Connection->prepare("SELECT id_product FROM product");
$sthandlerP->execute();
$count = $sthandlerP->rowCount();

$_SESSION["iteration"] = 0;
?>
<script>window.onload = function() {
        showAllBodies();
    };</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OuterSpace</title>
    <link rel="icon" href="dataImages/icon.png">
    <script type="text/javascript" src="additionalFunctions/listProducts.js"></script>
    <script type="text/javascript" src="additionalFunctions/shopJSf.js"></script>

    <link rel="stylesheet" href="additionalFunctions/stylesheet.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.html">Interesting Space</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="OurSolarSys.php">Our Solar System <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Satellites.html">Satellites</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="buystar.php">Buy Star</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <?php
                if ($_SESSION["name"] !== "admin") {
                    echo "<a class='nav-link' href='connectionServer/welcomeLogin.php'>" . $_SESSION["name"] . "</a>";
                } else {
                    echo "<a class='nav-link' href='connectionServer/welcomeLoginAdm.php'>" . $_SESSION["name"] . "</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>


<div id="downNav" class="overlay">

    <div class="overlay-content">
        <a href="javascript:void(0)" onclick="showFlights()"><i class="fa fa-fw fa-rocket"></i>Show Flights</a>
        <a href="javascript:void(0)" onclick="addFlights()"><i class="fa fa-fw fa-rocket"></i>Add Flights</a>
        <a href="javascript:void(0)" onclick="showAllBodies()"><i class="fa fa-fw fa-ravelry"></i> All Bodies</a>
        <a href="javascript:void(0)" onclick="showFilterBodies()"><i class="fa fa-fw fa-ravelry"></i> Filter Bodies</a>

    </div>
    <a href="#" class="closebtn" onclick="closeNav()">&#x27F0;</a>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-1" id="leftBtn">
            <button type="button" id="btnleft" class="btn btn-outline-warning">&#8624;</button>
        </div>
        <div class="col-sm-10">

            <div class="opener">
                <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#x27F1; open</span>
            </div>
            <div class="transparent-box">

                <div class="table9" id="flightsList">
                    <h3><p id="txtHint0"></p></h3>
                </div>

                <div class="table3" id="addList"  style="display: none">
                    <div>
                        <h5><label for="fname">Name of rocket:</label>
                            <input type="text" id="frocketname" class="form-control" placeholder="name"></h5>
                    </div>
                    <div>
                        <h5><label for="fname">Time in space:</label>
                            <input type="text" id="ftime" class="form-control" placeholder="in days"></h5>
                    </div>
                    <div>
                        <h5><label for="ftype">Set date of launch:</label>
                            <input type="date" class="form-control" id="launchdate" name="launchtimedate"></h5>
                    </div>
                    <div>
                        <h5><label for="fdest">Set destination:</label>
                            <input type="text" id="fdest" class="form-control" placeholder="destination"></h5>
                    </div>
                    <div>
                        <h4><button class="sbmbutton" onclick="createRocketFunc('<?=$_SESSION["name"] ?>')">Submit</button></h4>

                    </div>
                    <div><p id="txtHint2">Total cost of rocket, you want to create: 25000€</p></div>

                </div>

                <div id="filterProductsList" style="display: none">

                    <div class="col">
                        <h5><label for="fprice">What type you want?</label></h5>
                        <div class="form-check">
                            <label class="form-check-label" for="radio1">
                                <input type="checkbox" id="radio1" class="form-check-input" value=""  checked="checked">Nebula
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio2">
                                <input type="checkbox" id="radio2" class="form-check-input" value=""  checked="checked">Star
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio3">
                                <input type="checkbox" id="radio3" class="form-check-input" value=""  checked="checked">Comet
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio4">
                                <input type="checkbox" id="radio4" class="form-check-input" value=""  checked="checked">Moon
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <h5><label for="fprice">Is on the night sky?</label></h5>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="radio5" class="form-check-input" value=""  checked="checked"">yes
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="radio6" class="form-check-input" value=""  checked="checked">no
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <form class="form-inline">
                            <h5><label for="fprice">Price:
                                <input type="text" id="txt1" class="form-control" placeholder="From">
                                <input type="text" id="txt2" class="form-control" placeholder="To">
                            </label></h5>
                        </form>
                        <input type="submit" id="f1" value="Filter" onclick="ParseFilter()">
                    </div>
                </div>
                <div id="idTableMain">
                    <h3><p id="txtHint"></p>
                        <style>
                            button {
                                right: 50%;
                                width: 100%;
                            }
                        </style>
                        <button type="button" id="buybutton" class="btn btn-danger" onclick="buyBodie('<?=$_SESSION["name"] ?>')">Buy</button>
                    </h3>

                </div>

            </div>

        </div>
        <div class="col-sm-1" id="rightBtn">
            <button type="button" id="btnright" class="btn btn-outline-warning">&#8625;</button>
        </div>
    </div>
</div>


<script>
    function showFlights() {
        document.getElementById("buybutton").style.display = "none";
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("flightsList").style.display = "initial";
        document.getElementById("addList").style.display = "none";
        document.getElementById("filterProductsList").style.display = "none";
        document.getElementById("btnleft").style.display = "none";
        document.getElementById("btnright").style.display = "none";
        showAllFlightsJS();
        closeNav();
    }

    function addFlights() {
        document.getElementById("buybutton").style.display = "none";
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint0").innerHTML = "";
        document.getElementById("flightsList").style.display = "none";
        document.getElementById("addList").style.display = "initial";
        document.getElementById("filterProductsList").style.display = "none";
        document.getElementById("btnleft").style.display = "none";
        document.getElementById("btnright").style.display = "none";
        closeNav();
    }

    function showAllBodies() {
        document.getElementById("buybutton").style.display = "initial";
        document.getElementById("txtHint0").innerHTML = "";
        document.getElementById("addList").style.display = "none";
        document.getElementById("btnleft").style.display = "initial";
        document.getElementById("btnright").style.display = "initial";
        document.getElementById("filterProductsList").style.display = "none";
        document.getElementById("idTableMain").style.display = "initial";
        funcClick(0);
        closeNav();
    }

    function showFilterBodies() {
        document.getElementById("buybutton").style.display = "none";
        document.getElementById("flightsList").style.display = "none";
        document.getElementById("addList").style.display = "none";
        document.getElementById("filterProductsList").style.display = "initial";
        document.getElementById("btnleft").style.display = "none";
        document.getElementById("btnright").style.display = "none";
        ParseFilter()
        closeNav();
    }
    //********************************************************************************//
    // AJAX
    document.getElementById("btnleft").addEventListener("click", function(){
        funcClick(-1);
    }, false);
    document.getElementById("btnright").addEventListener("click", function(){
        funcClick(1);
    }, false);

    function funcClick(param) {
        var i = Number(sessionStorage.getItem("iteration"));
        var swt = 1;
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
        xmlhttp.open("GET", "additionalFunctions/getProduct.php?q=" + (i+Number(param)) + "&s=" + swt, true);
        xmlhttp.send();
        //********************************************************************************//
    }
</script>

<script src="additionalFunctions/listProducts.js"></script>
</body>
</html>