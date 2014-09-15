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
                        <a href="customers.php">
                            <i class="fa fa-users"></i>  <span>Customers</span>
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
                    <li>Customer Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Customer Database</h2>
                <div class="box box-solid flat">
                    <div class="box-body">
                        <label style="font-family: HelveticaNeue-Light; font-size: 12px; font-weight: 300; padding-left:0px;">
                            <b>Filter by: </b>Phone Number, Name, Address or Client ID
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">Filter Results</span>
                            <input id="filter" type="text" class="form-control flat" placeholder="Type here...">
                        </div>
                        <hr>

                        <?php include( "remoteconnection.php" ); $conn=oci_connect($UName,$PWord,$DB); $query="SELECT * FROM customer" ; $stmt=oci_parse($conn, $query); oci_execute($stmt); ?>

                        <!--- Temp Kludge hack to enable fixed header -->
                        <table class="table table-striped">

                            <col style="width:10%" />
                            <col style="width:18%" />
                            <col style="width:18%" />
                            <col style="width:18%" />
                            <col style="width:18%" />
                            <col style="width:18%" />

                            <thead>
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                        </table>

                        <div style="height: 350px; overflow-y: scroll;">
                            <table class="table table-striped">
                                <col style="width:10%" />
                                <col style="width:18%" />
                                <col style="width:18%" />
                                <col style="width:18%" />
                                <col style="width:18%" />
                                <col style="width:18%" />

                                <tbody class="searchable">
                                    <?php while ($row=oci_fetch_array ($stmt)) {
                                            echo "<tr>";
                                            echo "<td class='id'>$row[0]</td>";
                                            echo "<td class='first'>$row[1]</td>";
                                            echo "<td class='second'>$row[2]</td>";
                                            echo "<td class='address'>$row[3]</td>";
                                            echo "<td class='phone'>$row[4]</td>";
                                            echo "<td>";
                                            echo "<button data-toggle='modal' data-target='.edit-modal' class='edit btn btn-danger'>";
                                            echo "<i class='fa fa-edit'></i> Edit";
                                            echo "</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <hr>

                        <?php oci_free_statement($stmt); oci_close($conn); ?>

                            <button id="downPDF" data-loading-text='<i class="fa fa-spinner fa-spin"></i> Generating PDF' class="btn btn-primary" type="submit">
                                <i class="fa fa-download"></i>
                                Download as PDF
                            </button>
                    </div>
                </div>
            </div>


            <div id="editModal" class="modal edit-modal" tabindex="-1" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                            <h3>Edit Client Details</h3>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label for="name">First Name</label>
                                <br>
                                <input type="text" id="edit-name" name="name" class="input-xlarge">
                                <br>
                                <label for="name">First Name</label>
                                <br>
                                <input type="text" id="edit-name" name="name" class="input-xlarge">
                                <br>
                                <label for="name">First Name</label>
                                <br>
                                <input type="text" id="edit-name" name="name" class="input-xlarge">
                                <br>
                                <label for="name">First Name</label>
                                <br>
                                <input type="text" id="edit-name" name="name" class="input-xlarge">
                                <br>
                                <label for="name">First Name</label>
                                <br>
                                <input type="text" id="edit-name" name="name" class="input-xlarge">
                                <br>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-danger" type="submit" value="Save" id="update">
                            <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <a href="<?php echo "showsource.php?page=customers.php"; ?>" target="_blank"><img src="assets/images/codebuttonclient.jpg"></a>

    </div>

    <script>
        //Filter the table by hiding non-matching rows on keyup
        $(function ($) {
                $('#filter').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.searchable tr').hide();
                    $('.searchable tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
        }(jQuery));


        //When Edit button is clicked find the client ID
        $(".edit").click(function() {
            //better option is to select the table and .each the columns to array
            var $row = $(this).closest("tr");
            var $id = $row.find(".id").text();
            $("#edit-name").val(id);

        });


        //Need to finish by modding generate-pdf to return zip to force d/l
        $('#downPDF').click(function(){
            var btn = $(this)
            btn.button('loading');
            $.get( "generate-pdf.php", function( data ) {
                btn.button('reset')
                window.location.href = data
            });

        });

        $('#update').click(function(){
           alert('fuck this');

        });
    </script>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>


</html>






