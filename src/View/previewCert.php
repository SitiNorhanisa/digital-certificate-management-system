<?php
include("../Model/dbConnection.php");
session_start();

$userID = $_SESSION['userID'];
$_SESSION["bgID"] = $_GET["id"];
$eventID = $_GET["id"];

$sql = "SELECT * FROM event WHERE eventID='$eventID'";
$fire2 = $conn->query($sql);

if ($fire2->num_rows > 0) {
    while ($row = mysqli_fetch_array($fire2)) {
        $eventName = $row['eventName'];
        $eventCert = $row['eventCert'];
    }
}

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

    <title>Upload and Preview</title>

    <style>
        .btn {
            border-radius: 25px;
        }

        .form-control {
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
                    <a class="nav-link" href="../main/index.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></a>
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

                <!-- Submenu content -->
                <div id='submenu1' class="collapse sidebar-submenu">
                    <a href="event.php" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Add program</span>
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
                    <button type="button" class="btn btn-default mb-2" onclick="goBack()" id="backBtn" style><i class="fas fa-arrow-left"></i></button>
                    <?php
                    if ($eventCert == '') {
                    ?>
                        <button type="button" class="btn btn-primary mb-2 float-right" id="requestBtn" data-eventID="<?php echo $eventID; ?>" disabled>Request Approval <i class="fa fa-share"></i></button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-primary mb-2 float-right" id="requestBtn" data-eventID="<?php echo $eventID; ?>">Request Approval <i class="fa fa-share"></i></button>
                    <?php
                    } ?>
                </div>
            </div>

            <!-- CARD START -->
            <div class="card">
                <h5 class="card-header font-weight-light">Design and Preview</h5>
                <div class="card-body">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                                <input type="text" value="<?php echo $eventID; ?>" id="eventid" class="form-control title-header" style="display: none;" disabled />
                                <input type="text" value="<?php echo $eventName; ?>" id="eventname" class="form-control" disabled />
                                <br>
                                <h6>Please choose : </h6>
                            </div>
                            <div class="col-sm-12">
                                <form id="designSelection">
                                    <fieldset class="form-group">
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="selection" id="upload" value="Upload design" onclick="designSelection()" required>
                                                <label class="form-check-label" for="upload">
                                                    Upload design
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="selection" id="template" value="Ready made template" onclick="designSelection()">
                                                <label class="form-check-label" for="template">
                                                    Template
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Upload Design Selection -->
                <div class="card-body" id="uploadDesign" style="display: none;">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12">
                            <form class="col-mt-3" id="upload_form" method="POST" enctype="multipart/form-data">
                                <div class="col-sm-12">
                                    <form class="uploadForm" enctype="multipart/form-data">
                                        <h6>Please upload blank certificate design in PORTRAIT mode (*.png).</h6>
                                        <input type="file" class="form-control" id="bg-file" name="image-bg" accept="image/*">
                                        <button type="button" class="btn btn-info my-3 float-right" id="uploadBtn" name="upload-bg" value="Upload" data-bgID="<?php $eventID; ?>">Upload <i class="fas fa-upload"></i></button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-12">

                            <?php

                            if ($eventCert == '' || $eventCert == "sample-latest-4.png") {
                            ?>
                                <h4 style="text-align: center;">No certificate uploaded </h4>
                            <?php
                            } else {
                            ?>
                                <img src="../Model/displayUploadDesign.php?id=<?php echo $eventID ?>" alt="Sample certificate" style='width: 100%; height : 100%; object-fit: contain; border: 3px solid #555;' />
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>

                <!-- Ready Made Template Selection -->
                <div class="card-body" id="readyMade" style="display: none;">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12">
                            <div class="col-sm-12">
                                <h6>Ready Made Template</h6>
                                <h6>Please preview the template. If you agree with the design, please click "confirm" button.</h6>
                                <button type="button" class="btn btn-info my-3 float-right confirmBtn" id="confirmBtn">Confirm</button>
                                <img src="../assets/images/sample-latest-4.png" style='width: 100%; height : 100%; object-fit: contain; border: 3px solid #555;'>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- CARD END -->
        </div>
        <!-- Main Col END -->
    </div>
    <!-- ROW END -->


    <!-- <a href="../Model/uploadDesignTemplate.php"></a> -->

    <!-- SCRIPT START -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="../Controller/uploadBgController.js"></script>

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
        $('#requestBtn').click(function(e) {
            e.preventDefault();
            var eventid = $(this).attr("data-eventID");
            // console.log("Program yang dipilih ialah: " + eventid);
            let data = {
                "eventid": eventid
            };
            $.ajax({
                type: "POST",
                url: "../Model/sendRequest.php",
                data: {
                    "eventid": eventid
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == 1) {
                        alertFunction();
                    } else {
                        alert("Fail to send request for approval");
                    }

                }
            });

        });

        function alertFunction() {
            alert("Successfully submit for review. Please wait for the approval.");
            // window.location.href = 'progress.php?id=<?php echo $eventID; ?>'
            window.location.href = 'progress.php'
        }
    </script>



</body>

</html>