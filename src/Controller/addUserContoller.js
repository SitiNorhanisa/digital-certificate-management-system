//Password validation
function isPasswordMatch() {
    var password = $("#inputPassword").val();
    var confirmPassword = $("#inputConfirmPassword3").val();

    if (password != confirmPassword) {
        $("#message").html("Passwords do not match!");
        document.getElementById("message").style.color = "red";
        $("#addUserBtn").prop("disabled", true);
    } else {
        $("#message").html("Passwords match.");
        document.getElementById("message").style.color = "green";
        $("#addUserBtn").prop("disabled", false);
    }
}

//Toggle password
function myFunction() {
    var x = document.getElementById("inputPassword");
    var y = document.getElementById("inputConfirmPassword3");
    if (x.type === "password" && y.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

$(document).ready(function() {
    console.log("Successfully connected to addUserController");

    //Validate password
    $("#inputPassword").keyup(isPasswordMatch);
    $("#inputConfirmPassword3").keyup(isPasswordMatch);

    // addUserBtn
    $("#userForm").submit(function(e) {

        e.preventDefault();
        console.log("Add new user!");

        let firstName = $('#inputFName3').val();
        let lastName = $('#inputLName3').val();
        let email = $('#inputEmail3').val();
        let password = $('#inputPassword').val();
        let confirmPassword = $('#inputConfirmPassword3').val();
        var selectedRole = document.querySelector('input[name="role"]:checked').value;

        userData = { firstname: firstName, lastname: lastName, email: email, password: password, confirmpassword: confirmPassword, role: selectedRole };
        console.log(userData);

        $.ajax({
            method: "POST",
            url: "../Model/AddUser.php",
            data: JSON.stringify(userData),
            success: function(data) {
                if (data == "OK") {
                    console.log("Successfully add new user!")
                    document.getElementById("userForm").reset(); //reset form
                    alert("Registered successfully");
                    window.location.href = "adminDashboard.php";

                } else {
                    alert("Fail to register");
                    console.log("Fail to register user")
                }
            }
        });
        console.log("First name: " + firstName);
        console.log("Last name: " + lastName);
        console.log("Email: " + email);
        console.log("Password: " + password);
        console.log("Confirm passoword: " + confirmPassword);
        console.log("Role: " + selectedRole);
    }); //End add new user

});
