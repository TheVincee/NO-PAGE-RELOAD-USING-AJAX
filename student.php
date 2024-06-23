<?php 
require "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Student FORM PHP</title>
</head>
<body>
<!-- Add Student Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="AddStudentModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddStudentModal">Add Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="saveStudent"> 
        <div class="modal-body">
          <div class="alert alert-warning d-none" id="errorMessage"></div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="mb-3">
              <label for="Email" class="form-label">Email</label>
              <input type="text" name="Email" class="form-control">
          </div>
          <div class="mb-3">
              <label for="PhoneNumber" class="form-label">Phone Number</label>
              <input type="text" name="PhoneNumber" class="form-control">
          </div>
          <div class="mb-3">
              <label for="Course" class="form-label">Course</label>
              <input type="text" name="Course" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="EditStudentModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EditStudentModal">Edit Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateStudent"> 
        <div class="modal-body">
          <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
          <div class="mb-3">
            <label for="student_id" class="form-label">ID</label>
            <input type="text" name="student_id" id="student_id" class="form-control" readonly>
          </div>
          <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name" class="form-control">
          </div>
          <div class="mb-3">
              <label for="Email" class="form-label">Email</label>
              <input type="text" name="email" id="email" class="form-control">
          </div>
          <div class="mb-3">
              <label for="PhoneNumber" class="form-label">Phone Number</label>
              <input type="text" name="phone" id="phone" class="form-control">
          </div>
          <div class="mb-3">
              <label for="Course" class="form-label">Course</label>
              <input type="text" name="course" id="course" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Ajax CRUD Model PHP</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
                        Add Student               
                    </button>
                </div>
                <div class="card-body">
                  <table id="myTables" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Course</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
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
                                  <a href="#" class="btn btn-info">View</a>
                                  <button type="button" value="<?= $student['Id']; ?>" class="editStudentBtn btn btn-success">Edit</button>
                                  <a href="#" class="btn btn-danger">Delete</a>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  // Add Student
  $(document).on('submit', '#saveStudent', function(e) {
    e.preventDefault(); // Prevent the default form submit action

    var formData = new FormData(this);
    formData.append("save_Student", true);

    $.ajax({
      type: "POST",
      url: "coding.php",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json", // Add this line to ensure the response is parsed as JSON
      success: function(response) {
        if (response.status === 422) {
          $('#errorMessage').removeClass('d-none');
          $('#errorMessage').text(response.message);
        } else if (response.status === 200) {
          $('#errorMessage').addClass('d-none');
          $('#studentModal').modal('hide');
          $('#saveStudent')[0].reset();
          $('#myTables').load(location.href + " #myTables");
        } else if (response.status === 500) {
          $('#errorMessage').removeClass('d-none');
          $('#errorMessage').text(response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX error:', status, error);
        $('#errorMessage').removeClass('d-none');
        $('#errorMessage').text('An unexpected error occurred.');
      }
    });
  });

  // Edit Student
  $(document).on('click', '.editStudentBtn', function() {
    var student_id = $(this).val();
    console.log("Edit button clicked for student ID: " + student_id);

    $.ajax({
      type: "GET",
      url: "coding.php?student_id=" + student_id,
      success: function(response) {
        console.log("Edit AJAX success response: ", response);
        var res = $.parseJSON(response);

        if (res.status == 422) {
          alert(res.message);
        } else if (res.status == 200) {
          $('#student_id').val(res.data.Id);
          $('#name').val(res.data.Name);
          $('#email').val(res.data.Email);
          $('#phone').val(res.data.Phone);
          $('#course').val(res.data.Course);

          $('#editStudentModal').modal('show');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX error:', status, error);
        alert('An unexpected error occurred while fetching data.');
      }
    });
  });

  // Update Student
  $(document).on('submit', '#updateStudent', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_Student", true);

    $.ajax({
      type: "POST",
      url: "coding.php",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(response) {
        if (response.status === 422) {
          $('#errorMessageUpdate').removeClass('d-none');
          $('#errorMessageUpdate').text(response.message);
        } else if (response.status === 200) {
          $('#errorMessageUpdate').addClass('d-none');
          $('#editStudentModal').modal('hide');
          $('#updateStudent')[0].reset();
          $('#myTables').load(location.href + " #myTables");
        } else if (response.status === 500) {
          $('#errorMessageUpdate').removeClass('d-none');
          $('#errorMessageUpdate').text(response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX error:', status, error);
        $('#errorMessageUpdate').removeClass('d-none');
        $('#errorMessageUpdate').text('An unexpected error occurred.');
      }
    });
  });
</script>
</body>
</html>
