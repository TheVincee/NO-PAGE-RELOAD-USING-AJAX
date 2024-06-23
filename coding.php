<?php
require "dbcon.php";

// Handle Add Student
if (isset($_POST['save_Student'])) {
    $name = $_POST['name'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNumber'];
    $course = $_POST['Course'];

    $query = "INSERT INTO students (Name, Email, Phone, Course) VALUES ('$name', '$email', '$phone', '$course')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo json_encode(['status' => 200, 'message' => 'Student added successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to add student.']);
    }
}

// Handle Edit Student Fetching
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $query = "SELECT * FROM students WHERE Id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);
        echo json_encode(['status' => 200, 'data' => $student]);
    } else {
        echo json_encode(['status' => 404, 'message' => 'Student not found.']);
    }
}

// Handle Update Student
if (isset($_POST['update_Student'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $query = "UPDATE students SET Name='$name', Email='$email', Phone='$phone', Course='$course' WHERE Id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo json_encode(['status' => 200, 'message' => 'Student updated successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to update student.']);
    }
}
?>
