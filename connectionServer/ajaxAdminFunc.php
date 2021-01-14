<?php

    require_once('Connection.php');
    $my_Db      = new Connection();
    $my_Db_Connection = $my_Db->getDBH();

    $name =  (string)$_GET['n'];
    $amount =  (int)$_GET['p'];

    $sthandler = $my_Db_Connection->prepare("UPDATE appusers SET money = :money WHERE username = :name");
    $sthandler->bindParam(":money", $amount);
    $sthandler->bindParam(":name", $name);
    $sthandler->execute();
?>
