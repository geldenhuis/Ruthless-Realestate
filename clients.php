<?php ob_start(); session_start(); if(!isset($_SESSION[ 'loggedin'])){ header( "Location: ./login.php"); } ?>

<!-- TODO LIST: Updated - 29th September 6pm
    - Create Proper confirm modal
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
                            <i class="fa fa-th"></i>  <span>Property Types</span>
                        </a>
                    </li>
                    <li>
                        <a href="features.php">
                            <i class="fa fa-th"></i>  <span>Property Features</span>
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
                    <li><a href="#"><i class="fa fa-users"></i> Home</a>
                    </li>
                    <li>Client Database</li>
                </ol>
            </section>

            <div class="col-xs-12 pad">
                <h2 class="pad">Client Database
                    <button class='pad btn btn-default' style="float: right;" data-toggle='modal' data-target='.add-modal'>
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
                                            // Data in table has the names around the wrong way
                                            echo "<tr>";
                                            echo "<td class='id'>" . trim($row[0]) . "</td>";
                                            echo "<td class='name'>" . rtrim($row[2]);
                                            echo " " . rtrim($row[1]) . "</td>";
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
                        <button id="mailinglist" class="btn btn-primary" data-toggle='modal' data-target='.mail-modal'>
                            <i class="fa fa-envelope"></i>
                            Mailing List
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
                                <select id="edit-state">
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

                        <div class="modal-body row">
                            <div class="col-md-6" style="padding-left: 20px;">
                                <form id="new-client">
                                    <label for="fname">First Name</label>
                                    <br>
                                    <input type="text" name="fname" class="input-xlarge" required>
                                    <br>

                                    <label for="lname">Family Name</label>
                                    <br>
                                    <input type="text" name='lname' class="input-xlarge" required>
                                    <br>

                                    <label for="phone">Phone Number</label>
                                    <br>
                                    <input type="text" name="phone" class="input-xlarge" required>
                                    <br>

                                    <label for="mobile">Mobile Number</label>
                                    <br>
                                    <input type="text" name="mobile" class="input-xlarge" required>
                                    <br>

                                    <label for="email">Email</label>
                                    <br>
                                    <input type="email" name="email" class="input-xlarge" required>
                                    <br>
                                    <input type="checkbox" name="mlist" id="mlist" value="y" required>
                                    <label for="add-mlist">Subscribe to Mailing List?</label>
                            </div>
                            <div class="col-md-6">
                                <label for="state">State</label>
                                <br>
                                <select name="state" id='state'>
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

                                <label for="suburb">Suburb</label>
                                <br>
                                <input type="text" name="suburb" id="suburb" class="input-xlarge">
                                <br>

                                <label for="postcode">Post Code</label>
                                <br>
                                <input type="text" name="postcode" id="postcode" class="input-xlarge">
                                <br>

                                <label for="street">Street Address</label>
                                <br>
                                <input type="text" name="street" id="street" class="input-xlarge">
                                <br>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" id="addcust">Create Record</button>
                            <a href="#" class="btn" data-dismiss="modal">Done</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mailing List Modal -->
            <div id="mailinglistModal" class="modal mail-modal" tabindex="-1" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal"><i class="fa fa-close"></i></a>
                            <h3>Contact Mailing-List</h3>
                            <p>This form will send your message to all clients that have opted into the mailinglist</p>
                            <p>Note: Emails may not appear immediately as this process runs in the background due to the large amout of traffic generated</p>
                        </div>

                        <div class="modal-body row">
                            <div style="padding-left: 20px;">
                                <form id="new-email" >
                                    <label for="mTypeDrop">Select eMail Type:</label>
                                    <br>
                                    <select id="mTypeDrop" name="mTypeDrop">
                                        <option id="mailinglist" value="mailinglist">Entire Mailinglist</option>
                                        <option id="single" value="single">Single Email</option>
                                    </select>
                                    <br />
                                    <label for="recipient">To:</label>
                                    <br />
                                    <input  type="text" id="recipient" class=".hidden" />
                                    <br />
                                    <label for="msubject">Subject:</label>
                                    <br>
                                    <input style="width: 90%;" type="text" id="msubject" name="msubject" class="input-xlarge" required>
                                    <br>
                                    <label for="mbody">Message:</label>
                                    <br>
                                    <textarea style="width: 90%;" name="mbody" id="mbody"></textarea>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" id="sendmail" data-loading-text='<i class="fa fa-spinner fa-spin"></i> Sending'>
                                <i class="fa fa-paper-plane-o"></i> Send Email</button>
                            <a href="#" class="btn" data-dismiss="modal">Done</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <a href="showsource.php?page=clients.php" target="_blank">
            <img src="assets/images/codebuttonclient.jpg">
        </a>

    </div>

    <script>
        $(function ($) {
            $('#filter').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));

        $(function () {
            //This is the non retarded way to do this
            $('#addcust').click(function () {
                var data = $('#new-client').serializeArray();
                data.push({name: 'action', value: 'add'});
                $.post("manageclients.php", data, function (res) {
                    $("#new-client").trigger("reset");
                    alert("New client added");

                });
            });
        });

        $(function () {
            $(".edit").click(function () {
                // NOTE: Add a loading and spinner to the title to eliminate errs caused by latency.
                $('.client-info').trigger("reset");
                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();

                $.post('./manageclients.php', {
                    action: "retrieve",
                    id: $id
                }, function (data) {

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
                    if (data.mlChkVal == "y") {
                        $('#edit-mlist').prop('checked', true);
                    } else {
                        $('#edit-mlist').prop('checked', false);
                    }
                }, 'json');
            });
        });

        //On click set the button to 'loading', generate the PDF and change page to view it
        $('#downPDF').click(function () {
            var btn = $(this)
                // Swap the button state to 'loading'
                // because PDF generation can take a while and we need valid feedback
            btn.button('loading');
            $.get("generate-pdf.php", function (data) {
                // Reset the button state
                btn.button('reset')
                // Change to the PDF location (The name hack is due to strict rules on the server regarding deprecicated functions)
                window.location = ('./Client-List.pdf')
            });
        });

        $(function(){
        $('#update').click(function () {
            var btn = $(this);
            var $id = $("#client-id").text();
            btn.button('loading');

            var $fname = $("#edit-fname").val();
            var $lname = $("#edit-lname").val();
            var $phone = $("#edit-phone").val();
            var $mobile = $("#edit-mobile").val();
            var $email = $("#edit-email").val();
            var $address = $("#edit-street").val();
            var $suburb = $("#edit-suburb").val();
            var $state = $("#edit-state option:selected").text();
            var $postcode = $("#edit-pcode").val();

            if ($('#edit-mlist').is(':checked')) {
                var $mailinglist = "y";
            } else {
                var $mailinglist = "n";
            }

            $.post("./manageclients.php", {
                action: "update",
                id: $id,
                fname: $fname,
                lname: $lname,
                phone: $phone,
                mobile: $mobile,
                email: $email,
                address: $address,
                suburb: $suburb,
                state: $state,
                postcode: $postcode,
                mailinglist: $mailinglist
            }, function (data) {
                if (data == "Updated Completed") {
                    alert(data);
                } else {
                    alert(data);
                }
            })
            btn.button('reset');
        });
            });


        $(function () {
            $(".delete").click(function () {
                var $row = $(this).closest("tr");
                var $id = $row.find(".id").text();
                if (window.confirm("Delete Record?")) {
                    $.post("manageclients.php", { action: "delete", id: $id}, function (data) {
                            if (data == "Deleted") {
                                $row.hide();
                                alert("Record Deleted");
                            } else {
                                alert("An error occurred, item was not deleted please refresh and try again");
                            }
                        })
                } else {
                    alert("Not deleting");
                }
            });
        });

        //Could use serialise but want more control over vars
        $("#sendmail").click(function (){
            if(window.confirm("Are you ready to send this email?")){

                var subject = $('#msubject').val();
                var message = $('#mbody').val();
                var recipient = $('#recipient').val();
                var actiontype = (!recipient) ? 'mailinglist' : 'single';

                $(this).button('loading');

                $.post("sendmail.php", {action: actiontype, message: message, subject: subject, to: recipient}, function (data) {
                    alert(data);
                });

                $(this).button('reset');
            }
        });

    </script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
</body>

</html>






