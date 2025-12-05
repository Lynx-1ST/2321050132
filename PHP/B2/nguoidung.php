<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            margin: 0;
        }
        body {
            margin: auto;
            width: 100%;
        }
        table {
            width: 95%;
            margin: auto;
        }
        table {
            width: 95%;
            margin: auto;
        }
        td {
            padding: 10px;
        }
        .function {
            justify-content: center;
        }
        .btn {
            padding: 10px;
            border: 1px solid black;
            border-radius: 10px;
        }
        h1 {
            padding: 15px;
            margin: 10px;
        }
        .them {
            margin-right: 50px;
            background-color: aqua;
            border: none;
            color: red;
        }

        .them:hover {
            background-color: greenyellow;
            cursor: pointer;
        }
        .byt {
            display: flex;
            justify-content: space-around;
        }
        button {
            padding: 6px 10px;
            border-radius: 10px;
            border: none;
            color: red;
            background-color: aquamarine;
        }

                .update {
            color: black;
            background-color: #ff5f9cff;
        }

    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; ">
    <h1>Thông tin người dùng</h1>
    <div>
        <a class="btn them" href="index.php?page_layout=themnguoidung">Thêm người dùng</a>
    </div>
    </div>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Ngày sinh</th>
            <th>Hành động</th>
        </tr>

        <?php 
        include ("connect.php");
        $sql = 'SELECT nd.*, vt.ten_vai_tro FROM `nguoi_dung` nd 
                JOIN vai_tro vt on nd.vai_tro_id = vt.id';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <tr>
            <td><?= $row["ten_dang_nhap"] ?></td>
            <td><?= $row["ho_ten"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["sdt"] ?></td>
            <td><?= $row["ten_vai_tro"] ?></td>
            <td><?= $row["ngay_sinh"] ?></td>
            <td class="byt">
                <button class="update"><a href="index.php?page_layout=capnhatnguoidung&id=<?php echo $row['id'] ?>">Cập nhật</a></button>
                <button><a class="xoa" href="delete/xoanguoidung.php?id=<?php echo $row['id'] ?>">Xoá</a></button>
            </td>
        </tr>

        <?php } ?>
    </table>
</body>
</html>
