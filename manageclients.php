<?php
    extract('$_POST');
    include ('./remoteconnection.php');

    switch ($action) {
        case 'add':
            $query = "INSERT INTO clients VALUES ()";
            break;

        case 'delete':
            $query = "DELETE FROM table_name WHERE some_column=some_value";
            break;

        case 'update':
            $query = "UPDATE clients SET column1=value1,column2=value2 WHERE some_column=some_value";
            break;
    }
?>
