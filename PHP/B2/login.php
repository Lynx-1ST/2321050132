<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - B2</title>
    <style>
        .warning {
            color: red;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <h1>Đăng nhập</h1>
        <div>
            <input name="username" placeholder="Tên đăng nhập"/>
        </div>
        <div>
            <input name="password" placeholder="Mật khẩu"/>
        </div>
        <button type="submit" name="submit">Đăng nhập</button>
    </form>


    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $tenDangNhap = $_POST['username'];
        $matKhau = $_POST['password'];

        if ($tenDangNhap == 'admin' && $matKhau == '123') {
            header('location: homepage.php');
        } else {
        echo "<p class = 'warning'>Thong tin dang nhap sai ! Vui long nhap lai.</p>";
        }
    } 

    


    ?>
</body>
</html>