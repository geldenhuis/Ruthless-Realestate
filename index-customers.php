<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rutheless Real Estate</title>

    <!-- Bootstrap - Locally Hosted -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <h1>This is a change</h1>

    <?php
        //Database Connection Settings - Remote DB /w Local Content
        include("remoteconnection.php");
        $conn = oci_connect($UName,$PWord,$DB);
        $query="SELECT * FROM customer";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);
    ?>

      <table border="1" align="center">
      <tr>
        <th>Cust No</th>
        <th>First Name</th>
        <th>Surname</th>
        <th>Address</th>
        <th>Contact</th>
      </tr>

    <?php
      while (oci_fetch($stmt))
      {
    ?>
        <tr>
          <td><?php echo oci_result($stmt, 1); ?></td>
          <td><?php echo oci_result($stmt, 2); ?></td>
          <td><?php echo oci_result($stmt, 3); ?></td>
          <td><?php echo oci_result($stmt, 4); ?></td>
          <td><?php echo oci_result($stmt, 5); ?></td>
          <td><?php echo oci_result($stmt, 5); ?></td>
        </tr>
    <?php
      }
    ?>
      </table>
    <?php
      oci_free_statement($stmt);
      oci_close($conn);
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
