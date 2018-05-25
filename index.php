<?php

ini_set("max_execution_time", "1200"); #изменяем максимальное время выполнения скрипта до 1200 секунд
libxml_use_internal_errors(true); //hide warnings from web site


//include_once ('lib/sql.php');
include_once ('lib/curl_query.php');
include_once ('lib/html_dom.php');

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


$html = curl_get('https://dailyillini.com/news/'); //Content getting
$dom = loadDocToParser($html);

$finder = new DomXPath($dom);
$headers = $finder->query("//*[contains(@class, 'searchheadline')]");

for ($i = 0; $i < $headers->length; $i++){

    $link = $headers->item($i)->getElementsByTagName('a')->item(0)->getAttribute('href');
    //var_dump($link);

    $htmlFromLink = curl_get($link);
    $dom_link = loadDocToParser($htmlFromLink);

    $search = new DOMXPath($dom_link);
    $title = $search->query("//*[contains(@class, 'storyheadline')]");
    $description = $search->query("//*[contains(@class, 'storycontent')]");

    $date = $search->query("//*[contains(@class, 'storydate')]");

    $img = $search->query("//*[contains(@class, 'catboxphoto')]")->item(0)->getAttribute('src');
    $img_link = downloadImg($img);

    var_dump($img_link);
    echo "<br>";

    $statement = $conn->prepare("INSERT INTO table_content(header, description, date, img) VALUES (?,?,?,?)");
    $statement->execute(array($title->item(0)->textContent, $description->item(0)->textContent,$date->item(0)->textContent,$img_link));

}