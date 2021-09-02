function designSelection() {
    var selectedDesign = document.querySelector('input[name="selection"]:checked').value;

    if (document.getElementById('upload').checked) {
        document.getElementById('uploadDesign').style.display = 'block';
        document.getElementById('readyMade').style.display = 'none';
        // console.log(selectedDesign);
    } else {
        document.getElementById('uploadDesign').style.display = 'none';
        document.getElementById('readyMade').style.display = 'block';
        // console.log(selectedDesign);
    }
}

$(document).ready(function() {

    console.log("connected to uploadBgController");


    $("#uploadBtn").click(function(event) {
        // console.log("Button submit is clicked");
        var bgID = $(this).attr("data-bgID");
        var x = document.getElementById("bg-file");
        var filePath = x.value;
        var allowedExtensions = /(\.png)$/i
            // var y = $('#eventid').val();
            // console.log(bgID);

        event.preventDefault();
        event.stopImmediatePropagation();

        if ('files' in x) {

            //to check file
            if (x.files.length == 0) {
                alert("No file selected. Please select a file.")
            } else {
                if (!allowedExtensions.exec(filePath)) {
                    alert('Please upload PNG type only.');
                    location.reload();
                } else {
                    // alert("Ada file");
                    var file = x.files[0];
                    var form_data = new FormData();
                    form_data.append('fileToUpload', file);
                    // console.log(file);
                    // console.log(form_data);
                    $.ajax({
                        type: "POST",
                        url: "../Model/uploadDesign.php",
                        data: form_data,
                        cache: false,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            // console.log(data);
                            alert("Select upload design again to preview the design. Proceed to request for approval.")
                            location.reload();
                        }
                    });
                }
            }

        }
    });


    // Confirm to choose ready made template
    $("#confirmBtn").click(function(e) {
        e.preventDefault();
        // console.log("confirmBtn clicked");

        $.ajax({
            type: "POST",
            url: "../Model/uploadDesignTemplate.php",
            success: function(response) {
                if (response != '0') {
                    alert("Successfully confirm! Proceed to request for approval.");
                    location.reload();
                } else {
                    alert("Fail to confirm!");
                }
            }
        });
    });

});