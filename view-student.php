<?php
require 'dbcon.php';

if(isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $query = "SELECT * FROM students WHERE Id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $student = mysqli_fetch_array($query_run);
        echo json_encode(['status' => 200, 'data' => $student]);
    } else {
        echo json_encode(['status' => 404, 'message' => 'Student Not Found.']);
    }
} else {
    echo json_encode(['status' => 422, 'message' => 'Invalid request.']);
}
?>
