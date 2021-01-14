<?php

require_once('Connection.php');
$my_Db      = new Connection();
$my_Db_Connection = $my_Db->getDBH();

function deleteUser($name, $my_Db_Connection)
{
    echo $name;
    $sthandler = $my_Db_Connection->prepare("SELECT appusers FROM uzivatel WHERE username = :name");
    $sthandler->bindParam(':name', $name);
    $sthandler->execute();
    if($sthandler->rowCount() > 0)
    {
        $sthandler = $my_Db_Connection->prepare("DELETE FROM appusers WHERE username = :name");
        $sthandler->bindParam(':name', $name);
        $sthandler->execute();
        header("location: welcomeLoginAdm.php");
        exit;
    }
}

if (!empty($_GET['fn'])) {
    if ($_GET['fn'] == "deleteUser")
    {
        if (!empty($_GET['param']))
        {
            if ($_GET['param'] == "admin") {
                echo "admin can not be removed!";
            } else {
                deleteUser($_GET['param'], $my_Db_Connection);
            }
        }
    }
}




