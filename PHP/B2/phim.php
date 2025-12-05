<?php
require ("connect.php");

$sql = "SELECT p.*, nd.ho_ten, qg.ten_quoc_gia FROM phim p
JOIN nguoi_dung nd ON nd.id = p.dao_dien_id
JOIN quoc_gia qg ON qg.id = p.quoc_gia_id;
";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin phim</title>
    <style>
        table {
            width: 95%;
            margin: auto;
        }
        .btn {
            padding: 10px;
            border: 1px solid black;
            border-radius: 10px;
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

<div style="display: flex; justify-content: space-between; align-items: center; ">
    <h1>Thông tin phim</h1>
    <div>
        <a class="btn them" href="index.php?page_layout=themphim">Thêm phim</a>
    </div>
</div>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tên phim</th>
        <th>Đạo diễn</th>
        <th>Năm phát hành</th>
        <th>Poster</th>
        <th>Quốc gia</th>
        <th>Số tập</th>
        <th>Trailer</th>
        <th>Mô tả</th>
        <th>Hành động</th>
    </tr>

    <?php 
    while ($phim = mysqli_fetch_assoc($result)) 
    { 
        ?>
    <tr>
        <td><?= $phim["id"] ?></td>
        <td><?= $phim["ten_phim"] ?></td>
        <td><?= $phim["ho_ten"] ?></td>
        <td><?= $phim["nam_phat_hanh"] ?></td>
        <td><?= $phim["poster"] ?></td>
        <td><?= $phim["ten_quoc_gia"] ?></td>
        <td><?= $phim["so_tap"] ?></td>
        <td><?= $phim["trailer"] ?></td>
        <td><?= $phim["mo_ta"] ?></td>
        <td class="byt">
            <button class="update"><a href="index.php?page_layout=suaphim&id=<?= $phim['id'] ?>">Cập nhật</a></button>
            <button><a href="./delete/xoaphim.php?id=<?= $phim['id'] ?>">Xoá</a></button>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
