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


<body class="skin-blue" style="font-family: HelveticaNeue-Light; font-weight: 300;">
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
                    <li>
                        <a href="customers.php">
                            <i class="fa fa-users"></i>  <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm">
                            <i class="fa fa-power-off"></i>  <span>Logout</span>
                        </a>
                    </li>

                    <!-- Small modal -->

                    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Logout <i class="fa fa-lock"></i></h4>
                                </div>
                                <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to logout?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger">Yes</button>
                                    <button type="button" class="btn btn-warning">No</button>
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
                    <li><a href="#"><i class="fa fa-plus"></i> Home</a>
                    </li>
                    <li>Create Client</li>
                </ol>

            </section>

            <div class="col-xs-12 pad">
                  <h2 class="pad">Create Client Profile</h2>
                <div class="box box-solid flat">
                    <div class="box-body">

                    </div>
                </div>

                <div class="container">
                    <!-- Example row of columns -->
                    <div class="row">
                        <div class="col-md-4 box box-solid flat">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a>
                            </p>
                        </div>
                        <div class="col-md-4 box box-solid flat">
                            <h2>Heading</h2>
                            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a>
                            </p>
                        </div>
                        <div class="col-md-4 box box-solid flat">
                            <h2>Heading</h2>
                            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a>
                            </p>
                        </div>
                    </div>


                </div>
        </aside>
        </div>



        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/retina.min.js"></script>
</body>

</html>






