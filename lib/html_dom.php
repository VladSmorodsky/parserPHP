<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.05.18
 * Time: 10:00
 */
function loadDocToParser($html){
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    return $dom;
}

function parseElementsByClass($dom, $className){
    $xpath = new DomXPath($dom);
    $class = $className;
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");
    return $elements;
}

function parseDescriptionLink($elem){
    $list = new SplDoublyLinkedList();
    foreach($elem as $container) {
        $arr = $container->getElementsByTagName("a");
        foreach($arr as $item) {
            $href =  $item->getAttribute("href");
            $list->push($href);
        }
    }
    return $list;
}

function parseDescriptionText($link, $className){
    $r = curl_get($link);
    $d = loadDocToParser($r);
    $t = parseElementsByClass($d, $className);
    displayElems($d, $t); //Delete this string after finish example
}

/*DISPLAY ONLY*/

function displayElems($dom, $elem){
    foreach($elem as $div) {
        echo $dom->saveXML($div).'<br>';
    }
}