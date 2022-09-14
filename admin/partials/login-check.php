<?php 
if(!isset($_SESSION['user'])){// User didn't login
    $_SESSION['no-login']="<script>alert('Please Login To Accss Admin Panel');</script>";
        header("location: ".SITEURL.'admin/login.php');
}
?>
