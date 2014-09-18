<?php

    //Connect to DB
    include( "remoteconnection.php" );
    $conn=oci_connect($UName,$PWord,$DB);
    $query="SELECT * FROM client" ;
    $stmt=oci_parse($conn, $query);
    oci_execute($stmt);

    //HTML for the table we want to use to create a PDF
    $html = '
                    <h1>Client DB List - ' . date('d/m/Y') . '</h1>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                        in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <hr>
                    <table>
                        <thead>
                            <tr style="background-color: #eaeaec;">
                                <th>ID #</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Mailing List</th>
                            </tr>
                        </thead>
                        <tbody>';

                        //Loop through and add results to html
                        while ($row=oci_fetch_array ($stmt)) {
                            $html .= "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]$row[4]$row[5]</td><td>$row[8]</td><td>$row[10]</td></tr>";
                        };


                        //Add closing tags
                        $html .= '</tbody></table>';

    //Release and close the connection to the DB
    oci_free_statement($stmt);
    oci_close($conn);

    //Load MPDF and create new PDF object
    include("./mpdf/mpdf.php");
    $mpdf = new mPDF();
    //Set Filename
    $fname = 'Client List - ' . date('dmy') .'.pdf';
    //Add Stylesheet
    $stylesheet = file_get_contents('./assets/css/pdf-style.css');
    //Set Footer format is left|center|right
    $mpdf->SetFooter($fname . '|{PAGENO}| ' . date('d/m/Y h:i A') );
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html, 2);
    //Create PDF - F flag = write to file
    $mpdf->Output($fname, 'F');

    //Return filelocation to ajax listener
    echo $fname;
    exit;
?>
