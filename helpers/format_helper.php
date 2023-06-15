<?php
// date formatting
function date_formatting($date){
    return date('F j, Y, g:i a',strtotime($date));
}
// shorten text
function shorten_text($text,$chars=450){
    $text=$text.' ';
    $text=substr($text,0,$chars);
    $text=substr($text,0,strrpos($text,' '));
    $text=$text.'...';
    return $text;
}