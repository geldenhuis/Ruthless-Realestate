<?php
	include('./remoteconnection.php');
	$conn=oci_connect($UName,$PWord,$DB);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];
    extract($_REQUEST);

    switch ( $action ) {
        case "add":
            // .serializeArray() doesn't send checkbox
            // if it's not checked and we require a value
            if(!$mlist){ $mlist = "n"; }
            $query= "INSERT INTO client (client_id, client_familyname, client_givenname, client_street, client_suburb, client_state, client_pc, client_email, client_phone, client_mobile, client_mailinglist) VALUES (CLIENT_ID_SEQ.nextval, '".$lname."', '".$fname."', '".$street."', '".$suburb."', '".$state."', '".$postcode."', '".$email."', '".$phone."', '".$mobile."', '".$mlist."')";
            $stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            // Used for testing
            //echo ($lname. " | " .$fname. " | " .$street. " | " .$street. " | " .$suburb. " | " .$state. " | " .$postcode. " | " .$email. " | " .$phone. " | " .$mobile. " | " .$mlist);
            break;

        case "delete":
            $query = "DELETE FROM client WHERE client_id = " .$id;
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);
            echo "Deleted";
            break;

        case "update":
			$query="UPDATE client SET client_familyname='" .$_REQUEST['lname']. "', client_givenname='" .$_REQUEST['fname']. "', client_street='" .$_REQUEST['address']. "', client_suburb='" .$_REQUEST['suburb']. "', client_state='" .$_REQUEST['state']. "', client_pc='" .$_REQUEST['postcode']. "', client_email='" .$_REQUEST['email']. "', client_phone='" .$_REQUEST['phone']. "', client_mobile='" .$_REQUEST['mobile']. "', client_mailinglist='" .$_REQUEST['mailinglist']. "' WHERE client_id = '" .$id. "'";
            $stmt = oci_parse($conn,$query);

            if (oci_execute($stmt)){
                echo "Updated Completed";
            }
            else{
                echo "Error";
            }
            break;

        case "retrieve":
            $query="SELECT * FROM client WHERE client_id =" . $_REQUEST['id'];
            $stmt=oci_parse($conn, $query);
            oci_execute($stmt);
            $row=oci_fetch_array ($stmt);
            $arr = array ('fname'=>$row[2],'lname'=>$row[1],'address'=>$row[3],'suburb'=>$row[4],'state'=>$row[5],'postcode'=>$row[6],'email'=>$row[7],'phone'=>$row[8],'mobile'=>$row[9],'mlChkVal'=>$row[10]);
            echo json_encode($arr);
            break;


    }
?>
