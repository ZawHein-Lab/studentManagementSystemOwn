<?php require_once("./layout/header.php") ?>

<?php
$deleteSuccess = $deleteFail = "";
if (isset($_GET['deleteClass_id'])) {
  $class_id = $_GET['deleteClass_id'];
  if (delete_class($mysqli, $class_id)) {
    $deleteSuccess = "Deleted Class Successfully";
  } else {
    $deleteFail = "Cann't delete +Class record";
  }
}
// if(isset($_POST['search'])){
//   $search_key =$_POST['search'];
//   if(isset($search_key)){
//     var_dump($search_key);
//   }
// }
?>
<h2 class="title">Class</h2>
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
<div class="card me-4">
  <div class="card-header d-flex justify-content-end">
    <div class="btn btn-success" onclick="location.replace('add_class.php')">Add New Class</div>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      
        <?php $class_list = get_all_class($mysqli);
        $i = 1;
        if(isset($_POST['search'])){
          // var_dump($_POST['search']);
          $search = $_POST['search'];
          $class_list =  search_class($mysqli,$search);
      }
        while ($class = $class_list->fetch_assoc()) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $class['class_name'] ?></td>
            <td><?= $class['description'] ?></td>
            <td>
              <a href="./add_class.php?class_id=<?= $class['class_id'] ?>" class="btn btn-primary">Update</a>
              <button data-id="<?php echo $class['class_id']; ?>" class="btn btn-primary confirmDeleteClass" data-toggle="modal" data-target="#deleteClassModal">Delete</button>
            </td>
          </tr>
        <?php $i++;
        } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert Alert!</h5>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete this class?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleted">Delete</button>
      </div>
    </div>
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
        Are you sure to delete this class?
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
  let confirmBtn = document.querySelectorAll('.confirmDeleteClass');
  let deleted = document.querySelector("#deleted");
  // console.log(confirmBtn);
  confirmBtn.forEach(element => {
    element.addEventListener("click", () => {
      deleteId = element.getAttribute('data-id');
    })
  })

  deleted.addEventListener("click", () => {
    // console.log(deleteId)
    location.replace("./class_list.php?deleteClass_id=" + deleteId);
  })
</script>
<?php require_once("./layout/footer.php") ?>