<?php

class MyPDO
{
    private $PDOInstance = null;
    private static $instance = null;
    private $host, $user, $pass, $database;
    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "evth9784_assoup";
        $this->pass = '3X@ZwyJcoxja';
        $this->database = "evth9784_assoup";
        try {
            $this->PDOInstance = new PDO('mysql:dbname=' . $this->database . ';host=' . $this->host, $this->user, $this->pass);
            $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MyPDO();
        }
        return self::$instance;
    }
    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }
    public function prepare($query = '')
    {
        return $this->PDOInstance->prepare($query);
    }
}