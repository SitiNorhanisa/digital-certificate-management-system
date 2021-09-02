$(document).ready(function() {

    $(".approvedBtn").click(function(e) {
        e.preventDefault();
        console.log("Approve button is clicked");
        // alert("Approve button is clicked");
        if (document.getElementById("displaytable").style.display === "none")
            document.getElementById("displaytable").style.display = "block";

        else
            document.getElementById("displaytable").style.display = "none";
    });
});