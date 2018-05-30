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

    $htmlFromLink = curl_get($link);
    $dom_link = loadDocToParser($htmlFromLink);

    $search = new DOMXPath($dom_link);
    $title = $search->query("//*[contains(@class, 'storyheadline')]");

    $description_parent = $search->query("//*[contains(@class, 'storycontent')]");


    $date = $search->query("//*[contains(@class, 'storydate')]"); // parse the date grom html

    $img = $search->query("//*[contains(@class, 'catboxphoto')]");

    $img_link = downloadImg($img->item(0)->getAttribute('src'));

    $p_counter = 0;
    $description_txt = "";
    while ($p_counter < $description_parent->length){
        $description_parent->item($p_counter)->getElementsByTagName('a')->item(0)->textContent;
        $c = 0;
        $description = $description_parent->item($p_counter)->getElementsByTagName('p');
        while ($c < $description->length){
            $anchors = $description->item($c)->getElementsByTagName('a');

            $description_txt .= "<p>".$description->item($c)->textContent."</p>";
            if ($anchors->length != 0){
                for ($a = 0; $a < $anchors->length; $a++) {

                    $href = $anchors->item($a)->getAttribute('href');
                    $text = $anchors->item($a)->textContent;
                    $position = strpos($description->item($c)->textContent, $anchors->item($a)->textContent);
                    $pos[] = $position;
                    $src[] = $href;
                    $href_txt[] = $text;
                    $p[] = $c+1;

                }
            }
            $c++;
        }
        $p_counter++;
    }

   /*showParseElements($dom_link, $title);
    showParseElements($dom_link, $date);
    showParseElements($dom_link, $img);
    showParseElements($dom_link, $description);*/

    $header = $title->item(0)->textContent;

    $statement = $connection->prepare("INSERT INTO table_content(title, description, date, img) VALUES (?,?,?,?)");
    $statement->execute(array($header, $description_txt, $date->item(0)->textContent, $img_link));

    // LINKS FOR DESCRIPTION INSERTION
    for ($el = 0; $el < count($src); $el++){
        $content_id = $connection->prepare("SELECT id from table_content WHERE title ='$header'");
        $content_id->execute();

        $statem = $connection->prepare("INSERT INTO description_anchors(id_content, src, text, p_number, position) VALUES (?,?,?,?,?)");
        while ($id = $content_id->fetch(PDO::FETCH_OBJ)){
            $statem->execute(array($id->id, $src[$el], $href_txt[$el] ,$p[$el],$pos[$el]));
        }

    }
    //echo "<hr><br>";
    $pos = null;
    $src = null;
    $p = null;
    $href_txt = null;
}
?>

<a href="index.php">Back to home</a>

<?php include_once "templates/footer.php";?>