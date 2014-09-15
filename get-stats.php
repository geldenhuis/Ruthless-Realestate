<?php

    //Fix for incorrect return type
    header('Content-Type: application/json');

    //Get the stats we need
        /* to be implemented */

    //Create array and return
    $arr = array ('propTotal'=>1,'cusTotal'=>2,'liTotal'=>3,'salTotal'=>4);
    echo json_encode($arr);
?>

