<?php


    function first($text)
    {
        $pieces = explode(" ",$text);
        return $pieces[0] ?? "";
    }
    function last($text)
    {
        $pieces = explode(" ",$text);
        return end($pieces) ?? "";
    }
?>