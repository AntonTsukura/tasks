<?php
include 'server.settings.php';

trait dbh {
    use server_settings;
    
    protected function connect_db(){
        $this->get_server_settings();    
        try{
            $dbhname = $this->dbhname;
            $dbhhost = $this->dbhhost;
            $dbhuser = $this->dbhuser;
            $dbhpass = $this->dbhpass;
            $dbh = new PDO("mysql:host=$dbhhost;dbname=$dbhname;charset=utf8", $dbhuser, $dbhpass);
            return $dbh;
        } catch (PDOException $e) {
            echo "<br>Error conecting with database.<br>";
            die();
        }
    }

}