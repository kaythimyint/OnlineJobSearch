<?php
session_start(); 
require "./user_header.php";
require "../common/database.php";
require "../common/common_funtion.php";

// $id = $_SESSION['id'];
// selectData('users',$mysqli,"id = '$id'");
?>

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                a
            </div>
        </div>
        <div class="col-12 col-md-8">
           <div class="card">
                <div class="card-body">
                    b
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "./user_footer.php";
?>