<?php require_once("./layout/header.php") ?>
<?php 
$type_name = $min_mark = $max_mark = "";
$type_name_err = $min_mark_err = $max_mark_err = "";
if(isset($_GET['marking_type_id'])){
    $marking_type_id = $_GET['marking_type_id'];
    // echo $marking_type_id;
   $marking_type_list = get_marking_type_with_id($mysqli,$marking_type_id);
//    var_dump($marking_type_list);
    $type_name = $marking_type_list['type_name'];
    $min_mark = $marking_type_list['min_mark'];
    $max_mark = $marking_type_list['max_mark']; 
    // echo $type_name;
}
if(isset($_POST['type_name'])){
    $type_name = $_POST['type_name'];
    $min_mark = $_POST['min_mark'];
    $max_mark = $_POST['max_mark'];
    // echo $max_mark;
    if($type_name == ""){
        $type_name_err = "Please enter type name..";
    }
    if($min_mark == ""){
        $min_mark_err = "Please enter minimun mark..";
    }
    if($max_mark == ""){
        $max_mark_err = "Please enter maximun mark..";
    }
    if($type_name_err == "" && $min_mark_err == "" && $max_mark_err == ""){
        if(isset($_GET['marking_type_id'])){
            if(update_marking_type($mysqli,$marking_type_id,$type_name,$min_mark,$max_mark)){
                header('location:marking_type_list.php');
            }
        } else{
            if(add_marking_type($mysqli,$type_name,$min_mark,$max_mark)){
                header('location:marking_type_list.php');
                }
        }
    }
}
?>
<h2 class="title" style="text-align: center !important;">Marking Type</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add New Marking Type</h4>
    </div>
    <div class="card-body">
            <form action="" method="post">
                <div class="form-group my-2">
                    <label for="type_name">Type Name</label>
                    <input type="text" value="<?php echo $type_name ?>"  name="type_name" id="type_name" class="form-control">
                    <?php if($type_name == ""){ ?>
                        <span class="text-danger">
                            <?= $type_name_err ?>
                        </span>
                        <?php } ?>
                </div>
                <div class="form-group my-2">
                    <label for="min_mark">Minimun Mark</label>
                    <input type="number" value="<?php echo $min_mark ?>" name="min_mark"  id="min_mark" class="form-control">
                    <?php if($min_mark == ""){ ?>
                        <span class="text-danger">
                            <?= $min_mark_err ?>
                        </span>
                        <?php } ?>
                </div>
                <div class="form-group my-2">
                    <label for="max_mark">Maximun Mark</label>
                    <input type="number" value="<?php echo $max_mark ?>" name="max_mark" id="max_mark" class="form-control">
                    <?php if($max_mark == ""){ ?>
                        <span class="text-danger">
                            <?= $max_mark_err ?>
                        </span>
                        <?php } ?>
                </div>
                <div class="text-center my-2">
                <button class="btn btn-info" name="submitBtn">Submit</button>
                </div>
            </form>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>
