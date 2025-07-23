<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$industry_type_result = selectData('industry_type',$mysqli);

$employer_error = false;
$company_name =
$companyName_error = 
$industry_type =
$industryType_error =
$employer_name =
$employerName_error =
$employer_phone =
$employerPhone_error =
$employer_password =
$employerPassword_error =
$employer_email =
$employerEmail_error =
$employer_address =
$employerAddress_error =
$employer_confirm_password =
$employerConfirmPassword_error = '';

if (isset($_POST['form_sub']) && $_POST['form_sub'] == '1') {
    
    $industry_type = $mysqli->real_escape_string($_POST['industry_type']);
    $company_name = $mysqli->real_escape_string($_POST['company_name']);
    $employer_name = $mysqli->real_escape_string($_POST['employer_name']);
    $employer_phone = $mysqli->real_escape_string($_POST['employer_phone']);
    $employer_password = $mysqli->real_escape_string($_POST['employer_password']);
    $employer_email = $mysqli->real_escape_string($_POST['employer_email']);
    $employer_address = $mysqli->real_escape_string($_POST['employer_address']);
    $employer_confirm_password = $mysqli->real_escape_string($_POST['employer_confirm_password']);
    // var_dump($employer_name);
    // die();

    //Company Name validation
    if (strlen($company_name) == 0) {
        $employer_error = true;
        $companyName_error  = "Company Name is require";
    } else if (strlen($company_name) <= 5) {
        $employer_error = true;
        $companyName_error  = "Company Name greater than 5 character.";
    } else if (strlen($company_name) >= 50) {
        $employer_error = true;
        $companyName_error  = "Company Name less than 50 character.";
    }

    //Industry type validation
    if (strlen($industry_type) == 0) {
        $employer_error = true;
        $industryType_error  = "Industry Type is require";
    }

    //User Name validation
    if (strlen($employer_name) == 0) {
        $employer_error = true;
        $employerName_error  = "User name is require";
    } else if (strlen($employer_name) <= 5) {
        $employer_error = true;
        $employerName_error  = "User name greater than 5 character.";
    } else if (strlen($employer_name) >= 30) {
        $employer_error = true;
        $employerName_error  = "User name less than 30 character.";
    }

    //Email validation  
    if (strlen($employer_email) == 0) {
        $employer_error = true;
        $employerEmail_error  = "Email is require";
    } else if (strlen($employer_email) <= 5) {
        $employer_error = true;
        $employerEmail_error  = "Email greater than 10 character.";
    } else if (strlen($employer_email) >= 30) {
        $employer_error = true;
        $employerEmail_error  = "Email less than 30 character.";
    }

    //Phone validation
    if (strlen($employer_phone) == 0) {
        $employer_error = true;
        $employerPhone_error  = "Phone is require";
    } else if (strlen($employer_phone) <= 6) {
        $employer_error = true;
        $employerPhone_error  = "Phone greater than 6 number.";
    } else if (strlen($employer_phone) > 11) {
        $employer_error = true;
        $employerPhone_error  = "Phone less than 11 number.";
    }

    //Password validation
    if (strlen($employer_password) == 0) {
        $employer_error = true;
        $employerPassword_error  = "Password is require";
    } else if (strlen($employer_password) <= 5) {
        $employer_error = true;
        $employerPassword_error  = "Password greater than 5 character.";
    } else if (strlen($employer_password) >= 15) {
        $employer_error = true;
        $employerPassword_error  = "Password less than 15 character.";
    }
    //Confirm Password Error
    else if ($employer_password !== $employer_confirm_password) {
        $employer_error = true;
        $employerConfirmPassword_error  = "Password must be same.";
    } else {
        // $employer_error = false;
        $byscript_employerpassword = md5($employer_password);
    }

    //Address validation
    if (strlen($employer_address) == 0) {
        $employer_error = true;
        $employerAddress_error  = "Address is require";
    } else if (strlen($employer_address) <= 5) {
        $employer_error = true;
        $employerAddress_error  = "Address greater than 5 character.";
    } else if (strlen($employer_address) >= 30) {
        $employer_error = true;
        $employerAddress_error  = "Address less than 30 character.";
    }
    if (!$employer_error) {
        $select_email = selectData('companies',$mysqli,"WHERE email='$employer_email'");
        if ($select_email->num_rows == 0) {
            $data =[
                'company_name'      => $company_name,
                'industry_type_id'  => $industry_type,
                'name'              => $employer_name,
                'email'             => $employer_email,
                'phone'             => $employer_phone,
                'address'           => $employer_address,
                'password'          => $byscript_employerpassword,
                'role'              => 'employer'
            ];
            $result = insertData('companies',$mysqli,$data);
            if ($result) {
                $url = $base_url . 'company_login.php?Register Success!';
                header("Location: $url");
                exit;
            }else{
                $url = $base_url . "index.php?error=Register not success";
                header("Location: $url");
                exit;
            }
        }else{
            $employer_error = true;
            $employerEmail_error = "This email is already register.";
        }
    }
}

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
    </style>
