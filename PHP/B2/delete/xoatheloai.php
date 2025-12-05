<?php 
    include('../connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM the_loai WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    header('location: ../index.php?page_layout=theloai');
?>