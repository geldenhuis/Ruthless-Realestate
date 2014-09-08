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
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body class="skin-blue">
    <header class="header">
        <a href="index.html" class="logo">
            This is whack yo
        </a>
        <nav class="navbar navbar-static-top" role="navigation"></nav>
    </header>

    <div class="wrapper">
        <aside class="left-side">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="index.html">
                            <i class="fa fa-dashboard"></i>  <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/widgets.html">
                            <i class="fa fa-th"></i>  <span>Widgets</span>  <small class="badge pull-right bg-green">new</small>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>


        <aside class="right-side">
            <section class="content-header">
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Client Management</li>
                </ol>
                <h1 style="text-align: center;">Clients</h1>
            </section>

            <div class="col-xs-12 pad">
                <div class="box box-solid flat">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Del</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John</td>
                                    <td>Carter</td>
                                    <td>johncarter@mail.com</td>
                                    <td>
                                        <input type='checkbox'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Peter</td>
                                    <td>Parker</td>
                                    <td>peterparker@mail.com</td>
                                    <td>
                                        <input type='checkbox'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>John</td>
                                    <td>Rambo</td>
                                    <td>johnrambo@mail.com</td>
                                    <td>
                                        <input type='checkbox'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Javascript Libraries (Load last to increase page generation speed) -->
    <script src="./assets/js/jquery-1.11.1.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>

</html>






