<?php
include("Database/dbConnection.php");
// total user
$sqlUser = "SELECT user_id FROM user WHERE role!='ADMIN'";
$resultUser = mysqli_query($conn, $sqlUser);
$rowUser = mysqli_num_rows($resultUser);

// total pending request
$sqlRcp = "SELECT s_id FROM recipient WHERE s_approval_status='Pending'";
$resultRcp = mysqli_query($conn, $sqlRcp);
$rowRcp = mysqli_num_rows($resultRcp);

// total approved
$sqlApp = "SELECT cert_id FROM certificate WHERE approval_status='Approved'";
$resultApp = mysqli_query($conn, $sqlApp);
$rowApp = mysqli_num_rows($resultApp);

// total certificate
$sqlCert = "SELECT s_id FROM recipient WHERE s_approval_status!='No approval'";
$resultCert = mysqli_query($conn, $sqlCert);
$rowCert = mysqli_num_rows($resultCert);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
    <link rel="stylesheet" href="../View/css/main.css">

    <title>Dashboard</title>

    <style>
        #welcome {
            padding: 12px 12px;
            /* top right bottom left */
        }

        .card-box {
            position: relative;
            color: #fff;
            padding: 20px 10px 40px;
            margin: 20px 0px;
        }

        .card-box:hover {
            text-decoration: none;
            color: #f1f1f1;
        }

        .card-box:hover .icon i {
            font-size: 100px;
            transition: 1s;
            -webkit-transition: 1s;
        }

        .card-box .inner {
            padding: 5px 10px 0 10px;
        }

        .card-box h3 {
            font-size: 27px;
            font-weight: bold;
            margin: 0 0 8px 0;
            white-space: nowrap;
            padding: 0;
            text-align: left;
        }

        .card-box p {
            font-size: 15px;
        }

        .card-box .icon {
            position: absolute;
            top: auto;
            bottom: 5px;
            right: 5px;
            z-index: 0;
            font-size: 72px;
            color: rgba(0, 0, 0, 0.15);
        }

        .card-box .card-box-footer {
            position: absolute;
            left: 0px;
            bottom: 0px;
            text-align: center;
            padding: 3px 0;
            color: rgba(255, 255, 255, 0.8);
            background: rgba(0, 0, 0, 0.1);
            width: 100%;
            text-decoration: none;
        }

        .card-box:hover .card-box-footer {
            background: rgba(0, 0, 0, 0.3);
        }

        .bg-blue {
            background-color: #00c0ef !important;
        }

        .bg-green {
            background-color: #00a65a !important;
        }

        .bg-orange {
            background-color: #f39c12 !important;
        }

        .bg-red {
            background-color: #d9534f !important;
        }
    </style>
</head>

<body>
    <!-- NAV START -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="menu-collapsed">DCMS</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../main/index.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
                <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        <a class="dropdown-item" href="pending.php">Request</a>
                        <a class="dropdown-item" href="#top"></a>
                        <a class="dropdown-item" href="#top">Tasks</a>
                        <a class="dropdown-item" href="#top">Etc ...</a>
                    </div>
                </li><!-- Smaller devices menu END -->
            </ul>
        </div>
    </nav><!-- NavBar END -->

    <!-- Row START -->
    <div class="row" id="body-row">
        <!-- Sidebar -->
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
            <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
            <!-- Bootstrap List Group -->
            <ul class="list-group">
                <!-- Separator with title -->
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <!-- /END Separator -->
                <!-- Submenu content -->
                <div id='submenu1' class="collapse sidebar-submenu">
                    <a href="event.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Home submenu</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Home submenu</span>
                    </a>
                </div>
                
                <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Request</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu3' class="collapse sidebar-submenu">
                    <a href="pending.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Pending</span>
                    </a>
                    <a href="approved.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Approved</span>
                    </a>
                    <a href="request.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">All Request</span>
                    </a>
                </div>
                <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Chair of SC</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu4' class="collapse sidebar-submenu">
                    <a href="chair.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Chair Information</span>
                    </a>
                </div>
            </ul><!-- List Group END-->
        </div><!-- sidebar-container END -->


        <!-- MAIN -->
        <div class="col p-4 mt-3">
            <!-- <h1 class="display-4">Collapsing Sidebar Menu</h1> -->
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h5 class="mb-2" id="welcome">Welcome back, Dear PA!</h5>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <h5 class="card-header font-weight-light">Dashboard</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-orange">
                                <div class="inner">
                                    <?php echo '<h3>' . $rowRcp .  '</h3>' ?>
                                    <p> Pending </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="pending.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-green">
                                <div class="inner">
                                    <?php echo '<h3>' . $rowApp . '</h3>'; ?>
                                    <p> Approved </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                </div>
                                <a href="approved.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-blue">
                                <div class="inner">
                                    <?php echo '<h3>' . $rowCert . '</h3>'; ?>
                                    <p> Total Requests </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-certificate" aria-hidden="true"></i>
                                </div>
                                <a href="request.php" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- SCRIPT START -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="jquery-3.2.1.min.js"></script>

    <script src="Controller/pendingController.js"></script>

    <script>
        function goBack() {
            location.replace("choice.html") //loads the previous URL in the history list
        }
    </script>

</body>

</html>