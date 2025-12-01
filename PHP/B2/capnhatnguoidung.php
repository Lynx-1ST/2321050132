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
    <?php  
    require 'connect.php';
    $id  = $_GET['id'];
    $sql = "SELECT * FROM nguoi_dung WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $nguoiDung = mysqli_fetch_assoc($result);
    ?>

    <form action="index.php?page_layout=capnhatnguoidung&id=<?php echo $id; ?>" method="POST">
        <h1> Cập nhật người dùng</h1>
        <div>
            <p>Tên đăng nhập</p>
            <input type="text" name="username" placeholder="Tên đăng nhập" value="<?php echo $nguoiDung['ten_dang_nhap']; ?>" />
        </div>
        <div class="div">
            <p>Mật khẩu</p>
            <input type="password" name="password" placeholder="Mật khẩu" value="<?php echo $nguoiDung['mat_khau']; ?>" />
        </div>
        <div class="div">
            <p>Họ tên</p>
            <input type="text" name="hoten" placeholder="Họ tên" value="<?php echo $nguoiDung['ho_ten']; ?>" />
        </div>
        <div class="div">
            <p>Email</p>
            <input type="text" name="email" placeholder="Email" value="<?php echo $nguoiDung['email']; ?>" />
        </div>
        <div class="div">
            <p>Số điện thoại</p>
            <input type="text" name="sdt" placeholder="Số điện thoại" value="<?php echo $nguoiDung['sdt']; ?>" />
        </div>
        <div class="div">
            <p>Ngày sinh</p>
            <input type="datetime" name="ngay-sinh" placeholder="Ngày sinh" value="<?php echo $nguoiDung['ngay_sinh']; ?>" />
        </div>
        <div>
            <select name="vai-tro">
                <option value="1" <?php echo $nguoiDung['vai_tro_id'] == 1 ? 'selected' : "" ?> >Admin</option>
                <option value="2" <?php echo $nguoiDung['vai_tro_id'] == 2 ? 'selected' : "" ?> >User</option>
                <option value="3" <?php echo $nguoiDung['vai_tro_id'] == 3 ? 'selected' : "" ?> >Guest</option>
            </select>
        </div>
        <div>
            <button type="submit">Thêm mới</button>
        </div>
    </form>

    <?php 
    if (!empty($_POST['username']) && !empty($_POST['password']) 
        && !empty($_POST['hoten']) && !empty($_POST['email']) 
        && !empty($_POST['sdt']) && !empty($_POST['ngay-sinh']) && !empty($_POST['vai-tro']) ) {
        $tenDangNhap = $_POST['username'];
        $pw = $_POST['password'];
        $hoTen = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $ngaySinh = $_POST['ngay-sinh'];
        $vaiTro = $_POST['vai-tro'];

        $sql = "UPDATE nguoi_dung
                SET ten_dang_nhap = '$tenDangNhap',
                    mat_khau      = '$pw',
                    ho_ten        = '$hoTen',
                    email         = '$email',
                    sdt           = '$sdt',
                    ngay_sinh     = '$ngaySinh',
                    vai_tro_id    = $vaiTro
                WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?page_layout=nguoidung');
            exit;
        } else {
            echo '<p class="warning">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    } else {
        echo "<p class='warning'> Vui lòng nhập đầy đủ thông tin ! </p>";
    }
    ?>
</body>
</html>
