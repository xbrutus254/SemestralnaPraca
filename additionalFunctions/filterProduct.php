<?php

    require_once('../connectionServer/Connection.php');

    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    $sthandlerP = $my_Db_Connection->prepare("SELECT id_product, seenByEye, price, type, name, owner_FK FROM product");

    //$sthandlerP->bind_param("s", $_GET['q']);
    $sthandlerP->execute();
    $resultP = $sthandlerP->fetchAll();

    $nebula = (int)$_GET['r1'];
    $star = (int)$_GET['r2'];
    $comet = (int)$_GET['r3'];
    $moon = (int)$_GET['r4'];

    $yes = (int)$_GET['e1'];
    $no = (int)$_GET['e2'];

    $from = (int)$_GET['p1'];
    $to = (int)$_GET['p2'];


    echo "<table class='table2'>";
        echo "<tr>";
            echo "<th>type</th>";
            echo "<th>name</th>";
            echo "<th>nightsky</th>";
            echo "<th>price</th>";
        echo "</tr>";



    foreach ($resultP as $row) {
        echo "<tr>";
            $id = $row['id_product'];

            //********************************//
            $seenbyeye = $row['seenByEye'];
            if ($yes == 0 && $seenbyeye == 1) continue;
            if ($no == 0 && $seenbyeye == 0) continue;
            //---------------------/
            $price = $row['price'];
            if ($from != 0 || $to != 0) {
                if ($from > $price) continue;
                if ($to < $price) continue;
            }
            //---------------------/
            $type = $row['type'];
            if ($type == "star" && $star == 0) continue;
            if ($type == "nebula" && $nebula == 0) continue;
            if ($type == "comet" && $comet == 0) continue;
            if ($type == "moon" && $moon == 0) continue;
            //********************************//
            echo "<td>" . $type . "</td>";
            $name = $row['name'];
            $id_uzivatel = $row['owner_FK'];
            echo "<td>" . $name . "</td>";
            if ($seenbyeye == 1)
                echo "<td> yes </td>";
            else
                echo "<td> no </td>";
            echo "<td>" . $price . "€" . "</td>";
            //echo $iter + " === " + $i;
            //if ($iter == $i) break;
            //$i++;
        echo "</tr>";
    }
    echo "</table>";
