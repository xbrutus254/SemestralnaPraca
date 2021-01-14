

function ParseFilter() {

    var r1Checker = document.getElementById("radio1").checked;
    var r2Checker = document.getElementById("radio2").checked;
    var r3Checker = document.getElementById("radio3").checked;
    var r4Checker = document.getElementById("radio4").checked;

    var e1Checker1 = document.getElementById("radio5").checked;
    var e1Checker2 = document.getElementById("radio6").checked;

    var p2Checker1 = document.getElementById("txt1").value;
    var p2Checker2 = document.getElementById("txt2").value;

    //document.getElementById("txtHint").innerHTML = "Len tak22";


    if(p2Checker1 === '') p2Checker1 = 0;
    if(p2Checker2 === '') p2Checker2 = 10000000;

    var error = "";

    //******************************************************************//
    if(p2Checker1 < 0) error = "Price error!";
    if(p2Checker1 > p2Checker2 && p2Checker2 != 0) error = "Price error!";

    if(!e1Checker1 && !e1Checker2) error = "Space bodies can or can't be on the night sky!";

    if(!r1Checker && !r2Checker && !r3Checker && !r4Checker) error = "You need to choose a type of space bodie!";
    //******************************************************************//

    if(r1Checker) r1Checker = 1;
    else r1Checker = 0;
    if(r2Checker) r2Checker = 1;
    else r2Checker = 0;
    if(r3Checker) r3Checker = 1;
    else r3Checker = 0;
    if(r4Checker) r4Checker = 1;
    else r4Checker = 0;

    if(e1Checker1) e1Checker1 = 1;
    else e1Checker1 = 0;
    if(e1Checker2) e1Checker2 = 1;
    else e1Checker2 = 0;

    if (error !== '') {
        document.getElementById("txtHint").innerHTML = error;
    } else {
        document.getElementById("txtHint").innerHTML = "";
        error = "";
        //var i = Number(sessionStorage.getItem("iteration"));
        var swt = 1;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "additionalFunctions/filterProduct.php?r1="
            + r1Checker + "&r2=" + r2Checker + "&r3=" + r3Checker + "&r4=" + r4Checker + "&e1=" + e1Checker1
            + "&e2=" + e1Checker2 + "&p1=" + p2Checker1 + "&p2=" + p2Checker2, true);
        xmlhttp.send();
    }

}

function openNav() {
    document.getElementById("downNav").style.height = "30%";
}

function closeNav() {
    document.getElementById("downNav").style.height = "0%";
}



