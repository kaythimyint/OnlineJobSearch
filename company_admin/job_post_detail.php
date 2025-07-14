<?php
require "./header.php";

if (isset($_GET['detail_id']) && $_GET['detail_id'] != '') {
    $detail_id = $_GET['detail_id'] ;
    $sql = "SELECT job_post.*,categories.name AS category_name,job_title.name AS title_name,job_type.name AS jobtype_name,
            experience.type AS experience_type,salary.type AS salary_type,location_city.name AS city_name,
            location_township.name AS township_name
            FROM `job_post`
            LEFT JOIN `categories` ON categories.id = job_post.category_id
            LEFT JOIN `job_title` ON job_title.id = job_post.job_title_id
            LEFT JOIN `job_type` ON job_type.id = job_post.job_type_id
            LEFT JOIN `experience` ON experience.id = job_post.experience_id
            LEFT JOIN `salary` ON salary.id = job_post.salary_id
            LEFT JOIN `location_city` ON location_city.id = job_post.location_city_id
            LEFT JOIN `location_township` ON location_township.id = job_post.location_township_id
            WHERE job_post.id = $detail_id";

    $select_res = $mysqli->query($sql);
    if ($select_res->num_rows>0) {
        $detail_res = $select_res->fetch_assoc();
    }
}else{
    echo '<script>window.location.href = "http://localhost/OnlineJobSearch/company_admin/index.php?error=Idnotfound";</script>';
    exit();
}
?>
<div class="content-body">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <input type="hidden" name="form_sub" value="1">
                <a href="./index.php" class="btn btn-dark py-3 px-4 text-white fw-bold" style="font-size:15pt;">Back</a>
            </div>
        </div>
        <div class="row shadow">
            <div class="col-12 bg-primary p-2">
                <h2 class="text-light">Job Detail</h2>
            </div>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="pt-4">
                    <h4>Job Category</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['category_name'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Job Title</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['title_name'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Job Type</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['jobtype_name'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Experience</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['experience_type'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Salary</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['salary_type'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>City</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['city_name'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Township</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px">
                        <h5><?= $detail_res['township_name'] ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="pt-4">
                    <h4>Description</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px;height:200px">
                        <h5><?= $detail_res['description'] ?></h5>
                    </div>
                </div>
                <div class="pt-4">
                    <h4>Requirement</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px;height:200px">
                        <h5><?= $detail_res['requirements'] ?></h5>
                    </div>
                </div>
                <div class="py-4">
                    <h4>Benefit</h4> 
                    <div style="border: 0.5px solid gray;padding:5px 0 0 20px ;border-radius:10px;height:200px">
                        <h5><?= $detail_res['benefit'] ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "./footer.php";
?>