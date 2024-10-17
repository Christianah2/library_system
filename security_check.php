<?php
session_start();
if(empty($_SESSION)){
    echo "<script>alert('Kindly Sign In to access this page')</script>";
    echo "<script>window.location.href='index.php'</script>";
}
?>