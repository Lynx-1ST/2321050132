<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thể loại phim</title>
    <style>
        table { width: 100%; }
    </style>
</head>
<body>

    <h1>Danh sách thể loại</h1>

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
            <td>
                <button>Sửa</button>
                <a class="xoa" href="xoatheloai.php?id=<?= $row['id'] ?>">Xoá</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
