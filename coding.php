<?php

$con = mysqli_connect('localhost', 'root', '', 'student_db');

if (isset($_POST['save_Student'])) {
    $Name = mysqli_real_escape_string($con, $_POST['Name']);
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

   
    $query = "INSERT INTO students (Name, Email, Phone, Course) VALUES ('$Name', '$Email', '$Phone', '$Course')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        
        $res = array(
            'status' => 200,
            'message' => 'Student Added Successfully'

        );
        echo json_encode($res);
        exit();
    }
    else 
    {
        $res = array(
            'status' => 422,
            'message' => 'Student Not Added'
        );
        echo json_encode($res); 
        exit();
    }
   
}
?>
