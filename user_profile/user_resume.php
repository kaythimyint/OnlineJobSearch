<?php
require "./user_header.php";

$error = false;
$resume =
$resume_error ='';

$select_data = selectData('users',$mysqli,"WHERE id='$id'");
if ($select_data->num_rows>0) {
    $data = $select_data->fetch_assoc();
}

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $resume = isset($_FILES['resume']) ? $_FILES['resume'] : '';
    
    $file_name = $resume['name'];

    if (strlen($file_name) == 0) {
        $error = true;
        $profile_error = "File is require.";
    }

    if (!$error) {
        
        $folder = "./cv/";
    
        $allow_file = ['png','jpg','jpeg'];
    
        $all_extension = explode('.',$file_name);
        $end_extension =strtolower(end($all_extension));
    
        $tmp_name = $resume['tmp_name'];
    
        if (!in_array($end_extension,$allow_file)) {
            $error = true;
            $resume_error = "Allow only jpg,png,jpeg";
        }else{
            if (!file_exists($folder)) {
                mkdir($folder,755);
            }
            $currentName = date("Ymd_His")."_".$file_name;
            $savePath = $folder.$currentName;
            $data = [
                'cv' => $currentName
            ];
            $where = [
                'id' => $id
            ];
            $insert_profile = updateData('users',$mysqli,$data,$where);
            if ($insert_profile) {
                $saveImg = move_uploaded_file($tmp_name,$savePath);
            }
        }
        if ($saveImg) {
        echo "<script>window.location.href='user_resume.php?sucess=File add success';</script>";
        exit();
        }
    }
}
?>

        <div class="col-12 col-lg-8 col-md-12 pb-3">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (!empty($data['cv'])) { ?>
                        <img src="<?= $user_base_url.'cv/'.$data['cv'] ?>" alt="" style="width: 100%;height:550px">
                    <?php 
                    } 
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group py-3">
                            <label for="resume" class="mb-2">CV</label>
                            <input type="file" name="resume" id="resume" class="form-control">
                            <?php
                            if ($resume_error && $error) { ?>
                                <small class="text-danger"><?= $resume_error ?></small>
                            <?php
                            }
                            ?>
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