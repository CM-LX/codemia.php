<?php
    function diaSemana($dias) {
    $semana = ['', 'domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];
    $i = 10000000;
    $aulas = '';
    while($i >= 1) {
        $aula = floor($dias / $i);
        $aulas .= $aula ? $semana[$aula] . ', ' : '';
        $dias = $dias - $aula * $i;
        $i = $i / 10;
    }
    // retirar última vírgula
    $aulas = substr($aulas, 0, -2);
    // substituir penúltima vírgula por " e " 
    $ultimaVirgula = strrpos($aulas, ', ');
    if($ultimaVirgula) {
        $aulas = substr($aulas, 0, $ultimaVirgula) . ' e ' . substr($aulas, $ultimaVirgula + 2 );
    }    
    $aulas = ucfirst($aulas);
    return $aulas;
    }
?>