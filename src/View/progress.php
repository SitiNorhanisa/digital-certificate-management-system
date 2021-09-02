<?php

session_start();
$userID = $_SESSION['userID'];
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
    <link rel="stylesheet" href="css/main.css">
    <title>Certificate Status</title>

    <style>
        .btn {
            border-radius: 25px;
        }

        body .modal-dialog {
            max-width: 100%;
            width: auto !important;
            display: inline-block;
        }

        .modal {
            text-align: center;
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
                    <a class="nav-link" href="#top">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../main/index.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>
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

                <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Program</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu3' class="collapse sidebar-submenu">
                    <a href="program.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Add Program</span>
                    </a>
                    <a href="programList.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Manage Program</span>
                    </a>
                </div>
                <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fas fa-clipboard mr-3"></span>
                        <span class="menu-collapsed">Approval Status</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu4' class="collapse sidebar-submenu">
                    <a href="progress.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Progress</span>
                    </a>
                </div>

                <a href="#submenu5" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fas fa-envelope mr-3"></span>
                        <span class="menu-collapsed">Email</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu5' class="collapse sidebar-submenu">
                    <a href="email.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Status</span>
                    </a>
                </div>
                <!-- Separator with title -->
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>OPTIONS</small>
                </li>
                <!-- /END Separator -->
                <a href="#submenu6" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fas fa-file-download mr-3"></span>
                        <span class="menu-collapsed">Download</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu6' class="collapse sidebar-submenu">
                    <a href="downloadPNG.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">PNG</span>
                    </a>
                    <a href="downloadPDF.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">PDF</span>
                    </a>
                </div>

                <!-- Separator without title -->
                <li class="list-group-item sidebar-separator menu-collapsed"></li>
                <!-- /END Separator -->

            </ul><!-- List Group END-->
        </div><!-- sidebar-container END -->

        <!-- MAIN -->
        <div class="col p-4 mt-3">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default mb-2" onclick="goBack()" id="backBtn" style><i class="fas fa-arrow-left"></i></button>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header font-weight-light">Approval Progress</h5>
                <div class="card-body" style="display: none;">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12 text-center">
                            <form class="col-mt-5" id="upload_form" method="POST" enctype="multipart/form-data">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlFile1">Approval Progress <?php echo $eventID; ?> </label>
                                    <input type="text" class="form-control" value="<?php echo $eventID; ?>" id="eventid" disabled />
                                    <input type="text" class="form-control" value="<?php echo $eventName; ?>" id="eventName" disabled />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Display approval status -->
                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12" style="overflow-x:auto;">
                            <table class="table table-striped" id="data-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="display: none;">ID</th>
                                        <th scope="col">Event Name</th>
                                        <th scope="col">Session</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <!-- list of event -->
                <div class="row margin-bottom-10" id="eventCard">

                </div>
            </div>
        </div>
        <!--MAIN END  -->

        <div> <br></div>
    </div><!-- Row END -->

    <!-- DATA MODAL START -->
    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="closeBtn" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Approval Progress</h4>
                </div>
                <div class="modal-body" id="event_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <!-- insert header from displayCertController -->

                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-striped" id="event_progress">
                        <thead id="tableHead" class="thead-dark">
                            <tr>
                                <th scope="col ">#</th>
                                <th scope="col " style="display: none;">ID</th>
                                <th scope="col ">Name</th>
                                <th scope="col ">NRIC</th>
                                <th scope="col ">Email</th>
                                <th scope="col ">Progress</th>
                            </tr>
                        </thead>
                        <tbody id="modalBody">
                        </tbody>
                    </table>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeBtn">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- DATA MODAL END -->

    <br>

    <!-- SCRIPT START -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function goBack() {
            window.history.back(); //loads the previous URL in the history list
        }
        // Hide submenus
        $('#body-row .collapse').collapse('hide');

        // Collapse/Expand icon
        $('#collapse-icon').addClass('fa-angle-double-left');

        // Collapse click
        $('[data-toggle=sidebar-colapse]').click(function() {
            SidebarCollapse();
        });

        function SidebarCollapse() {
            $('.menu-collapsed').toggleClass('d-none');
            $('.sidebar-submenu').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

            // Treating d-flex/d-none on separators with title
            var SeparatorTitle = $('.sidebar-separator-title');
            if (SeparatorTitle.hasClass('d-flex')) {
                SeparatorTitle.removeClass('d-flex');
            } else {
                SeparatorTitle.addClass('d-flex');
            }

            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        }
    </script>

    <script src="../Controller/displayCertController.js"></script>

</body>

</html>