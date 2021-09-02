$(document).ready(function() {
    console.log("From pendingController.js from pending.php");

    // to filter search
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbodyPending tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //Display directly list of pending request
    showPending();

    function showPending() {
        output = "";
        $.ajax({
                method: "GET",
                url: "./Database/retrievePending.php",
                dataType: "JSON",
                success: function(data) {
                    var x;
                    if (data) {
                        x = data;
                    } else {
                        x = "";
                    }
                    if (x.length < 1) {
                        output += "<tr><td>No pending request(s)</td></tr>";
                    } else {
                        for (var i = 0; i < x.length; i++) {
                            output +=
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
                                "</td><td style='display:none;'>" +
                                x[i].approvalStatus +
                                "</td><td>" + "<button class='btn btn-light btn-sm btn-view' data-rcpid=" + x[i].id + "><i class='fas fa-eye'></i></button>" +
                                "</td><td><button class='btn btn-success btn-sm btn-approve' data-rcpid=" + x[i].id + "><i class='fa fa-check' aria-hidden='true'></i></button>&nbsp<button class='btn btn-danger btn-sm btn-reject' data-rcpid=" + x[i].id + "><i class='fa fa-times' aria-hidden='true'></i></button></td></tr>";
                            // console.log(x[i].name + " " + x[i].id);
                        }
                    }
                    $("#tbodyPending").html(output);
                },
            }) //End ajax
    } //End showPending()

    //To view recipient details
    $("#tbodyPending").on("click", ".btn-view", function() {
        // console.log("Button preview clicked");
        rcpId = $(this).attr("data-rcpid");
        // console.log("Selected id: " + rcpId);
        // $('#modalPending').modal('show');
        $.ajax({
            type: "GET",
            url: "./Database/viewPendingRcp.php",
            data: { rcpId: rcpId },
            dataType: "JSON",
            success: function(response) {
                if (response == 0) {
                    alert("No pending request");

                } else {
                    if (response) {
                        data = response;
                    } else {
                        data = "";
                    }

                    for (let i = 0; i < data.length; i++) {
                        $('#rcp_id').val(data[i].rcpID);
                        $('#rcp-name').val(data[i].rcpName);
                        $('#rcp-nric').val(data[i].rcpIC);
                        $('#matricno').val(data[i].matricno)
                        $('#rcp-prog').val(data[i].program);
                        $('#prog-venue').val(data[i].progVenue);
                        $('#prog-date').val(data[i].progDate);
                        $('#prog-session').val(data[i].progSession);
                        $('#rcp-email').val(data[i].rcpEmail);

                        $('#modalPending').modal('show');
                    }
                }
            }
        });
    });

    //To approve pending request
    $("#tbodyPending").on("click", ".btn-approve", function(e) {
        e.preventDefault();
        // console.log("Approve edit clicked");
        // console.log($(this).attr("data-rcpid"));
        var id = $(this).attr("data-rcpid");
        // console.log(id);
        // mydata = { rcpid: id };
        $.ajax({
            url: "./Database/updateApproval.php",
            method: "GET",
            data: {
                id: id,
                status: "approved"
            },
            success: function(dt) {
                // console.log("Tak masuk db");
                if (dt == "OK") {
                    // console.log("Successfully Updated");
                    alert("Successfully approved");
                    location.reload();
                } else
                    alert(dt);
            },
        });
    });

    //To reject pending request
    $("#tbodyPending").on("click", ".btn-reject", function(e) {
        e.preventDefault();
        // console.log("Reject button clicked");
        // console.log($(this).attr("data-rcpid"));

        var id = $(this).attr("data-rcpid");
        // console.log(id);
        // mydata = { rcpid: id };
        $.ajax({
            url: "./Database/updateApproval.php",
            method: "GET",
            data: {
                id: id,
                status: "rejected"
            },
            success: function(dt) {
                // console.log(dt);

                if (dt == "OK") {
                    // console.log("Successfully Updated");
                    alert("Successfully rejected");
                    location.reload();
                } else
                    alert(dt);
                // console.log(dt);

            },
        });
    });

});