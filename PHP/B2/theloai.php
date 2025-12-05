<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thể loại phim</title>
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
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; ">
    <h1>Danh sách thể loại</h1>
    <div>
        <a class="btn them" href="index.php?page_layout=themtheloai">Thêm thể loại</a>
    </div>
    </div>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Tên thể loại</th>
            <th>Hành động</th>
        </tr>

        <?php 
        include("connect.php");
        $sql = "SELECT * FROM the_loai";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["ten_the_loai"] ?></td>
            <td class="byt">
                <button class="update"><a href="index.php?page_layout=suatheloai&id=<?= $row['id'] ?>">Cập nhật</a></button>
                <button><a class="xoa" href="delete/xoatheloai.php?id=<?= $row['id'] ?>">Xoá</a></button>
            </td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
