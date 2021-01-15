<?php

require_once('../connectionServer/Connection.php');

$my_Db      = new Connection();
$my_Db_Connection = $my_Db->getDBH();

    if (isset($_GET['buyQ'])) {
        $iter = (int)$_GET['q'];
        $user = $_GET['usr'];
        //echo $iter . " + " . $user;

        $sthandler = $my_Db_Connection->prepare("SELECT id, money FROM appusers WHERE username = :name");
        $sthandler->bindParam(':name', $user);
        $sthandler->execute();
        $row = $sthandler->fetch();
        if($sthandler->rowCount() > 0) {
            $id = $row['id'];
            $money = (int)$row['money'];
        }

        $i = 0;
        $sthandlerD = $my_Db_Connection->prepare("SELECT name, id_product, price, owner_FK FROM product ");
        $sthandlerD->execute();
        $resultD = $sthandlerD->fetchAll();
        foreach ($resultD as $row) {
            $price = $row['price'];
            $id_prod = $row['id_product'];
            $prod_name = $row['name'];
            $last_owner_FK = $row['owner_FK'];
            if ($iter == $i) break;
            $i++;
        }

        if($money < $price) echo "Not enough money";
        //else echo $money . " > " . $price;
        else if($last_owner_FK == $id) {
            echo "You already own this bodie!";
        }
        else {
            $sthandler = $my_Db_Connection->prepare("UPDATE product SET owner_FK = :id WHERE id_product = :PKid");
            $sthandler->bindParam(":id", $id);
            $sthandler->bindParam(":PKid", $id_prod);
            $sthandler->execute();

            $sthandler = $my_Db_Connection->prepare("UPDATE appusers SET money = :money WHERE username = :name");
            $i = $money - $price;
            $sthandler->bindParam(":money", $i);
            $sthandler->bindParam(":name", $user);
            $sthandler->execute();

            echo "You bought " . $prod_name . " for " . $price . "€!";
        }


    } else {

        $sthandlerP = $my_Db_Connection->prepare("SELECT id_product, seenByEye, price, type, name, owner_FK FROM product");

        //$sthandlerP->bind_param("s", $_GET['q']);
        $sthandlerP->execute();
        $resultP = $sthandlerP->fetchAll();
        $iter = (int)$_GET['q'];

        if ($iter <= 0) {
            $iter = 0;

        } elseif ($resultP <= $iter) {
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

        if (isset($_GET['s'])) {
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
        } else {

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
    }
