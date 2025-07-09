<?php
session_start();
require "./common/url.php";

    if (isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) 
    {
        $url = $company_base_url . 'logout.php';
        header("Location: $url");
    }
?>