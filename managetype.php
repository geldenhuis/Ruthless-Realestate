<?php
    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $_REQUEST["action"] ) {
        case "add":
            echo "Adding";
            break;
        case "delete":
            echo "deleted";
            break;
    }
?>
