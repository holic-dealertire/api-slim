<?php
/**
 * db config
 * User: holic
 * Date: 2021-08-11
 */

class DB
{
    private $host = 'blackcircles2021.cluster-c2syf7kukikc.ap-northeast-2.rds.amazonaws.com';
    private $user = 'admin';
    private $pass = 'Dealertire0419**';
    private $dbname = 'blackcircles_dev';

    public function connect()
    {
        $conn_str = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
        $conn = new PDO($conn_str, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

}

?>
