$(document).ready(function() {
    console.log("Connected to progress controller");

    $("#progressForm").submit(function(e) {
        e.preventDefault();
        var outputProgress = "";
        var matricNo = $('#matricNo').val();
        // alert("Matric number is " + matricNo);
        // console.log("Matric number is " + matricNo);

        $.ajax({
            type: "GET",
            url: "../Model/displayParticipantProgress.php",
            data: { matric_no: matricNo },
            dataType: "JSON",
            success: function(response) {
                var data;
                // console.log("AJAX BERJAYA");
                if (response != "0") {
                    if (response) {
                        data = response;
                    } else {
                        data = "";
                    }
                    for (var i = 0; i < data.length; i++) {

                        outputProgress += "<tr><td>" + (i + 1) + "</td><td>" + data[i].name + "</td><td>" + data[i].program + "</td><td>" + data[i].progress + "</td><td>" + data[i].date + "</td></tr>";
                    }
                } else {
                    outputProgress += "<tr><td colspan='5' style='text-align:center;'><i class='fas fa-exclamation-triangle yellow-color'></i> <b>No progress found. Please insert correct matric number.</b></td></tr>";
                }

                $("#tbodyProgress").html(outputProgress);
                $("#progressTable").show();
            },
        });
    });
});