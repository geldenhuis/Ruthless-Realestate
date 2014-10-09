<?php
    include('./remoteconnection.php');
    $conn=oci_connect($UName,$PWord,$DB);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['PROPERTY_ID'];
    extract($_POST);
    //echo print_r($_POST);

    switch ($action){

        case "delete":
            $query = "DELETE FROM property WHERE Property_id =".$id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Deleted";
            break;

        case "update":
            $query = "UPDATE PROPERTY SET PROPERTY_STREET= '".$PROPERTY_STREET."' ,PROPERTY_SUBURB='".$PROPERTY_SUBURB."' ,PROPERTY_STATE='".$PROPERTY_STATE."' ,PROPERTY_PC='".$PROPERTY_PC."' ,PROPERTY_TYPE='".$PROPERTY_TYPE."' ,PROPERTY_PRICE='".$PROPERTY_PRICE."' WHERE PROPERTY_ID=".$id;
            echo $query;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "updated";
            break;
    }

?>
