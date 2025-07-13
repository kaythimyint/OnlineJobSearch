<?php
require "./user_header.php";

$error = false;
$resume =
$resume_error ='';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $resume = isset($_FILES['resume']) ? $_FILES['resume'] : '';

    // if (strlen($resume) <= 2) {
    //     $error = true;
    //     $resume_error  = "resume greater than 2 character.";
    // } else if (strlen($resume) >= 30) {
    //     $error = true;
    //     $resume_error  = "resume less than 30 character.";
    // }

    // if (!$error) {
    //     $data = [
    //         'resume' => $resume
    //     ];
    //     $where =[
    //         'id' => $id
    //     ];
    //     $update_res = updateData('users',$mysqli,$data,$where);

    //     if ($update_res) {
    //        echo "<script>window.location.href = 'index.php?success=resume update success';</script>";
    //     }
    // }
}
?>

        <div class="col-12 col-lg-8 col-md-12 pb-3">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (!empty($data['profile'])) { ?>
                        <img src="<?= $data['profile'] ?>" alt="" style="width: 100%;height:550px">
                    <?php 
                    } 
                    ?>
                    <form action="" method="POST">
                        <div class="form-group py-3">
                            <label for="resume" class="mb-2">CV</label>
                            <input type="file" name="resume" id="resume" class="form-control">
                        </div>
                        <input type="hidden" name="form_sub" value="1">
                        <button type="submit" class="btn btn-warning text-light fw-bold w-100 fs-5"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload CV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "./user_footer.php";
?>