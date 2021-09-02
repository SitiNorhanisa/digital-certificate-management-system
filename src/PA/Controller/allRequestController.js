$(document).ready(function() {
    console.log("Connected to allRequestController.js from allRequest.php");

    allRequests();

    //Display all certificate except pending
    function allRequests() {
        output = "";

        $.ajax({
            method: "GET",
            url: "./Database/retrieveRequest.php",
            dataType: "json",
            success: function(data) {

                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                // 
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
                        "</td><td>" +
                        x[i].email +
                        "</td><td>" +
                        x[i].eventName +
                        "</td><td>" +
                        x[i].approvalStatus +
                        "</td></tr>";
                    // console.log(x[i].name);
                }


                $("#tbodyAllRequest").html(output);
            },
        })
    }

    // to filter search
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbodyAllRequest tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});