<?php

require "../admin/admin_header.php";

$error =false;
$name = 
$name_error = '';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $name = $mysqli->real_escape_string($_POST['name']);

    if (strlen($name) == 0) {
        $error = true;
        $name_error  = "Name is require";
    }else if (strlen($name) <= 5) {
        $error = true;
        $name_error  = "Name greater than 5 character.";
    }else if (strlen($name) > 50) {
        $error = true;
        $name_error  = "Name less than 50 character.";
    }

    if (!$error) {
        $data =[
            'name' => $name
        ];
        $insertRes = insertData('job_type',$mysqli,$data);
        if ($insertRes) {
            $url = $admin_base_url."job_type.php?success:Job type Create Success";
            header("Location:$url");
            exit();
        }else{
            $url = $admin_base_url."job_type_create.php?error:Job type Create Not Success";
            header("Location:$url");
            exit();
        }
    }
}
require "../admin/admin_sidebar.php";
?>
        <div class="col-12 col-md-9">
           <div class="d-flex justify-content-between align-items-center mb-2">
                <h1>Job Type Create</h1>
                <a href="<?= $admin_base_url."job_type.php" ?>" class="btn btn-dark btn-lg">Back</a>
           </div>
           <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                        <label for="name" class="mb-2">Job type Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $name ?>" id="name" placeholder="Enter Job type name">
                    </div>
                    <div style="height: 20px;margin-bottom:10px">
                        <?php
                        if ($name_error && $error) { ?>
                            <small class="form-text text-danger"><?= $name_error ?></small>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="hidden" name="form_sub" value="1">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Create</button>
                    </form>
                </div>
           </div>
        </div>
    </div>
</div>
<?php
require "../admin/admin_footer.php";
?>