<?php
session_start();
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$error = false;
$saveImg =
$profile_error =
$industry_type =
$industry_type_error = '';

$industry_type_result = selectData('industry_type',$mysqli);

$id = isset($_GET['id']) ? $_GET['id'] : '';
// var_dump($id);
// die();
    if ($id === '') {
        $url = $base_url . "company_register.php?error=ID not found. Register first";
        header("Location: $url");
    } else {
        $res = selectData('companies', $mysqli, "WHERE id='$id'");
        if ($res->num_rows == 0) {
            $url = $base_url . "company_register.php?error=ID not found. Register first";
            header("Location: $url");
        }
    }


if (isset($_POST['form_submit']) && $_POST['form_submit']=='1') {
    $profile = $_FILES['profile'] ;
    $industry_type = $mysqli->real_escape_string($_POST['industry_type']);

    $file_name = $profile['name'];


    if (strlen($industry_type) == 0) {
        $error = true;
        $industry_type_error  = "Industry type is require";
    }

    if (strlen($file_name) == 0) {
        $error = true;
        $profile_error = "Profile image is require.";
    }else{

        $folder = "upload/";

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
                'profile' => $currentName,
                'industry_type_id' => $industry_type
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
        $url = $base_url.'company_login.php?success=Register success';
        header("Location:$url");
        exit();
        }
    }
    // if (!$error) {
    //     $result = selectData('users',$mysqli,"WHERE email='$email'");
    //     if ($result->num_rows >0) {
    //         $data = $result->fetch_assoc();
    //         if ($data['password'] == $byscript_password) {
    //             $_SESSION['name'] = $data['name'];
    //             $_SESSION['email'] = $data['email'];
    //             $_SESSION['role'] = $data['role'];
    //             $_SESSION['id'] = $data['id'];
    //             if ($data['role'] == 'admin') {
    //                 $url = $admin_base_url."index.php?success=Login Success";
    //                 header("Location:$url");
    //             }else{
    //                 $url = $user_base_url."index.php?success=Login Success";
    //                 header("Location:$url");
    //             }
    //         }else{
    //             $error = true;
    //             $password_error  = "Password is incorrect.";
    //         }
    //     }else{
    //         $error = true;
    //         $email_error  = "This email is not register.";
    //     }
    // }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css">
    <script src="./js/jquery.min.js"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100%;
            overflow-x: hidden;
        }

        input[type=email]::placeholder,
        input[type=password]::placeholder {
            color: white;
        }

        section {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-image: url('./img/teamworks.png');
            /* 👈 adjust path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(4px) brightness(0.8);
            z-index: -1;
        }

        section * {
            position: relative;
            z-index: 1;
        }


        @media (min-width: 992px) {
            .min-vh-lg-100 {
                min-height: 100vh !important;
            }
        }

        .profile{
            background-color: gold;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>  
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue;padding-top: 20px;">
                <form action="" style="width:80%;margin:auto;padding-top:20px"  method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3 d-flex justify-content-between">
                        <img src="./img/profile.jpg" id="preview" style="width: 200px;height:200px;">
                        <div class="pt-5">
                        <label for="profile" class="profile mb-3">Selete Profile Image</label>
                        <input type="file" name="profile" style="display: none;" id="profile">
                        <p class="text-light">Supported files are jpg,jpeg,png</p>
                        <?php
                            if ($profile_error && $error) { ?>
                                <small class="text-danger"><?= $profile_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                            <label for="industry_type" class="mb-2 text-light">Industry Type</label>
                            <select name="industry_type" id="industry_type" class="form-control" style="background-color:blue;border:none;color:white;">
                                <option value="">Select  One</option>
                                <?php 
                                if ($industry_type_result->num_rows>0) {
                                    while($type_res = $industry_type_result->fetch_assoc()){ ?>
                                        <option value="<?= $type_res['id'] ?>" <?= $industry_type == $type_res['id'] ? 'selected' :'' ?>><?= $type_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($industry_type_error && $error) { ?>
                                <small class="text-danger"><?= $industry_type_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    <input type="hidden" name="form_submit" value="1" />
                    <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Register</button>
                    <div class="d-flex justify-content-center mt-5">
                        <h5 class="text-light">Have an account? </h5>
                        <a href="<?php echo $base_url . "company_login.php" ?>" style="color: gold;text-decoration:none">Login now</a>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center min-vh-lg-100 py-5">
                <div class="">
                    <h1 class="text-white pb-3">Welcome To</h1>
                    <img src="./img/logo.jpg" alt="" style="width: 180px;height:180px;border-radius:50%">
                </div>
            </div>
        </div>
    </section>
    <script src="./bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
</body>
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
</html>
