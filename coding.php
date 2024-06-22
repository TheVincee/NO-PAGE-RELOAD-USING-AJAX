<?php
require 'dbcon.php';

$response = array();

if (isset($_POST['save_Student'])) {
    $name = $_POST['name'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNumber'];
    $course = $_POST['Course'];

    if (empty($name) || empty($email) || empty($phone) || empty($course)) {
        $response['status'] = 422;
        $response['message'] = "All fields are required.";
    } else {
        $query = "INSERT INTO students (Name, Email, Phone, Course) VALUES ('$name', '$email', '$phone', '$course')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $response['status'] = 200;
            $response['message'] = "Student added successfully.";
        } else {
            $response['status'] = 500;
            $response['message'] = "Database error.";
        }
    }
    echo json_encode($response);
}
?>
