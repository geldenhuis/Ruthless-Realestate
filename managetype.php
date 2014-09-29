<?php
    include('./remoteconnection.php');


    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $action ) {
        case "add":
            echo "Adding";
            break;
        case "delete":
            $query =
            echo "Deleted";
            break;
    }
?>
