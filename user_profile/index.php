<?php
session_start(); 
// require "../common/check_auth.php";
    
require "./user_header.php";
require "../common/database.php";
require "../common/common_funtion.php";

if ($_SESSION['role'] == 'employer') {
    $url = $base_url . "index.php?error=Role error";
    header("Location:$url");
    exit();
}
?>

// $id = $_SESSION['id'];
// selectData('users',$mysqli,"id = '$id'");
?>

<div class="container pt-5">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <img class="card-img-top pt-2" src="../img/profile.jpg" alt="Card image" style="width: 95%;height:230px;margin:auto">
                <div class="card-body">
                    <h4 class="card-title">John Doe</h4>
                    <p class="card-text">Some example text.</p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                </div>
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