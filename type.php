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

    <link href="./assets/css/colors.css" rel="stylesheet">
    <link href="./assets/css/box.css" rel="stylesheet">
    <link href="./assets/css/sidebar.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/css/style.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body style="font-family: HelveticaNeue-Light; font-weight: 300;">
    <header class="header">
        <a href="index.html" class="logo">
            Administration
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
        </nav>
    </header>

    <div class="wrapper">
        <aside class="left-side">
            <section class="sidebar bg">
                <ul class="sidebar-menu">

                    <li>
                        <a href="index.php">
                            <i class="fa fa-bar-chart"></i>  <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-key"></i>  <span>Property</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-th"></i>  <span>Listings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-picture-o"></i>  <span>Images</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="clients.php">
                            <i class="fa fa-users"></i>  <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm">
                            <i class="fa fa-power-off"></i>  <span>Logout</span>
                        </a>
                    </li>

                    <!-- Logout Modal -->
                    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                                    <h4><i class="fa fa-lock"></i> Logout</h4>
                                </div>
                                <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to logout?</div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-danger">Yes</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-warning">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </section>
        </aside>

        <aside class="right-side">
            <section class="content-header" style="height: 50px;">
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-users"></i> Home</a>
                    </li>
                    <li>Property Type Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Property Type Database<button id="addType" class='pad btn btn-default' style="float: right;"><i class="fa fa-plus"></i> Add Property Type</button></h2>

                    <div class="pad box box-solid flat">
                    <div class="box-body">


                        <div style="height: 550px;overflow-y: scroll;">
                            <table class="table table-striped">
                            <col style="width:3%;" />
                            <col style="width:87%;" />
                            <col style="width:9%;" />

                                <!-- Try to connect to DB and -->
                                <?php include( "remoteconnection.php" );
                                    $conn=oci_connect($UName,$PWord,$DB);
                                    //loop through all id's
                                    $query="SELECT * FROM property_type" ;
                                    $stmt=oci_parse($conn, $query);
                                    oci_execute($stmt);
                                ?>

                                <tbody class="searchable">
                                    <?php
                                        while ($row=oci_fetch_array ($stmt)) {
                                            echo "<tr>";
                                            echo "<td class='id'>$row[0]</td>";
                                            echo "<td class='name'>$row[1]</td>";
                                            echo "<td><button class='deltype btn btn-info'>Delete</button></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php oci_free_statement($stmt); oci_close($conn); ?>
                    </div>
                </div>
            </div>
        </aside>

        <a href="showsource.php?page=clients.php" target="_blank"><img src="assets/images/codebuttonclient.jpg"></a>

    </div>

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

                // Check If the item was deleted
                // Then we use JQuery to hide the row as it's quicker than going to managetype.php
                // Hitting the DB for updated results and redrawing the whole table
                // The table will be redrawn when the page is reloaded anyway.
                // TL;DR - Done for performance reasons vs using PHP
                .done(function(data){
                    if (data == "Deleted") {
                        alert("Item Deleted");
                        $row.hide();
                    }
                    else {
                        alert("An error occurred, item was not deleted");
                    }
                });
            });
            });
    </script>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>


</html>



