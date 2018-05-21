<?php

    include_once ('lib/sql.php');
    include_once ('lib/curl_query.php');
    include_once ('lib/html_dom.php');

    libxml_use_internal_errors(true); //hide warnings from web site

    $html = curl_get('https://dailyillini.com/news/'); //Content getting
    $dom = loadDocToParser($html);
    $elem = parseElementsByClass($dom, 'searchheadline');
    //displayElems($dom, $elem);
    //parseDescriptionText('https://dailyillini.com/news/', 'searchheadline');

    $list = parseDescriptionLink($elem);

    //$dare = parseElementsByClass($dom, 'storydate');

    //displayElems($dom, $dare);
    for($list->rewind();$list->valid();$list->next())
    {

        parseDescriptionText($list->current(), 'storycontent');
        parseDescriptionText($list->current(), 'storydate');
        echo "<hr>";
    }
echo "<br/>";

echo "_________2_________";
