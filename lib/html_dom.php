<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.05.18
 * Time: 10:00
 */

//Load HTML
function loadDocToParser($html){
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    return $dom;
}

//Downloading image
function downloadImg($imgLink){
    $url= $imgLink; //"https://dailyillini.com/wp-content/uploads/2018/05/Illini-4000-photo-475x459.jpg"
    $name = "storage/".basename($url);
    copy($url, $name);
    return $name; // Returm link
}

function showParseElements($dom, $elems){
    foreach ($elems as $elem){
        echo $dom->saveXML($elem)."<br>";
        break;
    }
}