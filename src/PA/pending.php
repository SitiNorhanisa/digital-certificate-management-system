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
    <title>Pending Request</title>

    <style>
        .btn {
            border-radius: 25px;
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
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default mb-2" onclick="goBack()" id="backBtn" style><i class="fa fa-arrow-left" aria-hidden="true"></i> </button>
                </div>
            </div>

            <div class="card">
                <!-- Card header -->
                <h5 class="card-header font-weight-light">Pending Request</h5>
                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12 text-center" style="overflow-x:auto;">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br>
                        </div>
                    </div>
                    <div class="row margin-bottom-10">
                        <div class="col-md-12" style="overflow-x: auto;">
                            <div class="row pt-2" id="pendingTable">
                                <table class="table table-striped" id="pendingTbl">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="display: none;">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">NRIC</th>
                                            <th scope="col">Matric No.</th>
                                            <th scope="col">Program</th>
                                            <th scope="col">Date &nbsp;<i class="fas fa-arrows-alt-v" style="display: none;"></i></th>
                                            <th scope="col" style="display: none;">Status</th>
                                            <th scope="col"></th>
                                            <th scope="col">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPending"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalPending" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recipient Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="updateUserForm" name="updateUserForm">
                        <div class="form-group row">
                            <label for="rcp-id" class="col-sm-2 col-form-label">Recipient ID</label>
                            <div class="col-sm-10"><input type="text" id="rcp_id" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="rcp-name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10"><input type="text" id="rcp-name" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="rcp-nric" class="col-sm-2 col-form-label">NRIC</label>
                            <div class="col-sm-10"><input type="text" id="rcp-nric" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="matricno" class="col-sm-2 col-form-label">Matric No.</label>
                            <div class="col-sm-10"><input type="text" id="matricno" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="rcp-prog" class="col-sm-2 col-form-label">Program</label>
                            <div class="col-sm-10"><input type="text" id="rcp-prog" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="prog-venue" class="col-sm-2 col-form-label">Venue</label>
                            <div class="col-sm-10"><input type="text" id="prog-venue" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="prog-date" class="col-sm-2 col-form-label">Program Date</label>
                            <div class="col-sm-10"><input type="text" id="prog-date" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="prog-session" class="col-sm-2 col-form-label">Session</label>
                            <div class="col-sm-10"><input type="text" id="prog-session" class="form-control" disabled></div>
                        </div>
                        <div class="form-group row">
                            <label for="rcp-email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10"><input type="text" id="rcp-email" class="form-control" disabled></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT START -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="Controller/pendingController.js"></script>
    <script>
        function goBack() {
            window.history.back(); //loads the previous URL in the history list
        }
    </script>

</body>

</html>