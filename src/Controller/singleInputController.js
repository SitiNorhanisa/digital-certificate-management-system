$(document).ready(function() {


    //Global variable
    let eventID = $('#eventID').val();
    let eventName = $('#eventName').val();

    showParticipant(eventID, eventName);

    //Ajax request for retrieving Data
    function showParticipant(eventID, eventName) {

        // var eventNameAttr = $(this).attr("data-eventName");
        // console.log(eventID);
        // console.log(eventName);
        output = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveAllParticipant.php",
            data: {
                eventID: eventID,
                eventName: eventName
            },
            dataType: "json",
            success: function(data) {
                var x;

                if (data == 0) {
                    // console.log("No data");
                    output += "<td colspan='5'><strong>No data<strong></td>";
                    $("#certBtn").prop("disabled", true); //disable button
                } else {
                    if (data) {
                        x = data;
                    } else {
                        x = "";
                    }

                    for (var i = 0; i < x.length; i++) {
                        output +=
                            "<tr><td>" + (i + 1) +
                            "</td><td style='display:none;'>" +
                            x[i].id +
                            "</td><td>" +
                            x[i].name +
                            "</td><td>" +
                            x[i].nric +
                            "</td><td>" +
                            x[i].matricno +
                            "</td><td>" +
                            x[i].email +
                            "</td><td> <button class='btn btn-warning btn-sm btn-edit'  data-rcpid=" + x[i].id + "><i class='fas fa-edit'></i></button>&nbsp<button class='btn btn-danger btn-sm btn-del' data-rcpid=" + x[i].id + "><i class='fa fa-trash'></i></button></td></tr>";
                        //<i class='fa-trash-o' style='color:red'></i>
                        // console.log(x[i].name);
                    }
                    $("#certBtn").prop("disabled", false); //disable button
                }
                $("#tbody").html(output);
            },
        });
    } //end of showData()



    //Ajax request for Insert Data
    $("#rcpForm").submit(function(e) {
        e.preventDefault(); /* stop form from submitting normally */
        // console.log("Add button clicked!");
        $("#btnadd").attr("disabled", true);
        // let eventID = $(this).attr("data-eventID");
        let idRcp = $('#rcpid').val();
        let nameRcp = $('#nameid').val();
        let nricRcp = $('#nricid').val();
        let emailRcp = $('#emailid').val();
        let matricno = $('#matricno').val();
        // console.log(eventID);
        // console.log(eventName);
        // console.log(nameRcp);
        // console.log(nricRcp);
        // console.log(emailRcp);
        // console.log(matricno);
        mydata = { id: idRcp, name: nameRcp, nric: nricRcp, matricNo: matricno, email: emailRcp, eventID: eventID, eventName: eventName };

        $.ajax({
            method: "POST",
            url: "../Model/insertParticipant.php",
            data: JSON.stringify(mydata),
            success: function(data) {

                if (data = "OK") {
                    // console.log(data);
                    alert("Successfully added to database");
                } else {
                    alert("Unable to add recipient");

                }
                $("#btnadd").attr("disabled", false);
                //clear form
                document.getElementById("rcpid").value = "";
                document.getElementById("nameid").value = "";
                document.getElementById("nricid").value = "";
                document.getElementById("matricno").value = "";
                document.getElementById("emailid").value = "";
                showParticipant(eventID, eventName);

            },
        });
        // }
    });

    //To retrieve participant in the modal
    $("#tbody").on("click", ".btn-edit", function() {
        // console.log("Button edit clicked");
        var rcpID = $(this).attr("data-rcpid");
        // console.log(rcpID);
        // to show modal
        // $('#add_data_Modal').modal('show');

        $.ajax({
            url: "../Model/fetchParticipant.php",
            method: "POST",
            data: { rcpID: rcpID },
            dataType: "json",
            success: function(data) {
                $('#rcp_name').val(data.s_name);
                $('#rcp_nric').val(data.s_nric);
                $('#matric_no').val(data.matric_no);
                $('#rcp_email').val(data.s_email);
                $('#rcp_id').val(data.s_id);
                $('#add_data_Modal').modal('show');
            }
        });


    });

    //Update recipient data
    $('#update_form').on("submit", function(event) {
        event.preventDefault();
        // alert("Update button click");
        $.ajax({
            url: "../Model/updateParticipant.php",
            method: "POST",
            data: $('#update_form').serialize(),
            success: function(data) {
                $('#update_form')[0].reset();

                msg = "<div class='alert alert-success mt-3'>Update successfully</div>";
                $("#msg").html(msg);
                $('#add_data_Modal').modal('hide');
                showParticipant(eventID, eventName);

            }
        });
    });

    //Ajax request for Delete Participant
    $("tbody").on("click", ".btn-del", function() {
        // console.log("Button delete clicked");
        let id = $(this).attr("data-rcpid");
        // console.log(id + " " + eventName);
        mydata = { rcpid: id, eventName: eventName };
        mythis = this;

        Swal.fire({
                title: 'Are you sure?',
                html: "You want to delete this participants details?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: "../Model/deleteParticipant.php",
                        method: "POST",

                        data: JSON.stringify(mydata),
                        success: function(data) {
                            // console.log(data);
                            if (data == 1) {

                                $(mythis).closest("tr").fadeOut("slow", "swing");
                                location.reload();
                            } else if (data == 0) {
                                bootbox.alert("Participant deletion failed - please try again");

                            }
                            $("#msg").html(msg);
                            // showData();
                        },
                    });
                }
            }) //end Swal

    });


});