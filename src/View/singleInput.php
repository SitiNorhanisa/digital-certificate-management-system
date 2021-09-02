<?php
include("../Model/dbConnection.php");
session_start();
$eventID = $_GET["id"];

$sql = "SELECT * FROM event WHERE eventID='$eventID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $eventName = $row['eventName'];
        $eventid = $row['eventID'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>

    <link rel="stylesheet" href="css/main.css">
    <title>Single Input</title>

    <style>
        .btn {
            border-radius: 25px;
        }

        .errorMsg {
            color: red;
            font-size: 1rem;
            display: none;
            margin-top: 5px;
        }

        input.error,
        textarea.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }

        td {
            word-wrap: break-word;
        }

        /* .inputText {
            text-transform: uppercase;
        } */
    </style>
</head>

<body>

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

                <!-- Submenu content -->
                <div id='submenu1' class="collapse sidebar-submenu">
                    <a href="event.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Add Program</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Manage program</span>
                    </a>
                </div>
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
            <!-- <h1 class="display-4">Collapsing Sidebar Menu</h1> -->
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default mb-2" onclick="goBack()" id="backBtn" style><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-primary mb-2 float-right" id="certBtn" onclick="location.href='previewCert.php?id=<?php echo $eventID; ?>'">Upload Design <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header font-weight-light">Add participant</h5>
                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12">
                            <form class="col-mt-5" id="rcpForm">
                                <div class="form-group">
                                    <label for="eventid" class="form-label">Program Name</label>
                                    <input type="text" class="form-control" id="eventName" value="<?php echo $eventName; ?>" disabled />
                                    <input type="text" class="form-control" id="eventID" value="<?php echo $eventID; ?>" readonly style="display: none;" />

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="rcpid" style="display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="rcpname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control inputText" id="nameid" name="rcpname" onkeyup="this.value = this.value.toUpperCase()" placeholder="Full name as per NRIC" required />
                                </div>
                                <div class="form-group">
                                    <label for="rcpnric" class="form-label">NRIC/Passport</label>
                                    <input type="text" class="form-control" id="nricid" name="rcpnric" placeholder="123456-78-9012" required />
                                    <div class="errorMsg" id="errorMsg">
                                        <p>NRIC is required!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="matric_no" class="form-label">Matric No.</label>
                                    <input type="text" class="form-control" id="matricno" name="matricno" onkeyup="this.value = this.value.toUpperCase()" placeholder="A17CS0211" required />
                                    <div class="errorMsg" id="errorMsg">
                                        <p>Matric No. is required!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rcpemail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailid" name="rcpemail" placeholder="youremail@example.com" required />
                                    <div class="errorMsg" id="errorMsg">
                                        <p>The email should be in the format: abc@domain.tld</p>
                                    </div>
                                </div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="btnadd" data-eventName="<?php $eventName; ?>">Add</button>
                                   
                                </div>
                                <div id="msg"></div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12" style="overflow-x:auto;">
                            <h5 class="alert-warning p-2" style="text-align: center;">Participants Information</h5>
                            <table class="mt-3 table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col ">#</th>
                                        <th scope="col " style="display: none;">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">NRIC/Passport</th>
                                        <th scope="col">Matric No.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="tbody" style="font-size: 16px;"></tbody>

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

        <div> <br></div>
    </div><!-- Main Col END -->

    <div>
        <!-- Row END -->

        <!-- DATA MODAL START -->
        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Participant Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="participant_detail">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Participant Information</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="update_form">
                            <label>Full Name</label>
                            <input type="text" name="rcp_name" id="rcp_name" onkeyup="this.value = this.value.toUpperCase()" class="form-control inputText" />
                            <br />
                            <label>NRIC/Passport</label>
                            <input type="text" name="rcp_nric" id="rcp_nric" class="form-control"></input>
                            <br />
                            <label>Matric No.</label>
                            <input type="text" name="matric_no" id="matric_no" onkeyup="this.value = this.value.toUpperCase()" class="form-control"></input>
                            <br />
                            <label>Email</label>
                            <input type="text" name="rcp_email" id="rcp_email" class="form-control"></input>
                            <br />
                            <input type="hidden" name="rcp_id" id="rcp_id" />
                            <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- DATA MODAL END -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <script src="../Controller/singleInputController.js"></script>
        <script>
            function goBack() {
                window.history.back() //loads the previous URL in the history list
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
</body>

</html>