

    function createRocketFunc(user) {

        var error = "";
        var name = document.getElementById("frocketname").value;
        var time = document.getElementById("ftime").value;
        var launchdate = document.getElementById("launchdate").value;
        var destin = document.getElementById("fdest").value;

        if (!isNumeric(time)) error = "Bad format of a time!";
        if (time <= 0) error = "Time must be positive value!";
        if(name.length < 4) error = "Rocket name is too short!";
        if(name.length > 35) error = "Rocket name is too long!";

        if(name == "" || time == "" || launchdate == "" || destin == "") error = "Fill table!"

        var arr1 = launchdate.split('-');
        var year = arr1[0];
        var moon = arr1[1];
        var day = arr1[2];

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        if(year < yyyy) {
            error = "Year can not be less then actual!"
        } else if (year == yyyy) {
            if (moon < mm) {
                error = "Moon can not be less then actual!"
            } else  if (moon == mm) {
                if (day <= dd) {
                    error = "Day can not be less or equal then/to actual!"
                }
            }
        }

        if (error == "") {
            var parameter = 1;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint2").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "additionalFunctions/launchConS.php?q="
                + parameter + "&name=" + name + "&time=" + time + "&ld=" + launchdate + "&dest="
                + destin + "&user=" + user, true);
            xmlhttp.send();
        } else {
            document.getElementById("txtHint2").innerHTML = error;
        }


    }

    function isNumeric(value) {
        return /^\d+$/.test(value);
    }

    function showAllFlightsJS() {
        var parameter = 2;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint0").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "additionalFunctions/launchConS.php?q="
            + parameter, true);
        xmlhttp.send();
    }