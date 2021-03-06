<?php


class Connection
{
    private $host   = 'localhost';
    private $user   = 'root';
    private $dbname = 'datausers';
    private $pass   = 'dtb456';

    private $dbh;
    private $error;

    public function __construct(){

        $dsn = 'mysql: host=' . $this->host . ';dbname=' . $this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT            => true,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES UTF8'
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
            // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
            exit;
        }
    }

    public function getDBH() {
        return $this->dbh;
    }
}