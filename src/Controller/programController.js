$(document).ready(function() {

    console.log("Connected to program controller");
    // Covert to uppercase
    $('input[type=text]').val(function() {
        return this.value.toUpperCase();
    });


    //Display Only Date till today
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1; // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#eventDate').attr('max', maxDate);

    //Show all event
    showEvent();
    showListProgram();

    function showEvent() {

        output = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveEvent.php",
            dataType: "json",
            success: function(data) {
                //  console.log(JSON.parse(data));
                // console.log(data);
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                for (var i = 0; i < x.length; i++) {
                    var eventFullName = encodeURI(x[i].eventName);
                    // <i class='fas fa-running'></i>
                    output +=
                        "<div class='col-md-4 col-sm-6'><div class='servive-block servive-block-blue'> <i class='icon-2x color-light fas fa-running'></i><h2 class='heading-md'>" +
                        x[i].eventName +
                        "</h2><p>" +
                        x[i].eventVenue +
                        "</p><p>" +
                        x[i].eventDate +
                        "</p><a href=choice.php?id=" + x[i].eventId + "><button type='submit' id='createCert' class='btn btn-outline-light createCert' data-eventid='" + x[i].eventId + "'>Start</button></a></div></div > ";

                }

                $("#eventCard").append(output);
            },
        });
    } //End showEvent()

    function showListProgram() {
        outputList = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveEvent.php",
            dataType: "json",
            success: function(data) {
                //  console.log(JSON.parse(data));
                // console.log(data);
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }

                for (var i = 0; i < x.length; i++) {

                    outputList +=
                        "<tr><td>" + (i + 1) +
                        "</td><td style='display:none;'>" +
                        x[i].eventId +
                        "</td><td>" + x[i].eventName +
                        "</td><td>" + x[i].eventDate +
                        "</td><td>" + x[i].eventVenue +
                        "</td><td>" + x[i].eventSession +
                        "</td><td>" + x[i].rowCount +
                        "</td><td><button class='btn btn-light btn-sm btn-view' data-eventid=" + x[i].eventId + "><i class='fas fa-eye'></i></button>&nbsp<button class='btn btn-danger btn-sm btn-del' data-eventid=" + x[i].eventId + "><i class='fas fa-trash'></button></td></tr>";

                }

                $("#tbodyListProg").append(outputList);
            },
        });
    }

    $("#eventBtn").click(function() {
        // $("#form1").toggle();
        // console.log("eventBtn clicked ")
        if (document.getElementById("addEventForm").style.display === "none") {
            document.getElementById("addEventForm").style.display = "block";
            // console.log("form1 is block");
        } else {
            document.getElementById("addEventForm").style.display = "none";
            // console.log("form1 is none");
        }

    }); //End eventBtn

    //cancel event 
    $("#cancelBtn").click(function(e) {
        e.preventDefault();
        //clear form
        document.getElementById("eventName").value = "";
        $("#addEventForm").css("display", "none");
    });

    //To add event
    $("#addEventForm").submit(function(e) {
        e.preventDefault();
        // console.log("Add new event!");
        let eventName = $('#eventName').val();
        let eventDate = $('#eventDate').val();
        let eventVenue = $('#eventVenue').val();
        let eventSession = $('#eventSession').val();
        // console.log(eventName + " " + eventId);
        // console.log(eventDesc);
        // console.log(eventDate);

        myEvent = { eventname: eventName, eventdate: eventDate, eventVenue: eventVenue, eventSession: eventSession };
        // console.log(myEvent);

        $.ajax({
            method: "POST",
            url: "../Model/addEvent.php",
            data: JSON.stringify(myEvent),
            success: function(data) {
                if (data == "OK") {
                    // console.log("Success add event");
                    alert("Successfully added program to database");
                    location.reload();
                } else {
                    // console.log(data)
                }
                //clear form
                document.getElementById("eventName").value = "";

            }
        });
    }); //End add event

    // To insert participant details
    $("#eventCard").on("click", ".createCert", function() {
        // console.log("Button create clicked");
        // console.log($(this).attr("data-eventid"));
    });

    // To delete program
    $("#tbodyListProg").on("click", ".btn-del", function() {
        let event_id = $(this).attr("data-eventid");
        // console.log("Deleted id: " + event_id);

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete this program?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: "../Model/deleteEvent.php",
                    data: { eventID: event_id },
                    dataType: "JSON",
                    success: function(response) {
                        if (!(response == 0)) {
                            alert("Program deleted");
                        } else {
                            alert("Failed to delete");
                        }
                        location.reload();

                    }
                });
            }
        })
    });

    //to view participant detail
    $("#tbodyListProg").on("click", ".btn-view", function() {
        let event_id = $(this).attr("data-eventid");
        // console.log("View id: " + event_id);
        modalOutput = "";
        modalHeader = "";

        $.ajax({
            url: "../Model/retrieveCertStatus.php",
            method: "POST",
            data: { eventID: event_id },
            dataType: "JSON",
            success: function(data) {
                var x;
                if (data == 0) {
                    // console.log("You are not yet add participants");
                    modalOutput += "<tr><td colspan='5'><p><strong>Participant(s) doesn't exists.<strong></p></td><tr>";

                } else {
                    if (data) {
                        x = data;
                    } else {
                        x = "";
                    }
                    // console.log(x[1].name);
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
                            "</td><td><button class='btn btn-danger btn-sm btn-del' data-rcpid=" + x[i].id + "><i class='fas fa-trash'></button><td></tr>";
                    }

                }
                modalHeader += "<h4 class='modal-title'>Participant Information</h4><button type='button' id='closeBtn' class='close' data-dismiss='modal'&times;</button>";

                $("#modalHeader").html(modalHeader); //to show modal header
                $("#modalBody").html(modalOutput); //to append data to modal table
                $('#add_data_Modal').modal('show'); //to show modal
            },
        }); //end AJAX
    });

    // to delete participant based on selected event
    $("#modalBody").on("click", ".btn-del", function() {
        let rcp_id = $(this).attr("data-rcpid");
        // console.log("Selected recipient id: " + rcp_id);
        dataDelete = { ID: rcp_id };
        mythis = this;
        $.ajax({
            type: "POST",
            url: "../Model/test_userAction_delete.php",
            data: JSON.stringify(dataDelete),
            // dataType: "",
            success: function(response) {
                if (response == 1) {
                    alert("Delete successful");
                    $(mythis).closest("tr").fadeOut();

                } else {
                    alert("Fail to delete");
                }
            }
        });

    });

});