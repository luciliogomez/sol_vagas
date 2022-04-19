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
    // traduz o estado da aplicacao
    function translate_estado($estado)
    {
        switch($estado)
        {
            case '0': return "Desempregado";
            case '1': return "Trabalhando";
            default: return '';
        }
    }
?>