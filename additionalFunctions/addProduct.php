    <?php
    require_once('../connectionServer/Connection.php');

    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    $name =  $_GET['n'];
    $price =  $_GET['p'];
    $type =  $_GET['t'];
    $seenbyeye =  $_GET['s'];
    $owner = 1;
    $echo = "";

    $sthandler = $my_Db_Connection->prepare("SELECT name FROM product WHERE name = :name");
    $sthandler->bindParam(':name', $name);
    $sthandler->execute();
    if($sthandler->rowCount() > 0) {
        $echo = "This name of product is already taken!";
    }
    // Validate password
    if(!is_numeric($price) || !isset($price) || $price <= 0 || 999999999 < $price) {
        $echo = "Error in price bar!";
    }
    if($type === "nebula" && $seenbyeye === "1") {
        $echo = "There is no nebula visible by eye in the night sky!";
    }

    if ($echo === "") {
        $userdata = array($seenbyeye, $price, $type, $name, $owner);
        $insert_Statement = $my_Db_Connection->prepare("INSERT INTO product (seenByEye, price, type, name, owner_FK) VALUES (?, ?, ?, ?, ?)");
        if (!$insert_Statement->execute($userdata)) {
            echo "Unable to create record";
        } else {
            $echo = "Record created successfully!";
        }
    }


    echo "<table>";
    echo "<tr>";
    echo "<th>Message: </th>";
    echo "<td>" . $echo . "</td>";