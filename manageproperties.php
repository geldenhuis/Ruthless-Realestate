<?php
    include('./remoteconnection.php');
	$conn=oci_connect($UName,$PWord,$DB);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $action ) {
        case "add":
            echo "Adding";
            break;
        case "delete":
            $query = "DELETE FROM property WHERE Property_id =".$id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Deleted";
            break;
    }
?>
