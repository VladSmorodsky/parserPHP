<?php

ini_set("max_execution_time", "1200"); #изменяем максимальное время выполнения скрипта до 1200 секунд
libxml_use_internal_errors(true); //hide warnings from web site


include_once ('lib/sql.php');
include_once ('lib/curl_query.php');
include_once ('lib/html_dom.php');


$html = curl_get('https://dailyillini.com/news/'); //Content getting
$dom = loadDocToParser($html);
//var_dump($dom);
$elem = parseElementsByClass($dom, 'searchheadline');

//TYPE TESTING

/*var_dump($elem);
echo "<hr>";*/
$list = parseDescriptionLink($elem); //get anchor
/*var_dump($list);
echo "<hr>";*/
$arrList = getSplToArray($list);
/*var_dump($arrList);
echo "<hr>";*/
$l = curl_get($arrList[0]);
/*var_dump($l);
echo "<hr>";*/
$d = loadDocToParser($l);
/*var_dump($d);
echo "<hr>";*/
$el_title = parseElementsByClass($d, 'storyheadline');
/*var_dump($el_title);
echo "<hr>";*/
displayElems($d, $el_title);
$el_date = parseElementsByClass($d, 'storydate');
displayElems($d, $el_date);
$el_img = parseElementsByClass($d, 'catboxphoto feature-image');
var_dump($el_img);

displayElems($d, $el_img);
//$img_tag = loadDocToParser($l);
//var_dump($img_tag);
$img_xpath = new DOMXPath($d);

$img_link = $img_xpath->query('//img[@class="catboxphoto feature-image"]')->item(0)->getAttribute('src');
//$img_link = $img_xpath->evaluate("string(//img/@src)");
//$img_link = parseElements($d, 'src', 'catboxphoto feature-image');
//var_dump($img_link);
downloadImg($img_link);
$el_description = parseElementsByClass($d, 'storycontent');
displayElems($d, $el_description);