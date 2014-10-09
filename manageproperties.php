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

        case "update":
            $query = "UPDATE property SET";
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);

            // Testing Code remove in final version
            echo print_r($_POST);
            break;

        case 'search':
            /*
            if (x='feature'){
                $query = "search like type";
            }
            else{
                $query = "search like address";
            }
            execute statement
            get array of results

            if ($res == ''){
                return "<td>No results found</td>";
            }
            loop through array:
                create html table rows
            end loop
            return $htmlresults;*/
            break;

        case 'sold':
            //Mark property as sold in the DB with sold price
            break;

    }
?>
