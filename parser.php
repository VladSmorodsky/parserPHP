<?php include_once "templates/header.php"; ?>


<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.05.18
 * Time: 9:35
 */
ini_set("max_execution_time", "1200"); #изменяем максимальное время выполнения скрипта до 1200 секунд
libxml_use_internal_errors(true); //hide warnings from web site


//require_once ('lib/sql.php');
include_once ('lib/curl_query.php');
include_once ('lib/html_dom.php');
require_once ("lib/sql.php");



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

    $description_parent = $search->query("//*[contains(@class, 'storycontent')]");
    $p_counter = 0;
    while ($p_counter < $description_parent->length){
        $c = 0;
        $description_txt = "";
        $description = $description_parent->item($p_counter)->getElementsByTagName('p');

        while ($c < $description->length){
            $description_txt .= $description->item($c)->textContent;
            $c++;
        }

        $p_counter++;

    }


    $date = $search->query("//*[contains(@class, 'storydate')]");

    $img = $search->query("//*[contains(@class, 'catboxphoto')]");
    $img_link = downloadImg($img->item(0)->getAttribute('src'));


    /*showParseElements($dom_link, $title);
    showParseElements($dom_link, $date);
    showParseElements($dom_link, $img);
    showParseElements($dom_link, $description);*/

    echo "<hr><br>";

    $statement = $connection->prepare("INSERT INTO table_content(header, description, date, img) VALUES (?,?,?,?)");
    $statement->execute(array($title->item(0)->textContent, $description_txt,$date->item(0)->textContent, $img_link));

}
?>

<a href="index.php">Back to home</a>

<?php include_once "templates/footer.php"; ?>