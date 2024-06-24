<?php
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management System</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Student Management System</h4>
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentModal">Add Student</button>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php
              $query = "SELECT * FROM students";
              $query_run = mysqli_query($con, $query);
              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $student) {
                  ?>
                  <tr>
                    <td><?= $student['Id']; ?></td>
                    <td><?= $student['Name']; ?></td>
                    <td><?= $student['Email']; ?></td>
                    <td><?= $student['Phone']; ?></td>
                    <td><?= $student['Course']; ?></td>
                    <td>
                      <button type="button" value="<?= $student['Id']; ?>" class="viewStudentBtn btn btn-info">View</button>
                      <button type="button" value="<?= $student['Id']; ?>" class="editStudentBtn btn btn-success">Edit</button>
                      <button type="button" value="<?= $student['Id']; ?>" class="deleteStudentBtn btn btn-danger">Delete</button>
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="saveStudent">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="Email" class="form-control">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="PhoneNumber" class="form-control">
          </div>
          <div class="form-group">
            <label for="course">Course</label>
            <input type="text" id="course" name="Course" class="form-control">
          </div>
          <div id="errorMessage" class="alert alert-danger d-none"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewStudentModalLabel">View Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="view_name">Name</label>
            <input type="text" id="view_name" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="view_email">Email</label>
            <input type="email" id="view_email" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="view_phone">Phone</label>
            <input type="text" id="view_phone" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="view_course">Course</label>
            <input type="text" id="view_course" class="form-control" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="updateStudent">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="student_id" name="student_id">
          <div class="form-group">
            <label for="edit_name">Name</label>
            <input type="text" id="edit_name" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_email">Email</label>
            <input type="email" id="edit_email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_phone">Phone</label>
            <input type="text" id="edit_phone" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_course">Course</label>
            <input type="text" id="edit_course" name="course" class="form-control">
          </div>
          <div id="errorMessageUpdate" class="alert alert-danger d-none"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
  $(document).on('click', '.viewStudentBtn', function () {
    var student_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "view-student.php",
      data: { 'student_id': student_id },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $('#view_name').val(res.data.Name);
          $('#view_email').val(res.data.Email);
          $('#view_phone').val(res.data.Phone);
          $('#view_course').val(res.data.Course);
          $('#viewStudentModal').modal('show');
        }
      }
    });
  });

  $(document).on('click', '.editStudentBtn', function () {
    var student_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "get-student.php",
      data: { 'student_id': student_id },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $('#student_id').val(res.data.Id);
          $('#edit_name').val(res.data.Name);
          $('#edit_email').val(res.data.Email);
          $('#edit_phone').val(res.data.Phone);
          $('#edit_course').val(res.data.Course);
          $('#editStudentModal').modal('show');
        }
      }
    });
  });

  $(document).on('submit', '#updateStudent', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_student", true);

    $.ajax({
      type: "POST",
      url: "coding.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $('#errorMessageUpdate').addClass('d-none');
          $('#editStudentModal').modal('hide');
          $('#updateStudent')[0].reset();
          $('#myTable').load(location.href + " #myTable");
        } else if (res.status == 422) {
          $('#errorMessageUpdate').removeClass('d-none').text(res.message);
        }
      }
    });
  });

  $(document).on('click', '.deleteStudentBtn', function (e) {
    e.preventDefault();

    if (confirm('Are you sure you want to delete this student?')) {
      var student_id = $(this).val();
      $.ajax({
        type: "POST",
        url: "coding.php",
        data: {
          'delete_student': true,
          'student_id': student_id
        },
        success: function (response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 200) {
            $('#myTable').load(location.href + " #myTable");
          }
        }
      });
    }
  });

  $(document).on('submit', '#saveStudent', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_student", true);

    $.ajax({
      type: "POST",
      url: "coding.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
          $('#errorMessage').addClass('d-none');
          $('#studentModal').modal('hide');
          $('#saveStudent')[0].reset();
          $('#myTable').load(location.href + " #myTable");
        } else if (res.status == 422) {
          $('#errorMessage').removeClass('d-none').text(res.message);
        }
      }
    });
  });
});
</script>
</body>
</html>
