<?php

    //Include the database connection details: Username, Password, Database location
    include( "remoteconnection.php" );

    //Fix for incorrect content type in the return headers (not always a problem)
    header('Content-Type: application/json');

    /*
        Get the stats we need form the DB using COUNT statements
    */

    //Try to connect to DB
    $conn=oci_connect($UName,$PWord,$DB);

    // Execute multiple count statements at once using the DUAL dummy table.
    // Done for interface performance reasons
    // http://docs.oracle.com/database/121/SQLRF/queries009.htm#SQLRF20036
    $query = "SELECT (SELECT COUNT(*) FROM customer) AS totalCustomers, (SELECT COUNT(*) FROM authenticate) AS totAccounts FROM dual";

    //Create statement from connection and query
    $stmt=oci_parse($conn, $query);

    //Execute the statement
    oci_execute($stmt);

    //Return the results as an array
    $row=oci_fetch_array ($stmt);

    //Create array and return the stats in JSON format to the JQuery AJAX listener
    $arr = array ('cusTotal'=>$row[0],'propTotal'=>$row[2],'listTotal'=>3,'saleTotal'=>4);
    echo json_encode($arr);
?>

