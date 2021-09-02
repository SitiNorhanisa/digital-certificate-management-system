$(document).ready(function() {
    console.log("Connected to chairController");

    $('#editChairBtn').click(function(e) {
        // console.log("Edit button is clicked")
        e.preventDefault();
        $.ajax({
            url: "./Database/retrieveChair.php",
            method: "POST",
            data: { action: "retrieve" },
            dataType: "JSON",
            success: function(data) {
                $('#c_name').val(data.chair_name);
                $('#chairModal').modal('show');
            }
        })

    });

    //to update chair information
    $('#chair_form').on("submit", function(e) {
        // console.log("Update button clicked.");
        var chairName = $('#c_name').val();
        var x = document.getElementById("c_signature");
        e.preventDefault();
        e.stopImmediatePropagation();
        if ("files" in x) {
            //to check file
            if (x.files.length == 0) {
                // console.log("No file");
            } else {
                // alert("Ada file");
                var file = x.files[0];
                var form_data = new FormData();
                form_data.append("fileToUpload", file);
                form_data.append("chairName", chairName);
                $.ajax({
                    url: "./Database/updateChair.php",
                    type: "POST",
                    data: form_data,
                    cache: false,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data);
                        if (data !== '0') {
                            $('#chair_form')[0].reset();
                            $('#chairModal').modal('hide');
                            location.reload();
                        } else {
                            alert("Only accept .png type");
                        }
                    }
                });
            }
        }
    });
});