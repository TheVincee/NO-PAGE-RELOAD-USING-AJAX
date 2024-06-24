<?php
require 'dbcon.php';

if(isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM students WHERE Id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        echo json_encode(['status' => 200, 'message' => 'Student Deleted Successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Student Not Deleted.']);
    }
}

if(isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        echo json_encode(['status' => 422, 'message' => 'All fields are mandatory.']);
        return;
    }

    $query = "UPDATE students SET Name='$name', Email='$email', Phone='$phone', Course='$course' WHERE Id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        echo json_encode(['status' => 200, 'message' => 'Student Updated Successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Student Not Updated.']);
    }
}

if(isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $phone = mysqli_real_escape_string($con, $_POST['PhoneNumber']);
    $course = mysqli_real_escape_string($con, $_POST['Course']);

    if($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        echo json_encode(['status' => 422, 'message' => 'All fields are mandatory.']);
        return;
    }

    $query = "INSERT INTO students (Name, Email, Phone, Course) VALUES ('$name','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        echo json_encode(['status' => 200, 'message' => 'Student Created Successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Student Not Created.']);
    }
}
?>
