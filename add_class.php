<?php require_once("./layout/header.php") ?>
<?php
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    // echo $class_id;
    $class = get_class_with_id($mysqli, $class_id);
    // var_dump($class);
    $class_name = $class['class_name'];
    $description = $class['description'];
}
$class_name_err = $description_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST['class_name'];
    $description = $_POST['description'];
    if ($class_name == "") {
        $class_name_err = "Please enter classname..";
    }
    if ($description == "") {
        $description_err = "Please enter description..";
    }
    if ($class_name_err == '' && $description_err == '') {
        if (isset($_GET['class_id'])) {
            // echo($_GET['class_id']);
            if (update_class($mysqli, $class_id, $class_name, $description)) {
                header("location:class_list.php");
            } else {
                $upd_class_fail = "Cann't add student.Try Again";
            }
        } else {
            if (add_class($mysqli, $class_name, $description)) {
                header("location: class_list.php");
            }
        }
    }
}
?>
<h2 class="title" style="text-align: center !important;">Class</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add New Class</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group my-2">
                <label for="name">Name</label>
                <input type="text" name="class_name" value="<?php if (isset($class_name)) {
                                                                echo $class_name;
                                                            } ?>" id="class_name" class="form-control">
                <?php if ($class_name_err !== "") { ?>
                    <span class="text-danger"><?= $class_name_err ?></span>
                <?php } ?>
            </div>
            <div class="form-group my-2">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5"><?php if (isset($description)) {
                                                                                                echo $description;
                                                                                            } ?></textarea>
                <?php if ($description_err !== "") { ?>
                    <span class="text-danger"><?= $description_err ?></span>
                <?php } ?>
            </div>

            <div class="text-center my-2">
                <button class="btn btn-info" name="addClassBtn">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php require_once("./layout/footer.php") ?>