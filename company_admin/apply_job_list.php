<?php
require "./header.php";


if (isset($_POST['id']) && isset($_POST['status'])) {
    $application_id = $mysqli->real_escape_string($_POST['id']);
    $status = $mysqli->real_escape_string($_POST['status']);

    $data=[
        'status' => $status
    ];
    $where=[
        'id' => $application_id
    ];
    $update_res =updateData('applications',$mysqli,$data,$where) ;

    if ($update_res) {
        echo "success";
    } else {
        echo "fail";
    }
}

$sql = "SELECT applications.*,job_title.name AS title_name,users.first_name AS first_name,
        users.last_name AS last_name,users.id AS user_id,job_post.id AS job_id
        FROM `applications`
        LEFT JOIN `job_post` ON applications.job_post_id = job_post.id
        LEFT JOIN `job_title` ON job_post.job_title_id = job_title.id
        LEFT JOIN `companies` ON job_post.company_id = companies.id
        LEFT JOIN `users` ON applications.user_id = users.id
        WHERE job_post.company_id = $id
        ";
$select_res = $mysqli->query($sql);

?>
<div class="content-body">
    <div class="container">
        <div class="row shadow border">
            <div class="col-12 p-3 mb-3" style="background-color: darkblue;">
                <h2 class="text-light">Applied Job List</h2>
            </div>
            <div class="col-12">
                <!-- <div class="card">
                    <div class="card-body"> -->
                        <table class="table text-center" style="color: black !important;">
                            <thead>
                                <tr>
                                    <th class="col-1">Job ID</th>
                                    <th class="col-3">Title</th>
                                    <th class="col-3">Seeker's Name</th>
                                    <th class="col-3">Status</th>
                                    <th class="col-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($select_res->num_rows>0) {
                                    while($result = $select_res->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?= $result['job_id'] ?></td>
                                            <td><?= $result['title_name'] ?></td>
                                            <td><?= $result['first_name'].' '.$result['last_name'] ?></td>
                                            <td>
                                                <select name="status" class="form-control status-dropdown" data-id="<?= $result['id'] ?>">
                                                    <option value="">Choose status</option>
                                                    <option value="pending" <?= $result['status']=='pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="checking" <?= $result['status']=='checking' ? 'selected' : '' ?>>Checking</option>
                                                    <option value="accept" <?= $result['status']=='accept' ? 'selected' : '' ?>>Accept</option>
                                                    <option value="reject" <?= $result['status']=='reject' ? 'selected' : '' ?>>Reject</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="<?= $company_base_url . 'seeker_profile.php?user_id=' . $result['user_id'] ?>" class="btn btn-primary fw-bold">Seeker CV</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }else{ ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center; font-weight: bold;">No data</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <!-- </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
   $('.status-dropdown').change(function(){
        let status = $(this).val();
        let application_id = $(this).data('id');

        if(status !== ''){
            $.ajax({
                url: 'apply_job_list.php',
                type: 'POST',
                data: {
                    id: application_id,
                    status: status
                },
                success: function(response){
                    // Optional: Show success message
                    alert('Status updated successfully!');
                },
                error: function(){
                    alert('Error updating status.');
                }
            });
        }
    });
});
</script>
<?php
require "./footer.php";
?>