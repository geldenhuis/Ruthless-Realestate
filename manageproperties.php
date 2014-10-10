<?php
    include('./remoteconnection.php');
    $conn=oci_connect($UName,$PWord,$DB);

    //Set action, type_id and type_name
    $action = $_REQUEST['action'];

    if(isset($_REQUEST['PROPERTY_ID'])){
        $id = $_REQUEST['PROPERTY_ID'];
    }

    extract($_POST);



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

        case "add":
//            // Add Property to the DB
//            $query = "INSERT INTO PROPERTY (PROPERTY_ID, PROPERTY_STREET, PROPERTY_SUBURB, PROPERTY_STATE, PROPERTY_PC, PROPERTY_TYPE, PROPERTY_PRICE) VALUES (PROPID_SEQ.nextval, '".$PROPERTY_STREET."', '".$PROPERTY_SUBURB."', '".$PROPERTY_STATE."', '".$PROPERTY_PC."', '".$PROPERTY_TYPE."', '".$PROPERTY_PRICE."')";
//            $stmt = oci_parse($conn,$query);
//			oci_execute($stmt);
//
//            $query = "SELECT MAX(property_id) FROM property";
//            $stmt = oci_parse($conn,$query);
//            oci_execute($stmt);
//            //oci_fetch($stmt);
//            //$res = oci_result($stmt, 'PROPERTY_ID');
//            //echo $res;
            echo print_r($_POST);
            break;

        case 'addfeatures':
            foreach($_POST['check'] as $chkBox => $value){
                echo $_POST['desc'][$chkBox];
                echo $_POST['qty'][$chkBox];
            }
            //echo print_r($_POST);
            break;
    }
?>
