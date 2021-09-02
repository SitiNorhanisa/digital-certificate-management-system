$(document).ready(function() {
    console.log("Connected to approvedController.js from approved.php");
    approvedList();

    function approvedList() {
        console.log("From approveList function");
        outputApproved = "";

        $.ajax({
            method: "GET",
            url: "./Database/retrieveApproved.php",
            dataType: "json",
            success: function(data) {
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                if (x.length < 1) {
                    outputApproved += "<tr><td colspan='7'><strong>No certificate(s) has been approved</strong> </td></tr> ";
                } else {
                    for (var i = 0; i < x.length; i++) {
                        outputApproved +=
                            "<tr><td>" +
                            (i + 1) +
                            "</td><td style='display: none;'>" +
                            x[i].id +
                            "</td><td>" +
                            x[i].name +
                            "</td><td>" +
                            x[i].nric +
                            "</td><td>" + x[i].matricno + "</td><td>" +
                            x[i].eventName +
                            "</td><td>" +
                            x[i].eventDate +
                            "</td><td>" +
                            x[i].approvalStatus +
                            "</td><td> <button class='btn btn-light btn-sm btn-view'  data-rcpid=" + x[i].id + "><i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
                    }
                }
                $("#tbodyApproved").html(outputApproved);
            },
        }); //end AJAX request

    }

    //to view participant details with certificate
    $('tbody').on('click', '.btn-view', function() {
        var rcpID = $(this).attr('data-rcpid');
        // console.log("ID yang dipilih ialah: " + rcpID);

        $.ajax({
            type: "GET",
            url: "Database/viewApprovedRcp.php",
            data: { rcpId: rcpID },
            dataType: "JSON",
            success: function(response) {
                var data;
                var output = "";
                if (response == 0) {
                    alert("No data");
                } else {
                    if (response) {
                        data = response;
                    } else {
                        data = "";
                    }

                    for (let i = 0; i < data.length; i++) {
                        var certID = data[i].certID;
                        $('#cert-id').val(data[i].certID);
                        $('#rcp-name').val(data[i].rcpName);
                        $('#rcp-ic').val(data[i].rcpIC);
                        $('#matricno').val(data[i].matricno);
                        $('#event-name').val(data[i].eventName);
                        $('#event-date').val(data[i].eventDate);
                        $('#date-created').val(data[i].created);
                        $('#date-approved').val(data[i].dateApproved);
                        $('#approver').val(data[i].approver);
                        output += data[i].rcpName;
                        viewCertImg(certID)
                        $('#cert_modal').modal('show'); //to show modal

                    }
                }
            }
        });

    });

    // to display cert image
    function viewCertImg(certID) {
        var outputCertImg = "";
        outputCertImg += "<img class='img-fluid cert' src='../assets/images/certificate/" + certID + ".png' alt=''>";

        $("#certImg").html(outputCertImg);
    }

    // to filter search
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbodyApproved tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});