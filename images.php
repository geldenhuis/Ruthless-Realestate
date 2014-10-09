<?php ob_start(); session_start(); if(!isset($_SESSION[ 'loggedin'])){ header( "Location: ./login.php"); } ?>

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

    <?php
        // Check is the Check[] array is set
        if(isset($_POST['check'])){
            //Loop through array and check if any of the images selected are used by a property
            foreach($_POST['check'] as $images){
                $query = "update property_images SET image_ where ";
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
                    <li class="active3">
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
                    <li>Property Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Image Mananagment - Server
                    <a href="createproperty.php">
                        <button id="addType" class='pad btn btn-default' style="float: right;">
                            <i class="fa fa-plus"></i> Upload Image</button>
                    </a>
                </h2>

                    <div class="pad box box-solid flat">
                        <div style="height: 550px; overflow-y: scroll;">
                        <div class="box-body">
                            <form action="./images.php" method="post">
                                <table class="table table-striped"><tbody>
                                    <?php
                                        $currdir = dirname($_SERVER["SCRIPT_FILENAME"]);
                                        $currdir .="\\property_images\\";
                                        $dir = opendir($currdir);
                                        while($file = readdir($dir))
                                        {
                                            if($file == "." || $file ==".."){
                                                continue;
                                            }

                                            if(is_dir($file)){
                                                echo "<b>".$file."</b><br />";
                                            }
                                            else {
                                                echo "<tr><td><img src='./property_images/".$file."' class='thumbnail' style='height:50px;width:50px;'/></td><td>";
                                                echo "<td>".$file."</td>";
                                                echo "<td>Delete <input type='checkbox' name='check[]' value='".$file."'/></td>";
                                                echo "</tr>";
                                            }
                                        }
                                        closedir($dir);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                                                <button class="btn btn-danger" type="submit">Submit</button>
                            </form>
            </div>
        </aside>

        <a href="showsource.php?page=clients.php" target="_blank">
            <img src="assets/images/codebuttonclient.jpg">
        </a>

    </div>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>


</html>



