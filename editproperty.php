<?php
    ob_start();
    session_start();

    //Not needed for index as per specification
    if(!isset($_SESSION[ 'loggedin'])){ header( "Location: ./login.php"); }

    include( "remoteconnection.php" );
    $conn=oci_connect($UName,$PWord,$DB);

    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
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
        $query = "SELECT p.property_street, p.property_suburb, p.property_state, p.property_pc, p.property_type, p.property_price FROM property p where property_id='" .$_REQUEST['id']."'";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        // Specify OCI_ASSOC because default behaviour returns 2 Arrays causing undesired behaviour
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
        $dropDown[] = "<select name='PROPERTY_TYPE' class='form-control'>";
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

        if (isset($_FILES["userfile"]["tmp_name"])){
            $upfile = './property_images/'.$_FILES["userfile"]["name"];
            if(!move_uploaded_file($_FILES["userfile"]["tmp_name"],$upfile))
            {
              echo "ERROR: Could Not Move File into Directory";
            }
            else{
                $query="UPDATE property_image SET IMAGE_NAME='".$_FILES["userfile"]["name"]."' WHERE property_id='".$_REQUEST['id']."'";
                $stmt= oci_parse($conn, $query);
                oci_execute($stmt);
            }
        }
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

                     <li>
                        <a href="index.php">
                            <i class="fa fa-bar-chart"></i>  <span>Overview</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./properties.php">
                            <i class="fa fa-home"></i>  <span>Property</span>
                        </a>
                    </li>
                    <li>
                        <a href="type.php">
                            <i class="fa fa-th"></i>  <span>Property Types</span>
                        </a>
                    </li>
                    <li>
                        <a href="features.php">
                            <i class="fa fa-th"></i>  <span>Property Features</span>
                        </a>
                    </li>
                    <li>
                        <a href="images.php">
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
                    <h2 class="pad">
                        <a href="./properties.php">
                            <button class='btn btn-info pad'>Back to Property DB</button>
                        </a>
                    </h2>
                    <div class="box box-solid flat col-md-12">
                        <div class="box-body">
                            <form id="property-details">
                                <fieldset class="col-md-4">
                                    <legend>Property Details <span id="propid"><?php echo $_REQUEST['id']?></span></legend>
                                    <label>Property Type</label>
                                    <br>
                                    <?php echo $dropDown; echo $details; ?>
                                    <br>
                                    <a id='update' class="btn btn-primary">Update</a>
                                </fieldset>
                            </form>

                            <form id="image-details" method="post" enctype="multipart/form-data" action="editproperty.php?id=<?php echo $_REQUEST['id'] ?>">
                                <fieldset class="col-md-8">
                                    <legend>Property Image</legend>
                                    <?php
                                        $query="select * from property_image where property_id=" . $_REQUEST[ 'id'];
                                        $stmt=ociparse($conn, $query);
                                        oci_execute($stmt);
                                        oci_fetch($stmt);
                                        if (!isset($_FILES["userfile"])){
                                            $imgName=trim(oci_result($stmt, "IMAGE_NAME")) ? trim(oci_result($stmt, "IMAGE_NAME")) : "150x150.gif";
                                        }
                                        else{
                                            $imgName=$_FILES['userfile']['name'];
                                        }
                                        echo '<div id="gallery" class="col-md-3" align="center"><img src="./property_images/' . $imgName . '" class="img-thumbnail"></div>';
                                    ?>

                                    <div class="col-md-6">
                                    <h4>Image Details</h4>
                                    <?php
                                        // Have to check as triton's php.ini must have error_reporting set to E_NOTICE
                                        if(isset($_FILES['userfile'])){
                                            echo "File Name: " .$_FILES["userfile"]["name"]. "<br />";
                                            echo "File Size: " .$_FILES["userfile"]["size"]. " bytes<br />";
                                            echo "File Type: " .$_FILES["userfile"]["type"]. "<br />";
                                        }
                                        else{
                                            echo "File Name: $imgName <br/>";
                                            echo "File Size: ".filesize('./property_images/'.$imgName)."<br />";
                                            //Deprecated so I can't be bothered fixing
                                            //echo "File Type: ".mime_content_type('./uploads/'.$imgName)."<br />";
                                        }
                                    ?>
                                    <br />
                                    <input class="input-control" type="file" name="userfile" />
                                    <button id="upload" type="submit" class="btn btn-danger btn-xs">Upload</button>
                                    </div>
                            </form>
                            <form id="feature-details">
                                <legend>Property Features</legend>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td><i class="fa fa-check"></i>
                                            </td>
                                            <td>Feature Type</td>
                                            <td>Description</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $query="SELECT f.feature_id, f.feature_name, pf.feature_desc, pf.quantity FROM property_feature pf, feature f WHERE pf.property_id = '" . $_REQUEST[ 'id'] . "' AND f.feature_id = pf.feature_id"; $stmt=oci_parse($conn, $query); oci_execute($stmt); while ($row=oci_fetch_array ($stmt)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row[ 'FEATURE_ID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row[ 'FEATURE_NAME'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row[ 'FEATURE_DESC'] ?>
                                            </td>
                                            <td>
                                                <input type="text" name="qty[]" value="<?php echo $row['QUANTITY']; ?>">
                                            </td>
                                            <td>
                                                <div class="btn-group" style="float:right;">
                                                    <button class="btn btn-default">Edit</button>
                                                    <button class="btn btn-danger">Remove</button>
                                            </td>
                                            </div>
                                            <br>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </aside>

        <script>
                $('#update').click(function(){
                    var data = $('#property-details').serializeArray();
                    data.push({name:'PROPERTY_ID', value: $('#propid').text()});
                    data.push({name:'action', value: 'update'});
                    $.post('manageproperties.php', data , function(res){
                        alert(res);
                    })
                });
        </script>

        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/retina.min.js"></script>
</body>

</html>