</head>

<body>
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue; padding-top: 20px;">
                <div class="row pt-5">
                    <div class="col-12">
                        <form action="" style="margin:auto;padding-top:20px" method="POST">
                            <div class="row">
                                <div class="col-6">
                                    <div class=" form-group mb-3">
                                        <label for="company_name" class="text-light fw-bold mb-2">Company Name</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $company_name ?>" id="company_name" placeholder="Company Name" name="company_name">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($companyName_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $companyName_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="text-light fw-bold mb-2">Email</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="email" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_email ?>" id="email" placeholder="Enter email address" name="employer_email">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerEmail_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerEmail_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone" class="text-light fw-bold mb-2">Phone</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_phone ?>" id="phone" placeholder="Your Phone Number" name="employer_phone">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerPhone_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerPhone_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="text-light fw-bold mb-2">Password</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="password" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_password ?>" id="password" placeholder="Enter Password" name="employer_password">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerPassword_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerPassword_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group mb-5">
                                        <label for="categories" class="text-light fw-bold mb-2">Company Categories</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <select name="categories" class="form-control" style="background-color: inherit;border:none;color:white" id="categories">
                                                <option value="">Choose Categories</option>
                                                <option value="">Banks</option>
                                                <option value="">Hotel</option>
                                                <option value="">IT</option>
                                                <option value="">Sale</option>
                                            </select>
                                        </div>
                                        <small id="" class="form-text text-danger">Password Invalid</small>
                                    </div> -->
                                </div>
                                <div class="col-6">
                                    <div class=" form-group mb-3">
                                        <label for="name" class="text-light fw-bold mb-2">User Name</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_name ?>" id="name" placeholder="User Name" name="employer_name">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerName_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerName_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="industry_type" class="text-light fw-bold mb-2">Industry Type</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <select name="industry_type" id="industry_type" class="form-control" style="background-color:darkblue;border:none;color:white;">
                                                <option value="">Industry Type</option>
                                                <?php 
                                                if ($industry_type_result->num_rows>0) {
                                                    while($type_res = $industry_type_result->fetch_assoc()){ ?>
                                                        <option value="<?= $type_res['id'] ?>" <?= $industry_type == $type_res['id'] ? 'selected' :'' ?>><?= $type_res['name'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($industryType_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $industryType_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address" class="text-light fw-bold mb-2">Address</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="text" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_address ?>" id="address" placeholder="Your Address" name="employer_address">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerAddress_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerAddress_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="text-light fw-bold mb-2">Confirm Password</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="password" class="form-control" style="background-color: inherit;border:none;color:white;" value="<?= $employer_confirm_password ?>" id="password" placeholder="Enter Confirm Password" name="employer_confirm_password">
                                        </div>
                                        <div style="height: 20px;">
                                            <?php
                                            if ($employerConfirmPassword_error && $employer_error) { ?>
                                                <small class="form-text text-danger"><?= $employerConfirmPassword_error ?></small>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group mb-3">
                                        <label for="profile" class="text-light fw-bold mb-2">Company Profile</label>
                                        <div class="d-flex border border-info rounded">
                                            <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                                            <input type="file" class="form-control" style="background-color: inherit;border:none" id="profile" placeholder="Choose Company Profile">
                                        </div>
                                        <small id="" class="form-text text-danger">Password Invalid</small>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" name="form_sub" value="1" />
                                    <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Next</button>
                                    <div class="d-flex justify-content-center mt-5">
                                        <h5 class="text-light">Have an account? </h5>
                                        <a href="<?php echo $base_url . "company_login.php" ?>" style="color: gold;text-decoration:none">Login now</a>
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