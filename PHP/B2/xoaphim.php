<?php
include("connect.php");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM phim_dien_vien WHERE phim_id = $id");

mysqli_query($conn, "DELETE FROM phim_the_loai WHERE phim_id = $id");

mysqli_query($conn, "DELETE FROM tap_phim WHERE phim_id = $id");

mysqli_query($conn, "DELETE FROM phim WHERE id = $id");

header("Location: phim.php");
exit;
?>
