<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Standard meta kludge -->
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description" content="FIT2076 Assignment 2">
    <meta name="author" content="Luke Blues (25124463)">
    <meta name="keyword" content="">

    <title>Admin - Dashboard</title>

    <!-- CSS Styles -->
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors.css" rel="stylesheet">
    <link href="./assets/css/box.css" rel="stylesheet">
    <link href="./assets/css/sidebar.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <table class="table table-striped" style="width:350px;">
        <thead>
        <tr style="text-align: center;">
        <th>ID#</th>
        <th>Name</th>
        </tr>
        </thead>
    </table>
    <button id="addType">Add Type</button>
    <div style="height: 350px; width:350px; overflow-y: scroll;">
        <table class="table table-striped">
            <!-- Try to connect to DB and -->
            <?php include( "remoteconnection.php" );
                $conn=oci_connect($UName,$PWord,$DB);
                $query="SELECT * FROM property_type" ;
                $stmt=oci_parse($conn, $query);
                oci_execute($stmt);
            ?>
            <tbody class="searchable">
                <?php while ($row=oci_fetch_array ($stmt)) {
                echo "<tr>";
                echo "<td class='id'>$row[0]</td>";
                echo "<td class='name'>$row[1]</td>";
                echo "<td><button class='deltype btn btn-default'>Delete</button></td>";
                echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<?php oci_free_statement($stmt); oci_close($conn); ?>


<script>
        //Add type to DB
        $(function(){
            $("#addType").click(function() {
                //Set $id and $name
                var $type_name;
                //Call managetype.php with add method
                $.post( "managetype.php", { action: "add"})
                 .done(function( data ) {
                alert( data );
                });
            });
        });


        //Delete type from DB
        $(function(){
            $(".deltype").click(function() {

                // Find the Row that the button is on and the value of the ID td.
                // so we can pass it to the deltype() function in managetype.php
                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();

                //Confirm we want to delete

                //Delete Item using manage.php
                $.post( "managetype.php", { action: "delete", id: $id })

                // If the item was deleted we use JQuery to hide the row as it's quicker
                // than going to managetype.php and hitting the DB for updated results
                // to redraw the whole table and allows multiple deletes quickly.
                // the table will be redrawn when the page is reloaded anyway.
                // TL;DR - Done for performance reasons vs using PHP
                 .done(function(data){
                        if (data == "deleted") {
                        $row.hide();
                        }
                        else {
                            alert("An error occurred, item was not deleted");
                        }
                });
            });
        });
</script>
</html>
