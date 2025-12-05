<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <form action="index.php?page_layout=themnguoidung" method="POST">
        <h1> Thêm người dùng</h1>
        <div>
            <p>Tên đăng nhập</p>
            <input type="text" name = "username" placeholder="Tên đăng nhập" />
        </div>
        <div class="div">
            <p>Mật khẩu</p>
            <input type="password" name="password" placeholder="Mật khẩu" />
        </div>
        <div class="div">
            <p>Họ tên</p>
            <input type="text" name="hoten" placeholder="Họ tên" />
        </div>
        <div class="div">
            <p>Email</p>
            <input type="text" name="email" placeholder="Email" />
        </div>
        <div class="div">
            <p>Số điện thoại</p>
            <input type="text" name="sdt" placeholder="Số điện thoại" />
        </div>
        <div class="div">
            <p>Ngày sinh</p>
            <input type="date" name="ngay-sinh" placeholder="Ngày sinh" />
        </div>
        <div>
            <select name="vai-tro">
                <option value="1">Admin</option>
                <option value="2">Đạo Diễn</option>
                <option value="3">Diễn Viên</option>
                <option value="4">User</option>
            </select>
        </div>
        <div>
            <button type="submit">Thêm mới</button>
        </div>
    </form>
<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password']) 
        && !empty($_POST['hoten']) && !empty($_POST['email']) 
        && !empty($_POST['sdt']) && !empty($_POST['ngay-sinh']) 
        && !empty($_POST['vai-tro'])) {

        $tenDangNhap = $_POST['username'];
        $pw = $_POST['password'];
        $hoTen = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $ngaySinh = $_POST['ngay-sinh'];
        $vaiTro = $_POST['vai-tro'];

        $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email, sdt, ngay_sinh, vai_tro_id)
                VALUES ('$tenDangNhap', '$pw', '$hoTen', '$email', '$sdt', '$ngaySinh', $vaiTro)";

        // DEBUG: In câu SQL để kiểm tra
        echo "<p style='color:blue;'>SQL: $sql</p>";

        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green;'>Thêm thành công!</p>";
            header('Location: index.php?page_layout=nguoidung');
            exit;
        } else {
            echo '<p style="color:red;">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    } else {
        echo "<p style='color:red;'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
}
?>


</body>
</html>