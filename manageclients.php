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
            echo "Deleted";
            break;

        case "update":
            echo "Updated";
            break;

        case "retrieve":
            $query="SELECT * FROM client WHERE client_id =" . $_REQUEST['id'];
            //Retrieve info from DB
            $stmt=oci_parse($conn, $query);
            oci_execute($stmt);
            $row=oci_fetch_array ($stmt);

        //Create array and return the data in JSON format to the JQuery AJAX listener
            $arr = array ('fname'=>$row[1],'lname'=>$row[2], 'mlChkVal'=>$row[10]);
            echo json_encode($arr);
            break;
    }
?>
