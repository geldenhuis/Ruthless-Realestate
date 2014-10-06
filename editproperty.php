<?php
    ob_start();
    session_start();
    include( "remoteconnection.php" );
    $conn=oci_connect($UName,$PWord,$DB);

    //Not needed for index as per specification
    if(!isset($_SESSION['loggedin'])){ header("Location: ./login.php"); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Standard Meta-Kludge -->
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

    <?php
        /* Having so many trips to the DB seems too inefficient.
           rewrite this code later with more efficient queries and structure
           maybe bring the property data across in a session array
           - Luke
        */

        // Main Details
        //select p.property_street, p.property_suburb, p.property_state, p.property_pc from property p where property_id = 21;
        $query = "SELECT p.property_street, p.property_suburb, p.property_state, p.property_pc, p.property_type FROM property p where property_id='" .$_REQUEST['id']."'";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        // Specify OCI_ASSOC because default behaviour returns a multidimensional associative and numerative array
        $res = oci_fetch_array ($stmt, OCI_ASSOC);
        foreach ($res as $name => $value) {
            if ($name != "PROPERTY_TYPE"){
                $details[] = "<label>" . substr($name, 9) . "</label><br>";
                $details[] = "<input class='form-control' type='text' name='{$name}' value='{$value}'>";
            }
        }
        $details = join('',$details);

        // Property Type dropdown
        $query = "SELECT * FROM property_type";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);
        $currType = $res['PROPERTY_TYPE'];
        $dropDown[] = "<select name='ptype' class='form-control'>";
        while ($row = oci_fetch_array ($stmt)){
            if ($row[0] == $currType){
                $dropDown[] = "<option value='" .$row[0]. "' selected>" .$row[1]. "</option>";
            }
            else{
                $dropDown[] = "<option value='" .$row[0]. "'>" . $row[1] . "</option>";
            }
        }
        $dropDown[] = "</select><br>";
        $dropDown = join('',$dropDown);


        // Get current images
        //$imagelocation =
    ?>



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
                        <a href="#">
                            <i class="fa fa-home"></i>  <span>Property</span>
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
                    <li><a href="#"><i class="fa fa-bar-chart"></i> Overview</a>
                    </li>
                </ol>
            </section>

            <section>
                <div id='main-content' class="col-md-12 pad">
                    <div class="box box-solid flat col-md-12">
                    <div class="box-body">
                    <form id="property-details">
                        <fieldset class="col-md-4">
                            <legend>Property Details</legend>
                            <label>Property Type</label><br>
                            <?php
                                echo $dropDown;
                                echo $details;
                            ?>
                            <br>
                            <button class="btn btn-primary">Update</button>
                        </fieldset>

                        <fieldset class="col-md-8">
                            <legend>Property Image</legend>
                            <?php
                                $query ="select * from property_image where property_id=" . $_REQUEST['id'];
                                $stmt = ociparse($conn, $query);
                                oci_execute($stmt);
                                oci_fetch($stmt);
                                $imgName = trim(oci_result($stmt, "IMAGE_NAME"));

                                echo '<div id="gallery" class="col-md-3" align="center">
                                    <img src="./assets/images/' . $imgName . '" class="img-thumbnail">
                                </div>' ;
                            ?>

                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    Image Options
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Choose from Server</a></li>
                                  <li><a href="#">Upload new Image</a></li>
                                </ul>
                            </div>

                            <h4>Image Details</h4>
                            <?php
                                echo "<p>Filename: - ". $imgName . "</p>";
                                echo "<p>Image Size - </p>";
                            ?>
                            <legend>Property Features</legend>
                            <button type="button" data-dismiss="modal" style="float:right;" class="btn btn-info .btn-sm"><i class="fa fa-plus"></i> Add Feature</button>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td><i class="fa fa-check"></i></td>
                                        <td>Feature Type</td>
                                        <td>Description</td>
                                        <td>Quantity</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $query = "SELECT f.feature_id, f.feature_name, pf.feature_desc, pf.quantity FROM property_feature pf, feature f WHERE pf.property_id = '" . $_REQUEST['id'] ."' AND f.feature_id = pf.feature_id";
                                  $stmt = oci_parse($conn, $query);
                                  oci_execute($stmt);

                                  while ($row = oci_fetch_array ($stmt))
                                  {
                                ?>

                                    <tr>
                                        <td><?php echo $row['FEATURE_ID']; ?></td>
                                        <td><?php echo $row['FEATURE_NAME'] ?></td>
                                        <td><?php echo $row['FEATURE_DESC'] ?></td>
                                        <td><input type="text" name="qty[]" value="<?php echo $row['QUANTITY']; ?>"></td>
                                        <td>
                                        <div class="btn-group" style="float:right;">
                                            <button class="btn btn-default">Edit</button>
                                            <button class="btn btn-danger">Remove</button></td>
                                        </div>
                                        <br>
                                    </tr>

                                <?php
                                  }
                                ?>
                                    </tbody>
                            </table>

                        </fieldset>
                    </form>
                        </div>
                    </div>
                </div>
            </section>
        </aside>

        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/retina.min.js"></script>
</body>
</html>
