<?php require_once("./layout/header.php") ?>

<?php
$deleteSuccess = $deleteFail = "";
if (isset($_GET['delete_id'])) {
  $student_id = $_GET['delete_id'];
  if (delete_student($mysqli, $student_id)) {
    $deleteSuccess = "Deleted Student Successfully";
  } else {
    $deleteFail = "Cann't delete student record";
  }
}
?>
<h2 class="title">Student</h2>
<?php if ($deleteSuccess !== "") { ?>
  <div class="alert alert-warning alert-dismissible fade show w-50" role="alert">
  <strong><?= $deleteSuccess ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<?php if ($deleteFail !== "") { ?>
  <div class="alert alert-warning alert-dismissible fade show w-50" role="alert">
  <strong><?= $deleteFail ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<div class="card me-5">
  <div class="card-header d-flex justify-content-end">
    <div class="btn btn-success" onclick="location.replace('add_student.php')">Add New Student</div>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Address</th>
          <th>Age</th>
          <th>Email</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $student_list = get_all_student($mysqli);
        $i = 1; ?>
        <?php while ($student = $student_list->fetch_assoc()) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $student['student_name'] ?></td>
            <td><?= $student['student_address'] ?></td>
            <td><?= $student['student_age'] ?></td>
            <td><?= $student['student_email'] ?></td>
            <td>
              <a href="./add_student.php?student_id=<?= $student['student_id'] ?>" class="btn btn-primary">Update</a>
              <button data-id="<?= $student['student_id'] ?>" class="btn btn-primary confirmDelete" data-toggle="modal" data-target="#deleteModal">Delete</button>
            </td>
            <td><a href="./student_detail_batch_list.php?student_id=<?= $student["student_id"] ?>" class="btn btn-sm btn-secondary">Class</a></td>
            <td></td>

          </tr>
        <?php $i++;
        } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert Alert!</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete this student?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleted">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
  let deleteId = undefined;
  let confirmBtn = document.querySelectorAll('.confirmDelete');
  let deleted = document.querySelector("#deleted");
  // console.log(confirmBtn);
  confirmBtn.forEach(element => {
    element.addEventListener("click", () => {
      deleteId = element.getAttribute('data-id');
    })
  })

  deleted.addEventListener("click", () => {
    // console.log(deleteId)
    location.replace("./student_list.php?delete_id=" + deleteId);
  })
</script>
<?php require_once("./layout/footer.php") ?>