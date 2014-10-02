<?php
    include('./remoteconnection.php');
	$conn=oci_connect($UName,$PWord,$DB);


    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $action ) {
        case "add":
            $query = "INSERT INTO feature VALUES (feature_SEQ.NEXTVAL, '" .$_REQUEST['typename']. "')";
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Added Record";
            break;

        case "delete":
            $query = "DELETE FROM feature WHERE feature_id = " . $id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Deleted";
            break;

        case "update":
            $query = "UPDATE feature SET feature_name='" .$_REQUEST['typename']. "' WHERE feature_id = " .$id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo ("Updated");
    }
?>
