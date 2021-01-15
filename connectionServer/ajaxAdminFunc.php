<?php

    require_once('Connection.php');
    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    $name =  (string)$_GET['n'];
    $amount =  (int)$_GET['p'];
    $money = 0;

    $sthandler = $my_Db_Connection->prepare("SELECT money FROM appusers WHERE username = :name");
    $sthandler->bindParam(':name', $name);
    $sthandler->execute();
    $row = $sthandler->fetch();
    if($sthandler->rowCount() > 0) {
        $money = (int)$row['money'];
    }

    $sthandler = $my_Db_Connection->prepare("UPDATE appusers SET money = :money WHERE username = :name");
    $i = $amount + $money;
    $sthandler->bindParam(":money", $i);
    $sthandler->bindParam(":name", $name);
    $sthandler->execute();
?>
