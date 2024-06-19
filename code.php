<?php

require 'dbcon.php';
if (!$con) {
    $res = array(
        'status' => 500,
        'message' => 'Database connection failed'
    );
    echo json_encode($res);
    exit();
}

if (isset($_POST['save_Student'])) {
    // Corrected the field names to match those in the HTML form
    $Name = mysqli_real_escape_string($con, $_POST['name']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Phone = mysqli_real_escape_string($con, $_POST['PhoneNumber']);
    $Course = mysqli_real_escape_string($con, $_POST['Course']);

    if ($Name == NULL || $Email == NULL || $Phone == NULL || $Course == NULL) {
        $res = array(
            'status' => 422,
            'message' => 'All fields are required'
        );
        echo json_encode($res);
        exit();
    }

    // Execute the query and store the result in $query_run
    $query = "INSERT INTO students (Name, Email, Phone, Course) VALUES ('$Name', '$Email', '$Phone', '$Course')";
    $query_run = mysqli_query($con, $query); // Corrected this line

    if ($query_run) { // Corrected the check for query success
        $res = array(
            'status' => 200,
            'message' => 'Student Added Successfully'
        );
        echo json_encode($res);
        exit();
    } else {
        $res = array(
            'status' => 500,
            'message' => 'Student Not Added'
        );
        echo json_encode($res); 
        exit();
    }
}
?>
