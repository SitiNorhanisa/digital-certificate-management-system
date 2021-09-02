$(document).ready(function() {
    let eventID = document.getElementById("eventid").value;
    console.log("Connected to displayCertController");
    console.log("Current event id: " + eventID);
    displayAllCert();

    //display All program created by PERSAKA
    function displayAllCert() {
        console.log("Come from displayAllCert fn");

        output = "";
        $.ajax({
            method: "GET",
            url: "../Model/displayAllCertProgress.php",

            dataType: "JSON", //receive data from server as json
            success: function(data) {

                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                for (var i = 0; i < x.length; i++) {
                    output +=
                        "<tr><td>" +
                        (i + 1) +
                        "</td><td style='display:none;'>" +
                        x[i].eventId +
                        "</td><td>" +
                        x[i].eventName +
                        "</td><td>" +
                        x[i].eventSession +
                        "</td><td> <button id='" + x[i].eventId + "' name='view' class='btn btn-info btn-sm btn-view'  data-eventid=" + x[i].eventId + " data-eventName='" + x[i].eventName + "'><i class='fas fa-eye'></i></button>&nbsp<button id='" + x[i].eventId + "' class='btn btn-danger btn-sm btn-del' data-rcpid=" + x[i].id + "><i class='fa fa-trash'></i></button></td></tr>";

                }
                $("#tbody").html(output);
            },
        });
    }


    //to dislay modal table with participant details
    $('tbody').on('click', '.btn-view', function() {
        var eventID = $(this).attr("id");
        var eventName = $(this).attr("data-eventName")
        console.log("Event ID selected: " + eventID);
        console.log("Event name selected: " + eventName);

        modalOutput = "";
        modalHeader = "";

        $.ajax({
            url: "../Model/retrieveCertStatus.php",
            method: "POST",
            data: { eventID: eventID },
            dataType: "JSON",
            success: function(data) {
                var x;
                if (data == 0) {
                    console.log("You are not yet add participants");
                    modalOutput += "<tr><td colspan='5'><p><strong>Participant(s) doesn't exists.<strong></p></td><tr>";

                } else {
                    if (data) {
                        x = data;
                    } else {
                        x = "";
                    }

                    modalHeader += "";
                    for (var i = 0; i < x.length; i++) {

                        modalOutput +=
                            "<tr><td>" +
                            (i + 1) +
                            "</td><td style='display: none;'>" +
                            x[i].id +
                            "</td><td>" +
                            x[i].name +
                            "</td><td>" +
                            x[i].nric +
                            "</td><td>" +
                            x[i].email +
                            "</td><td>" +
                            x[i].approval_status +
                            "</td></tr>";
                    }
                }
                modalHeader += "<h4 class='modal-title'>" + eventName + "</h4><button type='button' id='closeBtn' class='close' data-dismiss='modal'&times;</button>";

                $("#modalHeader").html(modalHeader); //to show modal header
                $("#modalBody").html(modalOutput); //to append data to modal table
                $('#add_data_Modal').modal('show'); //to show modal
            },
        }); //end AJAX
    }); //end display progress


    // to delete all participant based on event id
    $('tbody').on('click', '.btn-del', function() {
        var eventID = $(this).attr("id");
        console.log("Deleted event is " + eventID);

        Swal.fire({
                title: 'Are you sure?',
                html: "You want to delete this program and its participants?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "../Model/deleteEventParticipant.php",
                        method: "GET",
                        data: { eventID: eventID },
                        dataType: "JSON",
                        success: function(data) {

                            if (data == 0) {
                                console.log("Failed to delete the event and its recipient");
                            } else {
                                console.log("Successfully deleted eventID=" + eventID);
                                displayAllCert();
                            }

                        },
                    }); //end AJAX
                }
            }) //end Swal
    });
});