<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.05.18
 * Time: 9:59
 */
$servername = "localhost";
$username = "root";
$password = "storm1382";
$db_name = "parserphp";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }


$statement = $conn->prepare("INSERT INTO test_content(id, header, description, date, img) VALUES(?,?,?,?,?)");
$statement->execute([5, "TRTRTR", "fdsfdasfsdfadsf", 12/12/2018, "storage/blotter-filter-900x900,phg"]);





