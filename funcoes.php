<?php

    // Função que recebe data no foramto Y-m-d e inverte para d/m/y
    function inverte_data($data) {
        $data = strtotime($data);
        $timestamp = ($data);
        return date('d/m/Y',$timestamp);
    };

    function primeiro_nome($texto)    {
        $nomes = explode(' ',$texto);
        $nome = strtolower($nomes[0]);
        return ucfirst($nome);
    };

    


 ?>
