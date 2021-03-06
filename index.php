<?php
    ob_start();
    session_start();
    //Not needed for index as per specification
    //if(!isset($_SESSION['loggedin'])){ header("Location: ./login.php"); }
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
                    <li><a href="#"><i class="fa fa-bar-chart"></i> Overview</a>
                    </li>
                </ol>
            </section>

            <div class="col-xs-12 ">
                <h2>Administration Overview</h2>
                <hr>
                <div class="container">
                    <div class="row" style="text-align: center;">
                        <div class="col-md-4 box box-solid flat">
                            <h3>Property Overview</h3>
                            <hr>
                            <i class="fa fa-home fa-4x"></i>
                            <h4>Total Properties</h4>
                            <h2 id="totalProps" class="text-blue"><i class="fa fa-spinner fa-spin"></i></h2>

                            <div class="pad">
                                <a href="./properties.php" class="btn btn-info btn-block btn-lg">View Property DB</a>
                            </div>

                        </div>

                        <div class="col-md-4 box box-solid flat">
                            <h3>Client Overview</h3>
                            <hr>
                            <i class="fa fa-user fa-4x"></i>
                            <h4>Total Clients</h4>
                            <h2 id="totalClients" class="text-blue"><i class="fa fa-spinner fa-spin"></i></h2>

                            <div class="pad">
                                <a href="./client.php" class="btn btn-info btn-block btn-lg">View Client DB</a>
                            </div>

                        </div>


                        <div class="col-md-4 box box-solid flat">
                            <h3>Sales Overview</h3>
                            <hr>
                            <i class="fa fa-dollar fa-4x"></i>
                            <h4>Monthly Sales</h4>
                            <h2 id="totalSales" class="text-blue"><i class="fa fa-spinner fa-spin"></i></h2>

                            <div class="pad">
                                <a href="./customers.php" class="btn btn-info btn-block btn-lg">View Sales</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <script>
            //Pull statistics using COUNT from the DB
            $(function () {
                $.getJSON("get-stats.php", function (data) {
                    $('#totalSales').text(data.saleTotal);
                    $('#totalClients').text(data.cusTotal);
                    $('#totalListings').text(data.listTotal);
                    $('#totalProps').text(data.propTotal);
                });
            });
        </script>

        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/retina.min.js"></script>
</body>

</html>






