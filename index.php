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

    <!-- TO BE IMPLEMENTED
    <link href="./assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="./assets/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "./server_side.php"
            });
        });
    </script>
    -->

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
            Administration
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <nav class="navbar-right"><i class="fa fa-cloud pad"></i>
            </nav>
        </nav>
    </header>

    <div class="wrapper">
        <aside class="left-side">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i>  <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="feature_type.php">
                            <i class="fa fa-th"></i>  <span>Widgets</span>  <small class="badge pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li>
                        <a href="pages/widgets.html">
                            <i class="fa fa-th"></i>  <span>Widgets</span>  <small class="badge pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li>
                        <a href="pages/widgets.html">
                            <i class="fa fa-th"></i>  <span>Widgets</span>  <small class="badge pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li>
                        <a href="pages/widgets.html">
                            <i class="fa fa-th"></i>  <span>Widgets</span>  <small class="badge pull-right bg-green">new</small>
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
                        <?php include( "remoteconnection.php"); $conn=oci_connect($UName,$PWord,$DB); $query="SELECT * FROM customer" ; $stmt=oci_parse($conn, $query); oci_execute($stmt); ?>
                        <table class="table striped-table">
                            <thead>
                                <tr>
                                    <th>Cust No</th>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row=oci_fetch_array ($stmt)) { echo "<tr>"; echo "<td>$row[0]</td>"; echo "<td>$row[1]</td>"; echo "<td>$row[2]</td>"; echo "<td>$row[3]</td>"; echo "<td>$row[4]</td>"; echo "</tr>"; } ?>
                            </tbody>
                        </table>
                        <?php oci_free_statement($stmt); oci_close($conn); ?>

                    </div>
                </div>
            </div>
        </aside>
    </div>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>

</html>






