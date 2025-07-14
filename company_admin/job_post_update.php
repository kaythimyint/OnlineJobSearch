<?php
require "./header.php";
$error=false;
$category = 
$category_error =
$job_title = 
$job_title_error = 
$experience = 
$experience_error = 
$vacancy = 
$vacancy_error = 
$job_type  = 
$job_type_error = 
$salary = 
$salary_error = 
$city = 
$city_error = 
$township = 
$township_error = 
$deadline = 
$deadline_error = 
$description = 
$description_error =
$requirement = 
$requirement_error = 
$benefit = 
$benefit_error = '';

$update_id = isset($_GET['update_id']) ? $_GET['update_id'] : '';

$job_post_result =selectData('job_post',$mysqli,"WHERE id = '$update_id'");
if ($job_post_result->num_rows>0) {
    $job_post_res = $job_post_result->fetch_assoc();
}

$categories_result = selectData('categories',$mysqli);
$title_result = selectData('job_title',$mysqli);
$experience_result = selectData('experience',$mysqli);
$job_type_result = selectData('job_type',$mysqli);
$city_result = selectData('location_city',$mysqli);
$salary_result = selectData('salary',$mysqli);
$township_result = selectData('location_township',$mysqli);

if(isset($_POST['form_sub']) && $_POST['form_sub'] == '1') { 
    $category = $mysqli->real_escape_string($_POST['categories']);
    $job_title = $mysqli->real_escape_string($_POST['job_title']);
    $experience = $mysqli->real_escape_string($_POST['experience']);
    $vacancy = $mysqli->real_escape_string($_POST['vacancy']);
    $job_type = $mysqli->real_escape_string($_POST['job_type']);
    $salary = $mysqli->real_escape_string($_POST['salary']);
    $city = $mysqli->real_escape_string($_POST['city']);
    $township = $mysqli->real_escape_string($_POST['township']);
    $deadline = $mysqli->real_escape_string($_POST['deadline']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $requirement = $mysqli->real_escape_string($_POST['requirement']);
    $benefit = $mysqli->real_escape_string($_POST['benefit']);

    // var_dump($title_result);
    // die();
    
    //Category validation
    if (strlen($category) == 0) {
        $error = true;
        $category_error  = "Choose category";
    }

    //Job title validation
    if (strlen($job_title) == 0) {
        $error = true;
        $job_title_error  = "Choose job title";
    }

    //Experience validation
    if (strlen($experience) == 0) {
        $error = true;
        $experience_error  = "Choose experience";
    }

    //Vacancy validation
    if (strlen($vacancy) == 0) {
        $error = true;
        $vacancy_error  = "Choose vacancy";
    }

    //Job type validation
    if (strlen($job_type) == 0) {
        $error = true;
        $job_type_error  = "Choose job type";
    }

    //Job type validation
    if (strlen($salary) == 0) {
        $error = true;
        $salary_error  = "Choose salary";
    }

    //City validation
    if (strlen($city) == 0) {
        $error = true;
        $city_error  = "Choose city";
    }

    //Township validation
    if (strlen($township) == 0) {
        $error = true;
        $township_error  = "Choose township";
    }

    //Deadline validation
    if (strlen($deadline) == 0) {
        $error = true;
        $deadline_error  = "Choose deadline";
    }

    //deadline validation
    if (strlen($deadline) === 0) {
        $error = true;
        $deadline_error = "Please choose deadline date";
    }

    //description validation
    if (strlen($description) === 0) {
        $error = true;
        $description_error = "Job description is require.";
    }else if (strlen($description) <= 20) {
        $error = true;
        $description_error = "Job description greater than 20 characters.";
    }else if (strlen($description) >= 700) {
        $error = true;
        $description_error = "Job description greater than 20 characters.";
    }

    //requiement validation
    if (strlen($requirement) === 0) {
        $error = true;
        $requirement_error = "Please enter job requirement.";
    }else if (strlen($requirement) <= 20) {
        $error = true;
        $requirement_error = "Job requirement greater than 20 characters.";
    }else if (strlen($requirement) >= 700) {
        $error = true;
        $requirement_error = "Job requirement greater than 20 characters.";
    }

    //Benefit validation
    if (strlen($benefit) === 0) {
        $error = true;
        $benefit_error = "Please enter benefits.";
    }else if (strlen($benefit) <= 20) {
        $error = true;
        $benefit_error = "Benefits greater than 20 characters.";
    }else if (strlen($benefit) >= 500) {
        $error = true;
        $benefit_error = "Benefits greater than 20 characters.";
    }

    if (!$error) {
        $data = [
            'company_id' => $id,
            'job_title_id' => $job_title,
            'requirements' => $requirement,
            'experience_id' => $experience,
            'experience_id' => $experience,
            'salary_id' => $salary,
            'vacancy' => $vacancy,
            'description' => $description,
            'benefit' => $benefit,
            'job_type_id' => $job_type,
            'location_city_id' => $city,
            'location_township_id' => $township,
            'category_id' => $category,
            'deadline' => $deadline,
        ];
        $where = [
            'id' => $update_id
        ];
        $insert_result = updateData('job_post',$mysqli,$data,$where);
        if ($insert_result) {
            // $url = $company_base_url . "index.php?success=Job post update success";
            // header("Location:$url");
            // exit();
            echo '<script>window.location.href = "http://localhost/OnlineJobSearch/company_admin/index.php";</script>';
            exit();
        }
    }
}
?>

<div class="content-body">
    <div class="container">
        <form action="" method="POST">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <input type="hidden" name="form_sub" value="1">
                    <a href="./index.php" class="btn btn-dark py-3 px-4 text-white  fw-bold" style="font-size:15pt;">Back</a>
                </div>
            </div>
            <div class="row border shadow">
                <div class="col-12 p-3 mb-3" style="background-color: darkblue;">
                    <h2 class="text-light">First Information</h2>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="categories" class="mb-2">Job categories</label>
                            <select name="categories" id="categories" class="form-control">
                                <option value="">Slect  One</option>
                                <?php 
                                if ($categories_result->num_rows>0) {
                                    while($type_res = $categories_result->fetch_assoc()){ ?>
                                        <option value="<?= $type_res['id'] ?>" <?= $job_post_res['category_id'] == $type_res['id'] ? 'selected' :'' ?>><?= $type_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($category_error && $error) { ?>
                                <small class="text-danger"><?= $category_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="job_title" class="mb-2">Job Title</label>
                            <select name="job_title" id="job_title" class="form-control">
                                <option value="">Choose Job Title</option>
                                <?php 
                                if ($title_result->num_rows>0) {
                                    while($title_res = $title_result->fetch_assoc()){ ?>
                                        <option value="<?= $title_res['id'] ?>" <?= $job_post_res['job_title_id'] == $title_res['id'] ? 'selected' :'' ?> ><?= $title_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($job_title_error && $error) { ?>
                                <small class="text-danger"><?= $job_title_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="experience" class="mb-2">Experience</label>
                            <select name="experience" id="experience" class="form-control">
                                <option value="">Choose Experience</option>
                                <?php 
                                if ($experience_result->num_rows>0) {
                                    while($experience_res = $experience_result->fetch_assoc()){ ?>
                                        <option value="<?= $experience_res['id'] ?>" <?= $job_post_res['experience_id'] == $experience_res['id'] ? 'selected' :'' ?> ><?= $experience_res['type'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($experience_error && $error) { ?>
                                <small class="text-danger"><?= $experience_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="vacancy" class="mb-2">Vacancy</label>
                            <input type="number" class="form-control" name="vacancy" value="<?= $job_post_res['vacancy'] ?>" min="1" id="vacancy" placeholder="eg: 1 or 2" name="quantity">
                            <?php
                            if ($vacancy_error && $error) { ?>
                                <small class="text-danger"><?= $vacancy_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="job_type" class="mb-2">Job Type</label>
                            <select name="job_type" id="job_type" class="form-control">
                                <option value="">Choose job_type</option>
                                <?php 
                                if ($job_type_result->num_rows>0) {
                                    while($job_type_res = $job_type_result->fetch_assoc()){ ?>
                                        <option value="<?= $job_type_res['id'] ?>" <?= $job_post_res['job_type_id'] == $job_type_res['id'] ? 'selected' :'' ?> ><?= $job_type_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($job_type_error && $error) { ?>
                                <small class="text-danger"><?= $job_type_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="salary" class="mb-2">Salary</label>
                            <select name="salary" id="salary" class="form-control">
                                <option value="">Choose salary</option>
                                <?php 
                                if ($salary_result->num_rows>0) {
                                    while($salary_res = $salary_result->fetch_assoc()){ ?>
                                        <option value="<?= $salary_res['id'] ?>" <?= $job_post_res['salary_id'] == $salary_res['id'] ? 'selected' :'' ?> ><?= $salary_res['type'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($salary_error && $error) { ?>
                                <small class="text-danger"><?= $salary_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="city" class="mb-2">City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Choose city</option>
                                <?php 
                                if ($city_result->num_rows>0) {
                                    while($city_res = $city_result->fetch_assoc()){ ?>
                                        <option value="<?= $city_res['id'] ?>" <?= $job_post_res['location_city_id'] == $city_res['id'] ? 'selected' :'' ?> ><?= $city_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($city_error && $error) { ?>
                                <small class="text-danger"><?= $city_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="township" class="mb-2">Township</label>
                            <select name="township" id="township" class="form-control">
                                <option value="">Choose township</option>
                                <?php 
                                if ($township_result->num_rows>0) {
                                    while($township_res = $township_result->fetch_assoc()){ ?>
                                        <option value="<?= $township_res['id'] ?>" <?= $job_post_res['location_township_id'] == $township_res['id'] ? 'selected' :'' ?> ><?= $township_res['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if ($township_error && $error) { ?>
                                <small class="text-danger"><?= $township_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="deadline" class="mb-2">Deadline</label>
                            <!-- <input type="text"   name="datepicker" class="datepicker-default form-control" id="datepicker"> -->
                             <input type="text" class="form-control" placeholder="2017-06-04" id="mdate" name="deadline" value="<?= $job_post_res['deadline'] ?>">
                            <!-- <input type="date" class="form-control"  id="deadline"> -->
                            <?php
                            if ($deadline_error && $error) { ?>
                                <small class="text-danger"><?= $deadline_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row shadow mt-4">
                <div class="col-12 p-3 mb-3" style="background-color: darkblue;">
                    <h2 class="text-light">Second Information</h2>
                </div>
                <div class="col-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="description" class="mb-2">Job Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Enter job description"><?= $job_post_res['description'] ?></textarea>
                            <?php
                            if ($description_error && $error) { ?>
                                <small class="text-danger"><?= $description_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="requirement" class="mb-2">Job Requirement</label>
                            <textarea name="requirement" id="requirement" cols="30" rows="10" class="form-control" placeholder="Enter job requirement"><?= $job_post_res['requirements'] ?></textarea>
                            <?php
                            if ($requirement_error && $error) { ?>
                                <small class="text-danger"><?= $requirement_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="benefit" class="mb-2">Benefits</label>
                            <textarea name="benefit" id="benefit" cols="30" rows="10" class="form-control" placeholder="Enter benefit"><?= $job_post_res['benefit'] ?></textarea>
                            <?php
                            if ($benefit_error && $error) { ?>
                                <small class="text-danger"><?= $benefit_error ?></small>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12 d-flex justify-content-end">
                    <input type="hidden" name="form_sub" value="1">
                    <button type="submit" class="btn btn-warning py-3 px-4 text-white  fw-bold" style="font-size:15pt;">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
require "./footer.php";
?>
<script>
    $(document).ready(function(){
        $('#vacancy').on('input', function() {
            if ($(this).val() < 1) {
                $(this).val(1);
            }
        });
        $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
        });
    });  
</script>
