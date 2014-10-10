<?php ob_start(); session_start(); if(!isset($_SESSION[ 'loggedin'])){ header( "Location: ./login.php"); } include( './remoteconnection.php'); $conn=oci_connect($UName,$PWord,$DB); ?>

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

    <?php // Property Type dropdown
        $query="SELECT * FROM property_type" ;
        $stmt=oci_parse($conn, $query);
        oci_execute($stmt);
        $dropDown[]="<select name='PROPERTY_TYPE' class='form-control'>" ;
        while ($row=oci_fetch_array ($stmt)){
            $dropDown[]="<option value='" .$row[0]. "'>" . $row[1] . "</option>";
        }
        $dropDown[]="</select><br>" ;
        $dropDown=join( '',$dropDown);
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
                    <li class="active3">
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
                                    <a href="logout.php">
                                        <button type="button" class="btn btn-danger">Yes</a>
                                    </button>
                                    </a>
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
                    <li>Property Database</li>
                </ol>
            </section>
            <div class="col-xs-12 pad">

                <h2 class="pad">
                        <a href="./properties.php">
                            <button class='btn btn-info pad'>Back to Property DB</button>
                        </a>
                </h2>

                <div class="pad box box-solid flat">
                    <div class="box-body">
                        <form id="add-property">
                            <fieldset>
                                <legend>Property Details</legend>
                                <label for="PROPERTY_STREET">Street</label>
                                <br>
                                <input type="text" class="form-control" name="PROPERTY_STREET" />
                                <br>
                                <label for="PROPERTY_SUBURB">Suburb</label>
                                <br>
                                <input type="text" class="form-control" name="PROPERTY_SUBURB">
                                <br>
                                <label for="PROPERTY_STATE">State</label>
                                <br>
                                <select name="PROPERTY_STATE" class="form-control">
                                    <option value="VIC">VIC</option>
                                    <option value="NSW">NSW</option>
                                    <option value="QLD">QLD</option>
                                    <option value="NT">NT</option>
                                    <option value="TAS">TAS</option>
                                    <option value="WA">WA</option>
                                    <option value="ACT">ACT</option>
                                    <option value="SA">SA</option>
                                </select>
                                <br>
                                <label for="PROPERTY_PC">Post Code</label>
                                <br>
                                <input type="text" class="form-control" name="PROPERTY_PC">
                                <br>
                                <label for="PROPERTY_TYPE">Property Type</label>
                                <br>
                                <?php echo $dropDown ?>
                                <br>
                                <label for="PROPERTY_PRICE">List Price</label>
                                <br>
                                <input type="text" name="PROPERTY_PRICE" class="form-control">
                            </fieldset>
                        </form>
                    </div>
                </div>

                <div class="pad box box-solid flat">
                    <div class="box-body">
                        <form id="add-features">
                        <fieldset>
                            <br>
                            <legend>Property Features</legend>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Feature ID</td>
                                        <td>Feature Type</td>
                                        <td>Description</td>
                                        <td>Quantity</td>
                                        <td>Add</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $query="SELECT * From feature" ;
                                            $stmt=oci_parse($conn, $query); oci_execute($stmt);
                                            while ($row=oci_fetch_array ($stmt)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['FEATURE_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['FEATURE_NAME']; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input class='form-control' type='text' name='desc[".$row['FEATURE_ID']."]'>"; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input class='form-control' type='text' name='qty[".$row['FEATURE_ID']."]'>"; ?>
                                            <!--<input class="form-control" type="text" name="qty[]">-->
                                        </td>
                                        <td>
                                            <?php echo "<input class='form-control' type='checkbox' name='check[".$row['FEATURE_ID']."]'>"; ?>
                                            <!--<input type="checkbox" name="check[]">-->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </fieldset>
                        </form>
                    </div>
                </div>
                <button id="addprop" class="btn btn-info flat btn-lg" style="float:right">Next <i class="fa fa-check"></i></button>
            </div>
        </aside>
        <a href="showsource.php?page=clients.php" target="_blank">
            <img src="assets/images/codebuttonclient.jpg">
        </a>
    </div>


    <script>
        $(function () {
            //This is the non retarded way to do this
            $('#addprop').click(function () {
                var propdata = $('#add-property').serializeArray();
                propdata.push({name: 'action', value: 'add'});

                var featuredata = $('#add-features').serializeArray();
                featuredata.push({name: 'action', value: 'addfeatures'});

                $.post("manageproperties.php", propdata, function (res) {
                    alert(res);
                    //var propID = res.propertyid;
                    $.post("manageproperties.php", featuredata, function (res){
                        alert(res);
                        //window.location.href = './index.php';
                    });
                });
            });
        });
    </script>


    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>

</html>



