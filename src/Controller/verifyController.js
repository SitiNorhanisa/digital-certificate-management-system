$(document).ready(function() {

    console.log("Connected from verifyController");

    $('#verifyForm').on("submit", function(e) {
        e.preventDefault();
        // console.log('Button verify is clicked');
        var uniqueID = $("#uniqueID").val();
        // console.log(uniqueID);
        var output = "";

        if (uniqueID != '') {

            $.ajax({
                type: "GET",
                url: "../Model/fetchCertificate.php",
                data: { uniqueID: uniqueID },
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
                            output +=
                                "<tr><td>" +
                                data[i].id +
                                "</td><td>" +
                                data[i].name +
                                "</td><td>" +
                                data[i].event +
                                "</td><td>" +
                                data[i].approver +
                                "</td><td>" +
                                data[i].created +
                                "</td></tr>";
                            // console.log("ID SIJIL IALAH: " + data[i].id);
                            // console.log("PENERIMA SIJIL IALAH: " + data[i].name);
                            // console.log("PROGRAM IALAH: " + data[i].event);
                            // console.log("DILULUSKAN OLEH: " + data[i].approver);
                            // console.log("TARIKH DIKELUARKAN OLEH: " + data[i].created);
                        }
                    } else {
                        // alert("SIJIL TIDAK WUJUD");
                        output += "<tr><td colspan='5'><i class='fas fa-exclamation-triangle yellow-color'></i> <b>We couldn't find your certificate because the ID is not unique or wrong. Please insert the correct unique ID.</b></td></tr>";
                    }
                    $("#tbodyVerify").html(output);
                    $("#verifyTable").show();
                },
            });
        } else {
            alert("PLEASE INSERT CERTIFICATE ID");
        }

    });

});