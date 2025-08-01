<?php
 
require "../admin/admin_header.php";

$selectRes = selectData('job_title',$mysqli);
$delete_id = isset($_GET['delete_id'])? $_GET['delete_id'] : '';
if ($delete_id != '') {
    $deleteRes = deleteData('job_title',$mysqli,"WHERE id = '$delete_id'");
    if ($deleteRes) {
        $url = $admin_base_url.'job_title.php?success=Delete Success';
        header("Location:$url");
        exit();
    }
}
require "../admin/admin_sidebar.php";
?>


        <div class="col-12 col-md-12 col-lg-8">
           <div class="d-flex justify-content-between align-items-center mb-2">
                <h1>Job Title List</h1>
                <a href="<?= $admin_base_url."job_title_create.php" ?>" class="btn btn-primary btn-lg">Create</a>
           </div>
           <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">ID No</th>
                                <th class="col-3">Job Title Name</th>
                                <th class="col-2">Created AT</th>
                                <th class="col-3">Updated AT</th>
                                <th class="col-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($selectRes->num_rows >0) {
                                    while($items = $selectRes->fetch_assoc()){
                            ?>
                                    <tr>
                                        <td><?= $items['id'] ?></td>
                                        <td><?= $items['name'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="<?= $admin_base_url.'job_title_update.php?id=' . $items['id'] ?>" class="btn btn-info mb-2">Update</a>
                                            <button data-id ="<?= $items['id'] ?>" class="btn btn-danger delete_btn mb-2">Delete</button>
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
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete_btn').click(function(){
            const id = $(this).data('id');  

            Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to PHP delete URL
                    window.location.href = 'job_title.php?delete_id=' + id;
                }
            });
        });
    });
</script>
<?php
require "../admin/admin_footer.php";
?>