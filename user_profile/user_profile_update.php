<?php
require "../user_profile/user_header.php";

// var_dump($data['profile']);
// die();
$error = false;
$profile = 
$first_name =
$firstName_error =
$last_name =
$lastName_error =
$user_name = 
$userName_error =
$user_email =
$userEmail_error =
$user_address =
$userAddress_error =
$user_phone =
$userPhone_error =
$national_id =
$national_id_error =
$brith = 
$brith_error  = '';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    $first_name = $mysqli->real_escape_string($_POST['first_name']);
    $last_name = $mysqli->real_escape_string($_POST['last_name']);
    $user_email = $mysqli->real_escape_string($_POST['email']);
    $national_id = $mysqli->real_escape_string($_POST['national_id']);
    $user_address = $mysqli->real_escape_string($_POST['address']);
    $user_phone = $mysqli->real_escape_string($_POST['phone']);
    $brith = $mysqli->real_escape_string($_POST['brith']);
    $user_name = $mysqli->real_escape_string($_POST['name']);
    $profile =  isset($_FILES['profile']) ? $_FILES['profile'] : null;

    //First Name validation
    if (strlen($first_name) == 0) {
        $error = true;
        $firstName_error  = "First Name is require";
    } else if (strlen($first_name) <= 2) {
        $error = true;
        $firstName_error  = "First Name greater than 2 character.";
    } else if (strlen($first_name) >= 30) {
        $error = true;
        $firstName_error  = "First Name less than 30 character.";
    }

    //lastName validation
    if (strlen($last_name) == 0) {
        $error = true;
        $lastName_error  = "Last Name is require";
    } else if (strlen($last_name) <= 2) {
        $error = true;
        $lastName_error  = "Last Name greater than 2 character.";
    } else if (strlen($last_name) >= 30) {
        $error = true;
        $lastName_error  = "Last Name less than 30 character.";
    }

    //Name validation
    if (strlen($user_name) == 0) {
        $error = true;
        $userName_error  = "User Name is require";
    } else if (strlen($user_name) <= 5) {
        $error = true;
        $userName_error  = "User Name greater than 5 character.";
    } else if (strlen($user_name) >= 30) {
        $error = true;
        $userName_error  = "User Name less than 30 character.";
    }

    //Email validation
    if (strlen($user_email) == 0) {
        $error = true;
        $userEmail_error  = "Email is require";
    } else if (strlen($user_email) <= 5) {
        $error = true;
        $userEmail_error  = "Email greater than 10 character.";
    } else if (strlen($user_email) >= 30) {
        $error = true;
        $userEmail_error  = "Email less than 30 character.";
    }

    //Phone validation
    if (strlen($user_phone) == 0) {
        $error = true;
        $userPhone_error  = "Phone is require";
    } else if (strlen($user_phone) <= 6) {
        $error = true;
        $userPhone_error  = "Phone greater than 6 number.";
    } else if (strlen($user_phone) >= 11) {
        $error = true;
        $userPhone_error  = "Phone less than 11 number.";
    }

    //Address validation
    if (strlen($user_address) == 0) {
        $error = true;
        $userAddress_error  = "Address is require";
    } else if (strlen($user_address) <= 5) {
        $error = true;
        $userAddress_error  = "Address greater than 5 character.";
    } else if (strlen($user_address) >= 30) {
        $error = true;
        $userAddress_error  = "Address less than 30 character.";
    }

    //Date of brith validation
    if (strlen($brith) == 0) {
        $error = true;
        $brith_error  = "Date of brith is require";
    }

    //Nationl ID validation
    if (strlen($national_id) == 0) {
        $error = true;
        $national_id_error  = "Address is require";
    } else if (strlen($national_id) <= 5) {
        $error = true;
        $national_id_error  = "Address greater than 5 character.";
    } else if (strlen($national_id) >= 30) {
        $error = true;
        $national_id_error  = "Address less than 30 character.";
    }
    // var_dump($national_id);
    // var_dump(!empty($data['nationalid'])? $data['nationalid'] : $national_id);
    // die();

    if (!$error) {
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'name'      => $user_name,
            'email'     => $user_email,
            'phone'     => $user_phone,
            'address'   => $user_address,
            'dateofbrith'   => $brith,
            'nationalid'   => $national_id
        ];
        $where =[
            'id' => $id
        ];
        $update_res = updateData('users',$mysqli,$data,$where);

        if ($update_res) {
           echo "<script>window.location.href = 'index.php?success=Information update success';</script>";
        }
    }
}
?>
        <div class="col-12 col-lg-8 col-md-12 mb-3">
            <form action="user_profile_update.php" method="POST" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-flex">
                                <?php
                                    if (!isset($data['profile']) || !$data['profile']) { ?>
                                        <img src="../img/profile.jpg" alt="" style="width: 200px;height:200px;">
                                <?php
                                    }
                                    else{ ?>
                                        <img src="<?= $data['profile'] ?>" alt="" style="width: 200px;height:200px;">
                                <?php
                                    }
                                ?>
                                <div class="pt-5 ps-5">
                                    <label for="profile" class="profile mb-3">Selete Profile Image</label>
                                    <input type="file" name="profile" style="display: none;" id="profile">
                                    <p>Supported files are jpg,jpeg,png</p>
                                    <small class="text-danger">Error</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border mb-3 shadow" style="border-top: none !important;">
                    <!-- <div class="col-12 border"> -->
                        <div style="background-color:darkblue;padding:10px;">
                            <h3 class="text-white">Basic Information</h3>
                        </div>
                    <!-- </div> -->
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="first_name" class="mb-2">First Name</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="first_name" value="<?= $data['first_name'] ?>" id="first_name" placeholder="First Name">
                            </div>
                            <?php
                                if ($firstName_error && $error) { ?>
                                    <small class="form-text text-danger"><?= $firstName_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="last_name" class="mb-2">last Name</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="last_name" value="<?= $data['last_name'] ?>" id="last_name" placeholder="Last Name">
                            </div>
                            <?php
                                if ($lastName_error && $error) { ?>
                                    <small class="form-text text-danger"><?= $lastName_error ?></small>
                                <?php
                                }
                                ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="email" class="mb-2">Email</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="email" class="form-control border-0 user_inputbox" name="email" value="<?= $data['email'] ?>" id="email" placeholder="Email">
                            </div>
                            <?php
                            if ($userEmail_error && $error) { ?>
                                <small class="form-text text-danger"><?= $userEmail_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="address" class="mb-2">Address</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="address" value="<?= $data['address'] ?>" id="address" placeholder="Address">
                            </div>
                            <?php
                            if ($userAddress_error && $error) { ?>
                                <small class="form-text text-danger"><?= $userAddress_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="phone" class="mb-2">Phone</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="phone" value="<?= $data['phone'] ?>" id="phone" placeholder="Phone">
                            </div>
                            <?php
                            if ($userPhone_error && $error) { ?>
                                <small class="form-text text-danger"><?= $userPhone_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="brith" class="mb-2">Date of birth</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="date" class="form-control border-0 user_inputbox" name="brith" value="<?= !empty($data['dateofbrith']) ? $data['dateofbrith']: $brith ?>" id="brith" placeholder="Date of birth">
                            </div>
                            <?php
                            if ($brith_error && $error) { ?>
                                <small class="form-text text-danger"><?= $brith_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="national_id" class="mb-2">National ID</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="national_id" value="<?= !empty($data['nationalid']) ? $data['nationalid'] : $national_id ?>" id="national_id" placeholder="National ID">
                            </div>
                            <?php
                            if ($national_id_error && $error) { ?>
                                <small class="form-text text-danger"><?= $national_id_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                    <div class="col-12 col-xl-6">
                        <div class="form-group py-3">
                            <label for="name" class="mb-2">User Name</label>
                            <div class="d-flex user_input">
                                <i class="fa-regular fa-user" style="font-size:20pt;padding:8px;margin:5px;border-radius:7px"></i>
                                <input type="text" class="form-control border-0 user_inputbox" name="name" value="<?= $data['name'] ?>" id="education" placeholder="User Name">
                            </div>
                            <?php
                            if ($userName_error && $error) { ?>
                                <small class="form-text text-danger"><?= $userName_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <input type="hidden" name="form_sub" value="1">
                        <button type="submit" class="btn btn-lg btn-warning text-light px-4 py-3"><i class="fa-solid fa-arrow-up-from-bracket"></i> Update CV</button>
                    </div>
                </div>
            </form>
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
require "../user_profile/user_footer.php";
?>