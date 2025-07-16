<?php
require "./header.php";

$company_select = selectData('companies',$mysqli,"WHERE id = '$id'");
if ($company_select->num_rows>0) {
    $data = $company_select->fetch_assoc();
}else{
    $url = $company_base_url.'company_login.php:error=ID Not Found';
    header("Location:$url");
}

$error = false;
$profile = 
$profile_error = '';

if (isset($_POST['form_sub']) && $_POST['form_sub']=='1') {
    $profile = $_FILES['profile'];
    
    $file_name = $profile['name'];

    if (strlen($file_name) == 0) {
        $error = true;
        $profile_error = "Profile image is require.";
    }

    if (!$error) {
        
        $folder = "../upload/";
    
        $allow_file = ['png','jpg','jpeg'];
    
        $all_extension = explode('.',$file_name);
        $end_extension =strtolower(end($all_extension));
    
        $tmp_name = $profile['tmp_name'];
    
        if (!in_array($end_extension,$allow_file)) {
            $error = true;
            $profile_error = "Allow only jpg,png,jpeg";
        }else{
            if (!file_exists($folder)) {
                mkdir($folder,755);
            }
            $currentName = date("Ymd_His")."_".$file_name;
            $savePath = $folder.$currentName;
            $data = [
                'profile' => $currentName
            ];
            $where = [
                'id' => $id
            ];
            $insert_profile = updateData('companies',$mysqli,$data,$where);
            if ($insert_profile) {
                $saveImg = move_uploaded_file($tmp_name,$savePath);
            }
        }
        if ($saveImg) {
        // $url = $company_base_url.'index.php?success=Profile add success';
        // header("Location:$url");
        // exit();
        echo "<script>window.location.href='company_profile.php?sucess=Profile picture add success';</script>";
        exit();
        }
    }
}
?>
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-10 m-auto">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="d-flex flex-wrap justify-content-between p-4 shadow-lg"  style="background-color: navy;">
                                    <!-- <img src="../img/profile.jpg" id="preview" style="width: 200px;height:200px;"> -->
                                    <?php
                                    if (!isset($data['profile']) || !$data['profile']) { ?>
                                        <img src="../img/profile.jpg" id="preview" style="width: 200px;height:200px;">
                                    <?php
                                        }
                                        else{ ?>
                                            <img src="<?= '../upload/'.$data['profile'] ?>" id="preview" style="width: 200px;height:200px;">
                                    <?php
                                        }
                                    ?>
                                    <div class="pt-5 ps-5">
                                        <label for="profile" class="profile mb-3">Selete Profile Image</label>
                                        <input type="file" name="profile" style="display: none;" id="profile">
                                        <p class="text-light">Supported files are jpg,jpeg,png</p>
                                        <div style="height: 10px;">
                                            <?php
                                            if ($profile_error && $error) { ?>
                                                <small class="text-danger"><?= $profile_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="form_sub" value="1">
                                <button type="submit" class="w-100 mt-3 py-3 rounded text-warning" style="background-color: navy;border:none;font-size:14pt">Profile Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  const fileInput = document.getElementById("profile");
  const preview = document.getElementById("preview");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
      });

      reader.readAsDataURL(file);
    }
  });
</script>
<?php
require "./footer.php";
?>