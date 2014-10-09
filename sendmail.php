<?php
    $from = "From: Rutheless Realestate <robin.ruthless@ruthlessrealestate.com.au>";
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
?>
