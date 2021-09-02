<?php

include("dbConnection.php");

if (isset($_POST['email_data'])) {
    foreach ($_POST['email_data'] as $row) {
        $rcpid = $row['rcpid'];
        $emaildate = date("Y-m-d H:i:s");
        $sqlUpdateRcp = "UPDATE recipient SET s_email_status='1', s_email_date='$emaildate', s_modified='$emaildate' WHERE s_id=$rcpid";
        $result = $conn->query($sqlUpdateRcp);
    }

    if ($result == TRUE) {
        echo '1';
    } else {
        echo '0';
    }
}
