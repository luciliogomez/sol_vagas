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
    function trnslt_estado_vaga($estado)
    { 
        switch($estado)
        {
            case '0': return "Fechada";
            case '1': return "Aberta";
            default: return 'no';
        }
    }

    function uploaded_foto()
    {
        return (isset($_FILES['foto']) && $_FILES['foto']['name']!=null);
    }
    function is_valid_foto()
    {
        $allowed_types = ['image/jpeg','image/jpg','image/png','image/gif'];
        $uploaded_type = $_FILES['foto']['type'];
        return in_array($uploaded_type,$allowed_types);
    }

    function get_uploaded_foto()
    {
        $file = $_FILES['foto']['tmp_name'];
        $new_name = uniqid("sv"). date("His");
        if(move_uploaded_file($file,UPLOADS."/".$new_name)){
            return $new_name;
        }
        return null;
    }

    function uploaded_file($filename)
    {
        return (isset($_FILES[$filename]) && $_FILES[$filename]['name']!=null);
    }

    function is_valid_file($filename)
    {
        $allowed_types = ['application/pdf'];
        $uploaded_type = $_FILES[$filename]['type'];
        return in_array($uploaded_type,$allowed_types);
    }
    function get_uploaded_file($filename)
    {
        $file = $_FILES[$filename]['tmp_name'];
        $new_name = uniqid("sv"). date("His");
        if(move_uploaded_file($file,UPLOADS."/".$new_name)){
            return $new_name;
        }
        return null;
    }

?>