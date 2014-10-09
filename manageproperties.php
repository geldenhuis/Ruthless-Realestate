<?php
    include('./remoteconnection.php');
    $conn=oci_connect($UName,$PWord,$DB);

    extract($_POST);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['PROPERTY_ID'];

    switch ($action){
        case "delete":
            $query = "DELETE FROM property WHERE Property_id =".$id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Deleted";
            break;
        case "update":
            $query = "UPDATE property SET "
            echo "updated";
            break;
        case "add":
            echo "added";
            break;
    }
    //echo print_r($_POST);
?>
