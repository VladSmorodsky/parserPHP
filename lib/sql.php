<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.05.18
 * Time: 9:59
 */
require_once "config.php";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}





