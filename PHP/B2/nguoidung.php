<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Thông tin người dùng</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Ngày sinh</th>
        </tr>
        <?php 
        include ("connect.php");
        $sql = 'SELECT nd.*, vt.ten_vai_tro FROM `nguoi_dung` nd 
                JOIN vai_tro vt on nd.vai_tro_id = vt.id';
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?= $row["ten_dang_nhap"] ?></td>
            <td><?= $row["ho_ten"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["sdt"] ?></td>
            <td><?= $row["ten_vai_tro"] ?></td>
            <td><?= $row["ngay_sinh"] ?></td>
            <td>
                <button>Sửa</button>
                <a class="xoa" href="xoanguoidung.php?id=<?php echo $row['id'] ?>">Xoá</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
