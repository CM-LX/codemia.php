<?php
    $res = json_encode(array_slice(scandir('.'), 2)); // elimina . e .. da lista
    echo $res;

//    $res2 = json_encode($res);
//    echo $res2;
?>