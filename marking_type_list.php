<?php require_once("./layout/header.php") ?>

<?php
 if(isset($_GET['delete_id'])){
    $marking_type_id = $_GET['delete_id'];
    if(delete_marking_type($mysqli,$marking_type_id)){
        echo "Deleted Marking Type Successfully";
    }
 }
 ?>

<h2 class="title">Marking Type</h2>
<div class="card me-4">
    <div class="card-header d-flex justify-content-end">
        <div class="btn btn-success" onclick="location.replace('add_marking_type.php')">Add New Student</div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Type Name</th>
                    <th>Min_Mark</th>
                    <th>Max_Mark</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $marking_type_list = get_all_marking_type($mysqli);
                $i = 1;
               while($result = $marking_type_list->fetch_assoc() ){
                   ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $result['type_name'] ?></td>
                    <td><?= $result['min_mark'] ?></td>
                    <td><?= $result['max_mark'] ?></td>
                    <td><a href="./add_marking_type.php?marking_type_id=<?= $result['marking_type_id']?>" class="btn btn-primary">Update</a>
                    <button id="del_marking_type_btn"  data-id="<?= $result['marking_type_id']?>"  data-toggle="modal" data-target="#deleteModal" class="btn btn-primary">Delete</button>
                </td>
                </tr> 
             <?php $i++; } ?>
                   
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
    let deleteId=undefined;
    let confirmBtn  =document.querySelectorAll('#del_marking_type_btn');
    let deleted =document.querySelector("#deleted");
    // console.log(confirmBtn);
   confirmBtn.forEach(element =>{
    element.addEventListener("click",()=>{
        deleteId  =element.getAttribute('data-id');
    })
   })
    
    deleted.addEventListener("click",()=>{
        // console.log(deleteId)
    location.replace("marking_type_list.php?delete_id="+ deleteId);
    })
    
</script>
<?php require_once("./layout/footer.php") ?>
