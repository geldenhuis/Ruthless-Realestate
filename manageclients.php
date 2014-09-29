<?php
	include('./remoteconnection.php');
	$conn=oci_connect($UName,$PWord,$DB);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];
    $id = $_REQUEST['id'];

    switch ( $action ) {
        case "add":
			$query="INSERT INTO CLIENT (client_id, client_familyname, client_givenname, client_street, client_suburb, client_state, client_pc, client_email, client_phone, client_mobile, client_mailinglist) VALUES(CLIENT_ID.nextval,'".$_POST["client_id"]."', '".$_POST["client_familyname"]."','".$_POST["client_givenname"]."','".$_POST["client_street"]."','".$_POST["client_suburb"]."','".$_POST["client_state"]."','".$_POST["client_pc"]."','".$_POST["client_email"]."','".$_POST["client_phone"]."','".$_POST["client_mobile"]."','".$_POST["client_mailinglist"]."')";
			$stmt = oci_parse($conn,$query);
			oci_execute($stmt);
			echo "add complete";
			break;

        case "delete":
            echo "Deleted";
            break;

        case "update":
			$query="UPDATE customer set client_familyname='" .$_REQUEST['lname']. "', client_givenname='" .$_REQUEST['fname']. "', client_street='" .$_REQUEST['address']. "', client_suburb='" .$_REQUEST['suburb']. "', client_state='" .$_REQUEST['state']. "', client_pc='" .$_REQUEST['postcode']. "', client_email='" .$_REQUEST['email']. "', client_phone='" .$_REQUEST['phone']. "', client_mobile='" .$_REQUEST['mobile']. "' WHERE cust_no = '$id'";
			$stmt = oci_parse($conn,$query);
			oci_execute($stmt);
            echo "Updated Completed";
            break;

        case "retrieve":
            $query="SELECT * FROM client WHERE client_id =" . $_REQUEST['id'];
            //Retrieve info from DB
            $stmt=oci_parse($conn, $query);
            oci_execute($stmt);
            $row=oci_fetch_array ($stmt);
            //Create array and return the data in JSON format to the JQuery AJAX listener
            $arr = array ('fname'=>$row[1],'lname'=>$row[2],'address'=>$row[3],'suburb'=>$row[4],'state'=>$row[5],'postcode'=>$row[6],'email'=>$row[7],'phone'=>$row[8],'mobile'=>$row[9],'mlChkVal'=>$row[10]);
            //$arr = array ('fname'=>$row[1],'lname'=>$row[2], 'mlChkVal'=>$row[10]);
            echo json_encode($arr);
            break;
    }
?>
