<?php ob_start(); ?>
<!-- TODO LIST: Updated - 29th September 6pm

    - Finish Add Client Modal + Code
    - Create Proper confirm modal
    - Finish Update code
    - Implement Dropdown State selection
    - Implement input checking

-->


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
                    <li>Client Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Client Database
                    <button id="addcust" class='pad btn btn-default' style="float: right;" data-toggle='modal' data-target='.add-modal'>
                        <i class="fa fa-plus"></i> Add Client
                    </button>
                </h2>

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

                        <!--- Temp Kludge hack to enable fixed header -->
                        <table class="table table-striped">

                                <col style="width:5%" />
                                <col style="width:10%" />
                                <col style="width:15%" />
                                <col style="width:10%" />
                                <col style="width:5%" />
                                <col style="width:10%" />
                                <col style="width:5%" />
                                <col style="width:5%" />

                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Phone Number</th>
                                    <th>Mailing List</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                        </table>

                        <div style="height: 350px; overflow-y: scroll;">
                            <table class="table table-striped">

                                <!-- Try to connect to DB and -->
                                <?php include( "remoteconnection.php" );
                                    $conn=oci_connect($UName,$PWord,$DB);
                                    $query="SELECT * FROM client";
                                    $stmt=oci_parse($conn, $query);
                                    oci_execute($stmt);
                                ?>

                                <tbody class="searchable">
                                    <?php while ($row=oci_fetch_array ($stmt)) {

                                            // Had to get creative with the trim and rtrim functions as php was adding lots of whitespace
                                            // and breaking the JQuery instant filter
                                            echo "<tr>";
                                            echo "<td class='id'>" . trim($row[0]) . "</td>";
                                            echo "<td class='name'>" . rtrim($row[1]);
                                            echo " " . rtrim($row[2]) . "</td>";
                                            echo "<td class='address'>$row[3]</td>";
                                            echo "<td class='suburb'>$row[4]</td>";
                                            echo "<td class='state'>$row[5]</td>";
                                            echo "<td class='phone'>$row[8]</td>";

                                            if ($row[10] == "y"){
                                                echo "<td class='mailinglist'><i class='fa fa-check'></i></td>";
                                            }
                                            else{
                                                 echo "<td class='mailinglist'></td>";
                                            }

                                            echo "<td><div class='btn-group'><button data-toggle='modal' data-target='.edit-modal' class='edit btn btn-info btn-sm'>";
                                            echo "Edit <i class='fa fa-edit'></i>";
                                            echo "</button>";

                                            echo "<button class='delete btn btn-danger btn-sm'>Delete</button></div></td>";
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


            <!-- Edit client dialog box -->
            <div id="editModal" class="modal edit-modal" tabindex="-1" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                            <h3>Client Details - # <span id="client-id"></span></h3>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6" style="padding-left: 20px;">
                                <form class="client-info">

                                    <label for="name">First Name</label>
                                    <br>
                                    <input type="text" id="edit-fname" class="input-xlarge">
                                    <br>

                                    <label for="name">Family Name</label>
                                    <br>
                                    <input type="text" id="edit-lname" class="input-xlarge">
                                    <br>

                                    <label for="name">Phone Number</label>
                                    <br>
                                    <input type="text" id="edit-phone" class="input-xlarge">
                                    <br>

                                    <label for="name">Mobile Number</label>
                                    <br>
                                    <input type="text" id="edit-mobile" class="input-xlarge">
                                    <br>

                                    <label for="name">Email</label>
                                    <br>
                                    <input type="text" id="edit-email" class="input-xlarge">
                                    <br>
                                    <br>
                                    <input type="checkbox" id="edit-mlist" />
                                    <label for="edit-mlist">Subscribed to Mailing List</label>
                            </div>
                            <div class="col-md-6">
                                    <label for="name">State</label>
                                    <br>
                                    <select>
                                      <option value="volvo">VIC</option>
                                      <option value="saab">NSW</option>
                                      <option value="mercedes">QLD</option>
                                      <option value="audi">NT</option>
                                      <option value="audi">TAS</option>
                                      <option value="audi">WA</option>
                                      <option value="audi">ACT</option>
                                      <option value="audi">SA</option>
                                    </select>
                                    <br>

                                    <label for="name">Suburb</label>
                                    <br>
                                    <input type="text" id="edit-suburb" class="input-xlarge">
                                    <br>

                                    <label for="name">Post Code</label>
                                    <br>
                                    <input type="text" id="edit-pcode" class="input-xlarge">
                                    <br>

                                    <label for="name">Street Address</label>
                                    <br>
                                    <input type="text" id="edit-street" class="input-xlarge">
                                    <br>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="submit" value="Apply" id="update" data-loading-text='Changes Saved'>Update</button>
                            <a href="#" class="btn" data-dismiss="modal">Done</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Client Modal -->
            <div id="addModal" class="modal add-modal" tab-index="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                            <h3>Create Client</h3>
                        </div>

                        <div class="modal-body">
                            <form>
                                <label>Add Customer Details</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </aside>

        <a href="showsource.php?page=clients.php" target="_blank"><img src="assets/images/codebuttonclient.jpg"></a>

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
        $(function(){
            $(".edit").click(function() {
                // NOTE: Add a loading and spinner to the title to eliminate errs caused by latency.

                // Clear all input fields otherwise there can be errors when we edit multiple entries.
                // where it shows the previous data before updating to the current record.
                $('.client-info').trigger("reset");

                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();

                $.post('./manageclients.php', { action: "retrieve", id: $id }, function(data) {

                    //Window Dressing
                    $('#client-id').text($id);

                    //Should just do this using the returned array and a loop
                    $('#edit-fname').val(data.fname);
                    $('#edit-lname').val(data.lname);
                    $('#edit-phone').val(data.phone);
                    $('#edit-mobile').val(data.mobile);
                    $('#edit-email').val(data.email);

                    //Address Stuff
                    $('#edit-street').val(data.address);
                    $('#edit-suburb').val(data.suburb);
                    $('#edit-pcode').val(data.postcode);

                    // Because we use a single char to check if the client is on the mailing list
                    // we need to convert that to a boolean value to set the checkbox
                    // (alternatively we could just use a listbox an negate this requirement).
                    if (data.mlChkVal == "y"){
                        $('#edit-mlist').prop('checked', true);
                    } else {
                        $('#edit-mlist').prop('checked', false);
                    }
                }, 'json');
            });
        });

        //On click set the button to 'loading', generate the PDF and change page to view it
        $('#downPDF').click(function(){
            var btn = $(this)
            // Swap the button state to 'loading'
            // because PDF generation can take a while and we need valid feedback
            btn.button('loading');
            $.get( "generate-pdf.php", function( data ) {
                // Reset the button state
                btn.button('reset')
                // Change to the PDF location
                window.location = ( data )
            });
        });

        $('#update').click(function(){
            var btn = $(this)

            $.post ("manageclient.php", { action: ""})
            btn.button('loading');
            if ($('#edit-mlist').is(':checked')){
                alert("Checked");
            }
            else{
                alert("Not Checked");
            }
            btn.button('reset');
        });


        $(function(){
            $(".delete").click(function() {
                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();
                //I am lazy and didn't want to create a proper dialog box for testing
                // Implement later
                if (window.confirm("Delete Record?")){
                $.post( "manageclient.php", { action: "delete", id: $id })
                .done(function(data){
                    if (data == "Deleted") {
                        $row.hide();
                        alert("Record Deleted");
                    }
                    else {
                        alert("An error occurred, item was not deleted");
                    }
                });
                }
                else{
                    alert("Not deleting");
                }
            });
        });

    </script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>
</html>






