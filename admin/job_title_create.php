<?php
session_start(); 
require "../user_profile/user_header.php";
require "../common/database.php";
require "../common/common_funtion.php";
require "../common/url.php";

$error =false;
$name = 
$name_error = '';

$id = $_SESSION['id'];
$result = selectData('users',$mysqli,"WHERE id = '$id'");
if ($result->num_rows >0) {
    $data = $result->fetch_assoc();
    // var_dump($data);
    // die();
}

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
        $insertRes = insertData('job_title',$mysqli,$data);
        if ($insertRes) {
            $url = $admin_base_url."job_title.php?success:Job Title Create Success";
            header("Location:$url");
            exit();
        }else{
            $url = $admin_base_url."job_title_create.php?error:Job Title Create Not Success";
            header("Location:$url");
            exit();
        }
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top pt-2" src="../img/profile.jpg" alt="Card image" style="width: 95%;height:230px;margin:auto">
                <div class="card-body">
                    <h4 class="card-title text-center"><?= $data['email'] ?></h4>
                    <p class="card-text text-warning text-center"><?= $data['name'] ?></p>
                    <div class="">
                        <div class="">
                            <a href="#" class="btn btn-primary btn-lg w-100">See Profile</a>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_title.php"  ?>" class="btn btn-lg">Job Title</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Job Type</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Job Categories</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Company location</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Salary</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Experince</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Logout</a>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
           <div class="d-flex justify-content-between align-items-center mb-2">
                <h1>Job Title Create</h1>
                <a href="<?= $admin_base_url."job_title.php" ?>" class="btn btn-dark btn-lg">Back</a>
           </div>
           <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                        <label for="name" class="mb-2">Job Title Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $name ?>" id="name" placeholder="Enter Job title name">
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
require "../user_profile/user_footer.php";
?>