<?php
    include('./remoteconnection.php');
	$conn=oci_connect($UName,$PWord,$DB);


    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $action ) {
        case "add":
            $query = "INSERT INTO property_type VALUES (PROPTYPE_SEQ.NEXTVAL, '" .$_REQUEST['typename']. "')";
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Added Record";
            break;

        case "delete":
            $query = "DELETE FROM property_type WHERE type_id = " . $id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Deleted";
            break;

        case "update":
            $query = "UPDATE property_type SET type_name='" .$_REQUEST['typename']. "' WHERE type_id = " .$id;
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo ("Updated");
    }
?>
