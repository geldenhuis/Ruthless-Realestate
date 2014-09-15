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


    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="alt-style.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <link href="./assets/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body>
    <header class="header">
        <a href="index.html" class="logo">Administration</a>
        <nav class="navbar navbar-static-top" role="navigation"></nav>
    </header>

    <aside class="left-side">
        <div id="accordian">
            <ul>
                <li class="active">
                    <h3><i class="fa fa-key"></i>  <span>Property</span></h3>
                </li>
                <li>
                    <h3><span class="icon-tasks"></span>Tasks</h3>
                    <ul>
                        <li><a href="#">Today's tasks</a>
                        </li>
                        <li><a href="#">Urgent</a>
                        </li>
                        <li><a href="#">Overdues</a>
                        </li>
                        <li><a href="#">Recurring</a>
                        </li>
                        <li><a href="#">Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h3><span class="icon-calendar"></span>Calendar</h3>
                    <ul>
                        <li><a href="#">Current Month</a>
                        </li>
                        <li><a href="#">Current Week</a>
                        </li>
                        <li><a href="#">Previous Month</a>
                        </li>
                        <li><a href="#">Previous Week</a>
                        </li>
                        <li><a href="#">Next Month</a>
                        </li>
                        <li><a href="#">Next Week</a>
                        </li>
                        <li><a href="#">Team Calendar</a>
                        </li>
                        <li><a href="#">Private Calendar</a>
                        </li>
                        <li><a href="#">Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h3><span class="icon-heart"></span>Favourites</h3>
                    <ul>
                        <li><a href="#">Global favs</a>
                        </li>
                        <li><a href="#">My favs</a>
                        </li>
                        <li><a href="#">Team favs</a>
                        </li>
                        <li><a href="#">Settings</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>

    <script>
        /*jQuery time*/
        $(document).ready(function () {
            $("#accordian h3").click(function () {
                //slide up all the link lists
                $("#accordian ul ul").slideUp();
                //slide down the link list below the h3 clicked - only if its closed
                if (!$(this).next().is(":visible")) {
                    $(this).next().slideDown();
                }
            })
        })
    </script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/retina.min.js"></script>
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
</body>

</html>






