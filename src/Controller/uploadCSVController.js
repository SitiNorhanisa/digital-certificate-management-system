$(document).ready(function() {

    console.log("Connected to uploadCSVController js");
    let currEventID = document.getElementById("eventID").value;
    // console.log("Event selected is " + currEventID);

    showData();

    //Ajax request to read and store csv data to database
    $('#upload_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "../Model/uploadCSV.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // console.log(data);
                // console.log("Successfully added into database");
                showData();
            }
        });
    }); //End Ajax Request to Insert

    //Ajax request for retrieving Data
    function showData() {
        output = "";
        // console.log("Show data is clicked");

        $.ajax({
            method: "GET",
            url: "../Model/retrieveAllParticipant.php",
            data: {
                eventID: currEventID
            },
            dataType: "json",
            success: function(data) {
                // console.log(JSON.parse(data));
                // console.log("Retrieve ajax");
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
                            "<tr id=" + x[i].id + "><td>" + (i + 1) +
                            "</td><td style='display:none;'>" + [i].id +
                            "</td><td><span class='editSpan fullName'>" + x[i].name + " </span><input class='editInput fullName form-control input-sm' style = 'display: none;' type='text' name='full_name' value='" + x[i].name + "' > </td><td><span class='editSpan nric '>" + x[i].nric + "</span> <input class ='editInput nric form-control input-sm type = 'text' name='nr_ic' value='" +
                            x[i].nric + "' style='display: none;'></td><td>" + x[i].matricno + "</td><td><span class='editSpan email'>" +
                            x[i].email + " </span><input class='editInput email form-control input-sm' type='text' name='e_mail' value='" + x[i].email + "' style = 'display: none;'></td><td><button type='button' id='" + x[i].id + "' class='btn btn-sm btn-warning editBtn' style='float: none;'><span class='fas fa-edit'></span></button>&nbsp<button type='button' id='" + x[i].id + "' class='btn btn-sm btn-danger deleteBtn' style='float: none;'><span class='fas fa-trash-alt'></span></button></td></tr>";

                        // console.log(x[i].name);

                    }
                    $("#certBtn").prop("disabled", false); //disable button
                }
                $("#tbody").html(output);
            },
        });
    } //end of showData()

    //to dislay modal form
    $('tbody').on('click', '.editBtn', function() {
        var rcpID = $(this).attr("id");
        // console.log("ID selected: " + rcpID);
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
                showData();
            }
        });
    });

    //delete recipient data
    $('tbody').on('click', '.deleteBtn', function() {
        // console.log("Confirm button to delete is clicked");
        var deleteID = $(this).closest("tr").attr('id');
        mydata = { rcpid: deleteID };
        mythis = this;
        // console.log(deleteID);

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
                        Headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        data: JSON.stringify(mydata),
                        success: function(data) {
                            // console.log(data);
                            if (data == 1) {
                                // alert("Delete this row?");
                                msg = "<div class='alert alert-success mt-3'>Recipient deleted successfully</div>";
                                $(mythis).closest("tr").fadeOut();
                                showData();
                            } else if (data == 0) {
                                msg = "<div class='alert alert-dark mt-3'>Failed to delete recipient</div>";
                            }
                            $("#msg").html(msg);
                        },
                    });
                }
            }) //end Swal
    });
});