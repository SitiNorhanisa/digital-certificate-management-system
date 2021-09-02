$(document).ready(function() {
    console.log("From download controller");

    // -----------------------PNG------------------------
    showAllProgram();

    // display program list for png
    function showAllProgram() {
        outputPNG = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveEvent.php",
            dataType: "json",
            success: function(data) {
                //  console.log(JSON.parse(data));
                console.log(data);
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                for (var i = 0; i < x.length; i++) {
                    outputPNG +=
                        "<tr><td>" + x[i].eventName + "</td><td><a class='btn btn-info btn-sm btn-png' role='button' data-eventID=" + x[i].eventId + " data-eventName='" + x[i].eventName + "'><i class='fas fa-download fa-lg'></i></a></td></tr>";
                }
                $("#tbodyPNG").append(outputPNG);
            },
        });
    } //End showAllProgram()

    // to download certificate in png based on program id
    $("#tbodyPNG").on("click", ".btn-png", function() {
        console.log("Download PNG button clicked");
        var eventID = $(this).attr("data-eventID");
        console.log(eventID);
        var dataevent = { eventId: eventID };
        window.location.href = "../Model/pngModel.php?id=" + eventID; //direct to download png page
    });

    // -----------------------PDF------------------------
    showAllProgramPDF();

    // to display program list for pdf
    function showAllProgramPDF() {
        outputPDF = "";
        $.ajax({
            method: "GET",
            url: "../Model/retrieveEvent.php",
            dataType: "json",
            success: function(data) {
                console.log(data);
                var x;
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                for (var i = 0; i < x.length; i++) {
                    outputPDF +=
                        "<tr><td>" + x[i].eventName + "</td><td><a class='btn btn-info btn-sm btn-pdf' role='button' data-idpdf=" + x[i].eventId + " data-eventName='" + x[i].eventName + "'><i class='fas fa-download fa-lg'></i></a></td></tr>";
                }
                $("#tbodyPDF").append(outputPDF);
            },
        });
    } //End showAllProgramPDF()

    $("#tbodyPDF").on("click", ".btn-pdf", function(e) {
        e.preventDefault();
        // console.log("Pdf button clicked");
        var id_pdf = $(this).attr("data-idpdf");
        console.log(id_pdf);
        window.location.href = "../Model/pdfModel.php?id=" + id_pdf; //direct to download png page
    });
});