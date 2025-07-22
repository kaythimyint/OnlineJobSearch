<?php
require "./header.php";
if (!empty($_GET['user_id'])) {

    $id = $mysqli->real_escape_string($_GET['user_id']);

    $select_result = selectData('users', $mysqli, "WHERE id = '$id'");
    if ($select_result->num_rows > 0) {
        $data = $select_result->fetch_assoc();
    } else {
        echo '<script>window.location.href = "http://localhost/OnlineJobSearch/company_admin/apply_job_list.php?error=UserNotFound";</script>';
        exit();
    }

} else {
    echo '<script>window.location.href = "http://localhost/OnlineJobSearch/company_admin/apply_job_list.php?error=IdNotFound";</script>';
    exit();
}
?>
<style>
    span,h5
    {
        font-family:"Share Tech", sans-serif;
        font-weight: 800;
        font-style: normal;
    }
</style>
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a href="./apply_job_list.php" class="btn btn-dark py-3 px-4 text-white fw-bold mb-2" style="font-size:15pt;">Back</a>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <img src="<?= $user_base_url.'cv/'.$data['cv'] ?>" alt="" style="width:80%; max-width:800px; height:auto;">
            </div>
        </div>
    </div>
</div>
<?php
require "./footer.php";
?>