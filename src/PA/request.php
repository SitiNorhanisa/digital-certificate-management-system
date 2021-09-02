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
    <title>All Requests</title>

    <style>
        .btn {
            border-radius: 25px;
        }

        .card {
            width: 100%;
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
                        <a class="dropdown-item" href="#top">Dash</a>
                        <a class="dropdown-item" href="#top">Profile</a>
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
                        <span class="menu-collapsed">All Requests</span>
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
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default mb-2" onclick="goBack()" id="backBtn" style><i class="fa fa-arrow-left" aria-hidden="true"></i> </button>
                </div>
            </div>
            <div class="card">
                <!-- Card header -->
                <h5 class="card-header font-weight-light">All Requests</h5>
                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12 text-center" style="overflow-x:auto;">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                        </div>
                    </div>
                    <div class="row margin-bottom-10">
                        <div class="col-md-12" style="overflow-x: auto;">
                            <div class="row pt-2" id="allRequestTable">
                                <table class="table table-striped" id="allRequestTbl">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="display: none;">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">NRIC</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyAllRequest"></tbody>
                                </table>
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

    <script src="Controller/allRequestController.js"></script>
    <script>
        function goBack() {
            window.history.back(); //loads the previous URL in the history list
        }
    </script>

</body>

</html>