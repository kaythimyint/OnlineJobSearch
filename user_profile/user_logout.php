<?php
require "../common/url.php";

session_start();        
session_unset();
session_destroy();
header("Location:$base_url" . "index.php");
?>