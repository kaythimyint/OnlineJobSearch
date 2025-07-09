<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$error = false;
$first_name =
$firstName_error =
$last_name = 
$lastName_error = 
$user_name =
$userName_error =
$user_phone =
$userPhone_error =
$user_password =
$userPassword_error =
$user_email =
$userEmail_error =
$user_address =
$userAddress_error =
$user_confirm_password =
$userConfirmPassword_error = '';


if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
   
    $last_name = $mysqli->real_escape_string($_POST['last_name']);
    $first_name = $mysqli->real_escape_string($_POST['first_name']);
    $user_name = $mysqli->real_escape_string($_POST['user_name']);
    $user_phone = $mysqli->real_escape_string($_POST['user_phone']);
    $user_password = $mysqli->real_escape_string($_POST['user_password']);
    $user_email = $mysqli->real_escape_string($_POST['user_email']);
    $user_address = $mysqli->real_escape_string($_POST['user_address']);
    $user_confirm_password = $mysqli->real_escape_string($_POST['user_confirm_password']);

    //FirstName validation
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

    //Password validation
    if (strlen($user_password) == 0) {
        $error = true;
        $userPassword_error  = "Password is require";
    } else if (strlen($user_password) <= 5) {
        $error = true;
        $userPassword_error  = "Password greater than 5 character.";
    } else if (strlen($user_password) >= 15) {
        $error = true;
        $userPassword_error  = "Password less than 15 character.";
    }
    //Confirm Password Error
    else if ($user_password !== $user_confirm_password) {
        $error = true;
        $userConfirmPassword_error  = "Password must be same.";
    } else {
        $error = false;
        $byscript_password = md5($user_password);
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
    
    if (!$error) {
        $data =[
            'first_name'=> $first_name,
            'last_name' => $last_name,
            'name'      => $user_name,
            'email'     => $user_email,
            'phone'     => $user_phone,
            'address'   => $user_address,
            'password'  => $byscript_password,
            'role'      => 'user'
        ];
        $result = insertData('users',$mysqli,$data);
        if ($result) {
            $url = $base_url . "user_login.php?success=Register Success";
            header("Location: $url");
            exit;
        }else{
            $url = $base_url . "index.php?error=Register not success";
            header("Location: $url");
            exit;
        }
    }
}

// if (isset($_POST['btn_sub']) && $_POST['btn_sub'] == '1') {

// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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

        input[type=text]::placeholder,
        input[type=number]::placeholder,
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

        .user:hover,
        .employer:hover {
            border-color: gold !important;
            color: gold !important;
            background-color: #010167;
            font-size: 15pt;
        }
    </style>
</head>

<body>
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue;padding-top: 20px;">
                    <div class="row pt-5">
                        <div class="col-12">
                            <form action="" style="margin:auto;padding-top:20px" class="user_register" method="POST">
                                <div class="row">
                                    <div class="col-6">
                                        <div class=" form-group">
                                            <label for="first_name" class="text-light fw-bold mb-2">First Name</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $first_name ?>" id="first_name" placeholder="First Name" name="first_name">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($firstName_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $firstName_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <label for="name" class="text-light fw-bold mb-2">User Name</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_name ?>" id="name" placeholder="User Name" name="user_name">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userName_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userName_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="text-light fw-bold mb-2">Phone</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_phone ?>" id="phone" placeholder="Your Phone Number" name="user_phone" />
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userPhone_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userPhone_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-light fw-bold mb-2">Password</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="password" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_password ?>" id="password" placeholder="Enter Password" name="user_password">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userPassword_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userPassword_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class=" form-group">
                                            <label for="lastname" class="text-light fw-bold mb-2">Last Name</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $last_name ?>" id="lastname" placeholder="Last Name" name="last_name">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($lastName_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $lastName_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="text-light fw-bold mb-2">Email</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="email" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_email ?>" id="email" placeholder="Enter email address" name="user_email">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userEmail_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userEmail_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="text-light fw-bold mb-2">Address</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_address ?>" id="address" placeholder="Your Address" name="user_address">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userAddress_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userAddress_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-light fw-bold mb-2">Confirm Password</label>
                                            <div class="d-flex border border-info rounded">
                                                <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                                <input type="password" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $user_confirm_password ?>" id="password" placeholder="Enter Confirm Password" name="user_confirm_password">
                                            </div>
                                            <div style="height: 20px;">
                                                <?php
                                                if ($userConfirmPassword_error && $error) { ?>
                                                    <small class="form-text text-danger"><?= $userConfirmPassword_error ?></small>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-5">
                                    <div class="col-12">
                                        <input type="hidden" name="form_sub" value="1" />
                                        <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Register Now</button>
                                        <div class="d-flex justify-content-center mt-5">
                                            <h5 class="text-light">Have an account? </h5>
                                            <a href="<?php echo $base_url . "login.php" ?>" style="color: gold;text-decoration:none">Login now</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center min-vh-lg-100 py-5">
                <div class="">
                    <h1 class="text-white pb-3">Welcome To </h1>
                    <img src="./img/logo.jpg" alt="" style="width: 180px;height:180px;border-radius:50%">
                </div>
            </div>
        </div>
    </section>
    <script src="./bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
</body>

</html>