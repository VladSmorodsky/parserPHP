<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 19.05.18
 * Time: 9:59
 */

function curl_get($url){

    $ch = curl_init($url); //Save curl in variable

    /*Set options for curl*/

    curl_setopt($ch, CURLOPT_HEADER, 0); //No headers, does`t metter now
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Execution curl_exec() returns all html from server into variable
    $data = curl_exec($ch); //Query execute
    curl_close($ch); //Close connection. It is not optimal idea. Must keeping alive

    return $data;

}