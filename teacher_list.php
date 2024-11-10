<?php require_once("./layout/header.php") ?>
<?php
$deleteSuccess = $deleteFail = "";
if (isset($_GET['delete_id'])) {
  $teacher_id = $_GET['delete_id'];
  if (delete_teacher($mysqli, $teacher_id)) {
    $deleteSuccess = "Deleted Teacher Successfully";
  } else {
    $deleteFail = "Cann't delete  teacher record";
  }
}
?>
<h2 class="title">Teacher</h2>
<?php if ($deleteSuccess !== "") { ?>
  <div class="alert alert-warning alert-dismissible fade show w-50" role="alert">
  <strong><?= $deleteSuccess ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<?php if ($deleteFail !== "") { ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?= $deleteFail ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<div class="card me-4">
  <div class="card-header d-flex justify-content-end">
    <div class="btn btn-success" onclick="location.replace('add_teacher.php')">Add New Teacher</div>
  </div>
  <div class="justify-content-center">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Experience</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $teacher_list = get_all_teacher($mysqli);
        $i = 1; ?>
        <?php  if(isset($_POST['search'])){
                    // var_dump($_POST['search']);
                    $search = $_POST['search'];
                    $teacher_list =  search_teacher($mysqli,$search);
                }?>
        <?php while ($teacher = $teacher_list->fetch_assoc()) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $teacher['teacher_name'] ?></td>
            <td><?= $teacher['teacher_experience'] ?></td>
            <td><?= $teacher['teacher_email'] ?></td>
            <td>
              <a href="./add_teacher.php?teacher_id=<?= $teacher['teacher_id'] ?>" class="btn btn-primary">Update</a>
              <button data-id="<?= $teacher['teacher_id'] ?>" class="btn btn-primary confirmDelete" data-toggle="modal" data-target="#deleteModal">Delete</button>
            </td>
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
        Are you sure to delete this teacher?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleted">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
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
    location.replace("./teacher_list.php?delete_id=" + deleteId);
  })
</script>