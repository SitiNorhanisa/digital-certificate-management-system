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

    <title>Verification</title>

    <style>
        .btn {
            border-radius: 25px;
        }

        .yellow-color {
            color: #f0ad4e;
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
                    <a class="nav-link" href="../main/index.php">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
        </div>
    </nav>
    <!-- NavBar END -->

    <div class="col p-4 mt-5">
        <div class="card">
            <!-- Card header -->
            <h5 class="card-header font-weight-light">Verify the certificate</h5>
            <div class="card-body">
                <div class="row margin-bottom-10">
                    <div class="col-md-12 text-center" style="overflow-x:auto;">

                    </div>
                </div>
                <div class="row margin-bottom-10">
                    <div class="col-md-12" style="overflow-x:auto;">
                        <div class="" id="">
                            <form id="verifyForm">
                                <div class="form-group">
                                    <label for="uniqueID">Certificate ID</label>
                                    <input type="text" class="form-control" id="uniqueID" placeholder="Insert certificate id">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Verify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row margin-bottom-10">
                    <div class="col-md-12 text-center" style="overflow-x: auto;">
                        <div class="row pt-5 text-center" id="verifyTable" style="display: none;">
                            <table class="table table-striped" id="verifyTbl">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Certificate ID</th>
                                        <th scope="col">Recipient Name</th>
                                        <th scope="col">Program Name</th>
                                        <th scope="col">Approved by</th>
                                        <th scope="col">Created</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyVerify"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<!-- script start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../Controller/verifyController.js"></script>

</html>