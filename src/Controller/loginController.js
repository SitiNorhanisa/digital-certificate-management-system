$(document).ready(function() {
    console.log("Connected to Login Controller");

    $("#loginBtn").click(function(e) {
        e.preventDefault();
        // console.log("Button login is clicked!");

        var inputEmail = $("#login_email").val();
        var inputPwd = $("#login_pwd").val();
        // console.log("Input email: " + inputEmail);
        // console.log("Input email: " + inputPwd);

        inputData = { inputemail: inputEmail, inputpwd: inputPwd }

        $.ajax({
            method: "GET",
            url: "../Model/loginModel.php",
            data: {
                inputemail: inputEmail,
                inputpwd: inputPwd
            },
            success: function(data) {
                //need to add user ID later
                // console.log("Masuk ajax")
                document.getElementById("loginForm").reset(); //reset form
                if (data == "FALSE") {
                    alert("Account is not exist");
                    window.location.href = "login.php";
                    // console.log("Come from FALSE");
                } else if (data == "0") {

                    // console.log("Fill all fields");
                    alert("Fill all fields");
                    window.location.href = "login.php";
                } else if (data == "PERSAKA") {
                    // console.log("PERSAKA");
                    window.location.href = "../View/program.php";
                } else if (data == "PA") {
                    // console.log("PA");
                    window.location.href = "../PA/dashboard.php";
                } else {
                    // console.log("ADMIN");
                    window.location.href = "../View/adminDashboard.php"
                }

            }
        })

    });

});