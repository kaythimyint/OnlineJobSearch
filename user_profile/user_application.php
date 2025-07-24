<?php
    require "./user_header.php";

    $sql = "SELECT applications.*,companies.company_name AS company_name,job_title.name AS title_name
            FROM `applications`
            LEFT JOIN `job_post` ON job_post.id=applications.job_post_id
            LEFT JOIN `companies` ON job_post.company_id=companies.id
            LEFT JOIN `job_title` ON job_post.job_title_id=job_title.id
            WHERE applications.user_id=$id";
    $application = $mysqli->query($sql);

?>
        <div class="col-12 col-lg-8 col-md-12 pb-3">
            <div style="background-color:darkblue;padding:10px;">
                <h3 class="text-white">Apply Jobs</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-4">Company Name</th>
                        <th class="col-4">Job Title</th>
                        <th class="col-2">Apply date</th>
                        <th class="col-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($application->num_rows>0) {
                        while($data=$application->fetch_assoc()){ ?>
                            <tr>
                                <td><?= $data['company_name'] ?></td>
                                <td><?= $data['title_name'] ?></td>
                                <td><?= date('d-m-Y', strtotime($data['application_date'])) ?></td>
                                <td>
                                    <?php
                                    $class = ($data['status'] == 'pending') ? 'bg-warning' : 
                                            (($data['status'] == 'checking') ? 'bg-info' : 
                                            (($data['status'] == 'accept') ? 'bg-success' : 'bg-danger'));
                                    ?>
                                    <span class="p-2 <?= $class ?> rounded"><?= $data['status'] ?></span>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>
<?php
    require "./user_footer.php";
?>