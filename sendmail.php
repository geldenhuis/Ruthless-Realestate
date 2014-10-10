<?php

    //NOTE: DUE TO THE FACT THAT THERE IS 1000+ RECORDS IN THE CLIENT DB
    //MASSMAILING HAS BEEN COMMENTED OUT TO STOP SPAMMING AND POTENTIAL PROBLEMS

    ob_start();
    include ("remoteconnection.php");
    $action = $_POST['action'];

    $from = "From: Luke Blues <lablu2@student.monash.edu.au>";

    // If var mailinglist = true get all mailing list subscribers and send email
    if ( $action == 'mailinglist') {

        /* COMMENTED OUT TO STOP SPAM
        $query = "SELECT client_email FROM client WHERE client_mailinglist = 'y'";
        $stmt = oci_parse($conn,$query);
        oci_execute ($stmt);
        $res = oci_fetch_array($stmt, OCI_ASSOC);

        //Loop through all clients that were returned
        foreach ($res as $client => $value) {
            //Set reciepient email address from the returned db results
            $to = $client;

            // If mail fails add the address to an array
            if(!mail($to, $subject, $msg, $from)){
                $arrFail[] = $to;
            }
        }
        //See if failed email array contains any results
        if (isset(($arrFail)){
            // If it does return the failed addresses to the user as JSON
            echo json_encode($arrFail);
        }
        else{
            echo "Success";
        }
        */
        echo "Success";

    }
    // Else send single email to specified recipient
    else {
        $to = $_POST["to"];
        $msg =  $_POST["message"];
        $subject = $_POST["subject"];

        if(mail($to, $subject, $msg, $from))
        {
            echo "Mail Sent";
        }
        else{
            echo "Error Sending Mail";
        }
    }

?>
