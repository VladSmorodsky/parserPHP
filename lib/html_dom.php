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


//Optimal
function parseElements($dom, $attr ,$className){
    $xpath = new DomXPath($dom);
    $class = $className;
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@".$attr."), ' '), ' $class ')]");
    return $elements;
}

function getSplToArray($splList){
    $listArr = array();
    foreach ($splList as $k => $v){
        $v = trim($v, '"');
        $listArr[$k] = $v;
    }
    return $listArr;
}

function parseImgLink($patent_tag){
    $list = new SplDoublyLinkedList();
    foreach($patent_tag as $container) {
        $arr = $container->getElementsByTagName("img");
        foreach($arr as $item) {
            $href =  $item->getAttribute("src");
            $list->push($href);
        }
    }
    return getSplToArray($list);
}


function parseDescriptionLink($patent_tag){
    $list = new SplDoublyLinkedList();
    foreach($patent_tag as $container) {
        $arr = $container->getElementsByTagName("a");
        foreach($arr as $item) {
            $href =  $item->getAttribute("href");
            $list->push($href);
        }
    }
    return $list;
}

//Parse main description text
function parseDescriptionText($link, $className){
    $r = curl_get($link);
    $d = loadDocToParser($r);
    $t = parseElementsByClass($d, $className);
    return displayElems($d, $t); //Delete this string after finish example
    //return $d;
    //return $t;

}


//Downloading image
function downloadImg($imgLink){
    //$img =  parseElementsByClass($dom, $imgLink);//parseDescriptionText($list->current(), 'catboxphoto feature-image');
    $url= $imgLink; //"https://dailyillini.com/wp-content/uploads/2018/05/Illini-4000-photo-475x459.jpg"
    $name = "storage/".basename($url);
    copy($url, $name);
}


//Display resilt
function displayElems($dom, $elem){
    foreach($elem as $div) {
        //$dom->saveXML($div);
        echo $dom->saveXML($div).'<br>';
    }
    //return $dom;
}