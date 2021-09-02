function isPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirm-password").val();

    if (password != confirmPassword) {
        $("#message").html("Passwords do not match!");
        $("#updateBtn").prop("disabled", true);
    } else {
        $("#message").html("Passwords match.");
        $("#updateBtn").prop("disabled", false);
    }
}

$(document).ready(function() {
    console.log("Connected to user controller");

    displayUser();

    $("#confirm-password").keyup(isPasswordMatch);
    $("#password").keyup(isPasswordMatch);

    //to display all user
    function displayUser() {
        var output = "";
        $.ajax({
            type: "GET",
            url: "../Model/fetchUser.php",
            // data: "data",
            dataType: "JSON",
            success: function(response) {
                var x;
                if (response) {
                    x = response;
                } else {
                    x = "";
                }
                for (let i = 0; i < x.length; i++) {
                    output += "<tr><td>" + (i + 1) + "</td><td>" + x[i].fname + "</td><td>" + x[i].lname + "</td><td>" + x[i].email + "</td><td>" + x[i].role + "</td><td><button class='btn btn-warning btn-edit' data-userid=" + x[i].userid + "><i class='fas fa-edit'></i></button>&nbsp<button class='btn btn-danger btn-del' data-userid=" + x[i].userid + "><i class='fa fa-trash'></i></button></td></tr>";
                }
                $("#userTbody").append(output);
            }
        });

    }

    // to display user in modal form based on user id
    $('#userTbody').on('click', '.btn-edit', function() {

        var user_id = $(this).attr("data-userid");
        var output = "";

        $.ajax({
            type: "GET",
            url: "../Model/fetchUserDetail.php",
            data: { user_id: user_id },
            dataType: "JSON",
            success: function(response) {

                $("#user-id").val(response.user_id);
                $('#first-name').val(response.first_name);
                $('#last-name').val(response.last_name);
                $('#email').val(response.email);
                $('#password').val(response.password);
                $('#confirm-password').val(response.password);
                $('#role').val(response.role);
                $('#user_modal').modal('show'); //to show modal
            }
        });

    });

    $("#updateBtn").on("click", function(e) {
        e.preventDefault();
        // console.log("Update button click");
        var user_id = $("#user-id").val();

        var new_password = $("#password").val();
        // console.log("New password: " + new_password + " for " + user_id);

        $.ajax({
            url: "../Model/updateUserDetail.php",
            method: "POST",
            data: { user_id: user_id, new_password: new_password },
            dataType: "JSON",
            success: function(data) {

                if (data != 1) {
                    alert("Tidak berjaya update");
                } else {
                    $('#user_modal').modal('hide')
                };
            }
        });
    });

    //to delete user based on user id
    $("#userTbody").on("click", ".btn-del", function(e) {
        e.preventDefault();
        var user_id = $(this).attr("data-userid");
        // console.log("Selected id: " + $user_id);
        mydata = { user_id: user_id };
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
                    url: "../Model/deleteUser.php",
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

                    },
                });
            }
        })
    });
});