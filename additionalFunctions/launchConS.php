<?php
    require_once('../connectionServer/Connection.php');

    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    $parameter =  $_GET['q'];

    if($parameter == 1) {

        $name =  $_GET['name'];
        $time =  (int)$_GET['time'];
        $launchdate =  $_GET['ld'];
        $destination =  $_GET['dest'];
        $user = $_GET['user'];

        $money = 0;
        $id = 0;
        $echo = "";

        //echo $name . " + " . $time . " + " . $launchdate . " + " . $destination . " + " . $user;

        $sthandler = $my_Db_Connection->prepare("SELECT id, money FROM appusers WHERE username = :name");
        $sthandler->bindParam(':name', $user);
        $sthandler->execute();
        $row = $sthandler->fetch();
        if($sthandler->rowCount() > 0) {
            $id = $row['id'];
            $money = (int)$row['money'];
        } else {
            $echo = "User not found!";
            echo  $echo;
            exit;
        }

        if($money < 25000) {
            $echo = "Not enough money!";
            echo  $echo;
            exit;
        }

        $sthandler = $my_Db_Connection->prepare("SELECT rocket_name FROM rocket WHERE rocket_name = :name");
        $sthandler->bindParam(':name', $name);
        $sthandler->execute();
        if($sthandler->rowCount() > 0) {
            $echo = "Name of rocket is already taken!";
        } else {
            $data = array($name, $time, $launchdate, $destination, $id);
            $insert_Statement = $my_Db_Connection->prepare("INSERT INTO rocket (rocket_name, launch_time, launch_date, final_dest, launch_visitor_FK) VALUES (?, ?, ?, ?, ?)");
            if (!$insert_Statement->execute($data)) {
                echo "Unable to create record";
            } else {
                $money -= 25000;
                $sthandler = $my_Db_Connection->prepare("UPDATE appusers SET money = :money WHERE username = :name");
                $sthandler->bindParam(":money", $money);
                $sthandler->bindParam(":name", $user);
                $sthandler->execute();
                $echo = "Record created successfully!";
                echo  $echo;
                exit;
            }
        }
    }
    else if ($parameter == 2) {
        $sthandler = $my_Db_Connection->prepare("SELECT rocket_name, launch_time, launch_date, final_dest, launch_visitor_FK FROM rocket");
        $sthandler->execute();
        $resultP = $sthandler->fetchAll();

    echo "<table class='table9'>";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Days in space</th>";
            echo "<th>Destination</th>";
            echo "<th>Owner</th>";
            echo "<th>Launch date</th>";
        echo "</tr>";



    foreach ($resultP as $row) {
        echo "<tr>";
        $name = $row['rocket_name'];
        $time = $row['launch_time'];
        $space = $row['launch_date'];
        $dest = $row['final_dest'];
        $visitor = (int)$row['launch_visitor_FK'];

        $sthandlerV = $my_Db_Connection->prepare("SELECT username FROM appusers WHERE id = :id");
        $sthandlerV->bindParam(':id', $visitor );
        $sthandlerV->execute();
        $row = $sthandlerV->fetch();
        if($sthandlerV->rowCount() > 0) {
            $ownerusername = $row['username'];
        }

        echo "<td>" . $name . "</td>";
        echo "<td>" . $time . "</td>";
        echo "<td>" . $dest . "</td>";
        echo "<td>" . $ownerusername . "</td>";
        echo "<td>" . $space . "</td>";
        echo "</tr>";
    }
        echo "</table>";
    }