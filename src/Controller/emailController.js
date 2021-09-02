$(document).ready(function() {
    console.log("From email controller");

    showEvent();

    function showEvent() {
        console.log("showEvent()");
        output = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveEvent.php",
            dataType: "json",
            success: function(data) {
                console.log(data);
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                for (var i = 0; i < x.length; i++) {
                    var eventFullName = encodeURI(x[i].eventName);
                    output +=
                        "<div class='col-md-4 col-sm-4'><div class='servive-block servive-block-red'><h6 class='heading-md color-light'>" +
                        x[i].eventName +
                        "</h6><a><button type='button' id='emailList' class='btn btn-outline-light emailList' data-eventid='" + x[i].eventId + "'>More <i class='fas fa-chevron-right'></i></button></a></div></div > ";
                }

                $("#eventCard").append(output);
            },
        })
    }

    //To list all the participant according to program
    $("#eventCard").on("click", ".emailList", function() {
        console.log("Button email clicked");
        selectedID = $(this).attr("data-eventid");
        console.log(selectedID);

        document.getElementById("emailCard").style.display = "block";
        allParticipant(selectedID);
        $('#emailTable tbody').empty();
    });

    function allParticipant(selectedID) {
        let output = "";

        $.ajax({
            method: "GET",
            url: "../Model/retrieveEmail.php",
            data: {
                selectedID: selectedID
            },
            dataType: "JSON",
            success: function(data) {
                var x;
                var classBtn;
                var btnProperty;
                var checkboxProperty;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                if (x.length < 1) {
                    output += "<tr><td colspan='7'><p><strong>Participant(s) doesn't exists.<strong></p></td><tr>";
                } else {
                    for (var i = 0; i < x.length; i++) {
                        // var rcpName = encodeURI(x[i].name);

                        output +=
                            "<tr><td>" +
                            (i + 1) +
                            "</td><td style='display:none;'>" +
                            x[i].id +
                            "</td><td>" +
                            x[i].name +
                            "</td><td>" +
                            x[i].nric +
                            "</td><td>" +
                            x[i].email +
                            "</td><td>" +
                            x[i].status +
                            "</td>";
                        if ((x[i].status !== "Approved")) {
                            checkboxProperty = "disabled";
                            btnProperty = "disabled";
                            classBtn = "btn-danger";
                        } else {
                            checkboxProperty = "";
                            btnProperty = "";
                            if (x[i].emailstatus != 1) {
                                classBtn = "btn-info"; //cert is not send yet
                            } else {
                                classBtn = "btn-success";
                            }
                        }

                        output +=
                            "<td> <button class='btn btn-warning btn-sm btn-load' data-rcpid=" + x[i].id + " style='display: none;' data-load=" + x[i].id + " ><i class='fas fa-spinner fa-spin' id='iconLoad'></i></button>&nbsp<button class='btn " + classBtn + " btn-sm btn-email' data-rcpid=" + x[i].id + " data-rcpemail=" + x[i].email + " data-rcpname='" + x[i].name + "' data-rcpnric=" + x[i].nric + " data-envelope=" + x[i].id + " data-action='single' " + btnProperty + "><i class='fa fa-envelope'></i></button></td>" +
                            "<td><input type='checkbox' name='single-select' class='single-select' data-rcpid=" + x[i].id + " data-rcpemail=" + x[i].email + " data-rcpname='" + x[i].name + "' id='checkbox-email' " + checkboxProperty + " /></td></tr>";
                    }
                    output += "<tr><td colspan='6'></td><td><button class='btn btn-info btn-sm btn-email' id='bulk_email' name='bulk_email' data-action='bulk' >Send bulk</button></td></tr>";
                }

                $("#tbody").append(output);
            },
        });
    }

    //Show progress bar when sending email
    function progress_bar_process(percentage, timer) {
        $('.progress-bar').css('width', percentage + '%');
        if (percentage > 100) {
            clearInterval(timer);
            $('#sample_form')[0].reset();
            $('#process').css('display', 'none');
            $('.progress-bar').css('width', '0%');
            $('#save').attr('disabled', false);
            $('#success_message').html("<div class='alert alert-success'>Data Saved</div>");
            setTimeout(function() {
                $('#success_message').html('');
            }, 5000);
        }
    }

    //to email certificate
    $("#tbody").on("click", ".btn-email", function() {
        console.log("Button email");
        let rcpid = $(this).attr("data-rcpid");
        let rcpemail = $(this).attr("data-rcpemail");
        let rcpname = $(this).attr("data-rcpname");
        // let rcpnric = $(this).attr("data-rcpnric");
        let action = $(this).attr("data-action");

        var email_data = [];

        if (action == 'single') {
            email_data.push({
                rcpid: rcpid,
                email: rcpemail,
                rcpname: rcpname,
                // rcpnric: rcpnric
            });
            // console.log(email_data);

        } else {

            $(".single-select").each(function() {
                if ($(this).prop("checked") == true) {
                    email_data.push({
                        rcpid: $(this).data("rcpid"),
                        email: $(this).data("rcpemail"),
                        rcpname: $(this).data("rcpname"),
                    });
                }
            });
            // console.log(email_data);
        }
        $("#process").show();

        $.ajax({
            url: "../Model/emailCert.php",
            method: "POST",
            data: {
                email_data: email_data
            },
            beforeSend: function() {
                var percentage = 0;
                var timer = setInterval(function() {
                    percentage = percentage + 20;
                    progress_bar_process(percentage, timer);
                }, 1000)
                $("#bulk_email").prop("disabled", true);

            },
            success: function(data) {
                if (data == "Okay") {
                    alert("Successfully email to participant");
                    updateEmail(email_data);
                    $("#bulk_email").prop("disabled", false);
                    location.reload();
                } else {
                    alert(data);
                    $("#bulk_email").prop("disabled", false);
                    location.reload();
                }
            }
        });
    });

    // Update email status
    function updateEmail(email_data) {
        // console.log(email_data);
        $.ajax({
            url: "../Model/updateEmailStat.php",
            method: "POST",
            data: {
                email_data: email_data
            },
            success: function(data) {
                if (data == "1") {
                    console.log("Berjaya update email status")
                } else {
                    console.log("Tidak berjaya update email status");
                }
            }
        });
    }
});