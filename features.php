<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['loggedin'])){ header("Location: ./login.php"); }
?>

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

 <li class="active">
                        <a href="index.php">
                            <i class="fa fa-bar-chart"></i>  <span>Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="./properties.php">
                            <i class="fa fa-home"></i>  <span>Property</span>
                        </a>
                    </li>
                    <li>
                        <a href="type.php">
                            <i class="fa fa-th"></i>  <span>Types</span>
                        </a>
                    </li>
                    <li>
                        <a href="features.php">
                            <i class="fa fa-th"></i>  <span>Features</span>
                        </a>
                    </li>
                    <li>
                        <a href="./images.php">
                            <i class="fa fa-picture-o"></i>  <span>Images</span>
                        </a>
                    </li>
                    <li>
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
                                    <a href="logout.php"><button type="button" class="btn btn-danger">Yes</a></button></a>
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
                    <li>Feature Type Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Feature Type Database<button id="addType" class='pad btn btn-default' style="float: right;"><i class="fa fa-plus"></i> Add Feature Type</button></h2>

                    <div class="pad box box-solid flat">
                    <div class="box-body">


                        <div style="height: 550px;overflow-y: scroll;">
                            <table class="table table-striped">

                                <!-- Try to connect to DB and -->
                                <?php include( "remoteconnection.php" );
                                    $conn=oci_connect($UName,$PWord,$DB);
                                    //loop through all id's
                                    $query="SELECT * FROM feature" ;
                                    $stmt=oci_parse($conn, $query);
                                    oci_execute($stmt);
                                ?>

                                <tbody class="searchable">
                                    <?php
                                        while ($row=oci_fetch_array ($stmt)) {
                                            echo "<tr>";
                                            echo "<td class='id'>$row[0]</td>";
                                            echo "<td class='name'>$row[1]</td>";

                                            echo "<td><div class='btn-group'><button class='btn btn-info deltype'>Delete</button>";
                                            echo "<button class='btn btn-warning edit'>Edit</button></div></td>";
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
        //Going to be super lazy and refresh the page as opposed to re-drawing the table or making the table dynamic
        $(function(){
            $("#addType").click(function() {
                var type_name = prompt("Please enter a feature type:");
                if (type_name){
                    $.post( "managefeatures.php", { action: "add", typename: type_name}, function( res ) {
                        alert( res );
                        window.location.reload(true);
                    });
                }
            });
        });

        $(function(){
            $(".deltype").click(function() {
                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();
                var $confirm = window.confirm("Are you sure you wish to delete this item?");
                if ($confirm){
                    $row.hide();
                    $.post( "managefeatures.php", { action: "delete", id: $id })
                    .done(function(data){
                        if (data == "Deleted") {
                            alert("Item Deleted");
                        }
                        else {
                            alert("An error occurred, item was not deleted");
                            $row.show();

                        }
                    });
                }
            });
            });

        $(function(){
           $(".edit").click(function(){
               var currCell = $(this).closest("tr").find('.name');
               var currVal = currCell.text();
               var id = $(this).closest("tr").find('.id').text();
               var type_name = prompt("Change the value and save:", currVal);

               if (type_name != currVal && type_name){
                   $.post("managefeatures.php", {action: 'update', id: id, typename: type_name}, function(res){
                        currCell.text(type_name);
                   });
               }
           });
        });
    </script>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>


</html>



