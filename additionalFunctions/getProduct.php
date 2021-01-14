<?php
//require "../connectionServer/Connection.php";
//require "../connectionServer/Connection.php";
require_once('../connectionServer/Connection.php');

$my_Db      = new Connection();
$my_Db_Connection = $my_Db->getDBH();

    $sthandlerP = $my_Db_Connection->prepare("SELECT id_product, seenByEye, price, type, name, owner_FK FROM product");

    //$sthandlerP->bind_param("s", $_GET['q']);
    $sthandlerP->execute();
    $resultP = $sthandlerP->fetchAll();
    $iter = (int)$_GET['q'];

    if ($iter <= 0) {
        $iter = 0;

    }
    elseif ($resultP <= $iter) {
        $iter = $resultP;
    }

    $i = 0;
    $id = 0;

    foreach ($resultP as $row) {
        $id = $row['id_product'];
        $seenbyeye = $row['seenByEye'];
        $price = $row['price'];
        $type = $row['type'];
        $name = $row['name'];
        $id_uzivatel = $row['owner_FK'];
        //echo $iter + " === " + $i;
        if ($iter == $i) break;
        $i++;
    }

    if ((int)$seenbyeye == 1) $seenbyeye = "yes";
    else $seenbyeye = "no";

    if(isset($_GET['s'])) {
        echo "<table class='table1'>";
        echo "<tr>";
        echo "<th>type: </th>";
        echo "<td>" . $type . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "</tr>";
        echo "<th>name: </th>";
        echo "<td>" . $name . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>seen in nightsky</th>";
        echo "<td>" . $seenbyeye . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>price: </th>";
        echo "<td>" . $price . "€" . "</td>";
        echo "</tr>";
        echo "</table>";
    }
    else {

        echo "<table class='table1'>";
        echo "<tr>";
        echo "<th>CustomerID</th>";
        echo "<td>" . $id . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "</tr>";
        echo "<th>ProductName</th>";
        echo "<td>" . $name . "</td>";
        echo "</tr>";


        $sthandler = $my_Db_Connection->prepare("SELECT username FROM appusers WHERE id = :id");
        $sthandler->bindParam(':id', $id_uzivatel);
        $sthandler->execute();
        $row = $sthandler->fetch();

        echo "<tr>";
        echo "<th>ProductOwner</th>";
        echo "<td>" . $row["username"] . "</td>";
        echo "</tr>";
        echo "</table>";
    }
